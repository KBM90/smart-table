PHASE 4 IMPLEMENTATION — Realtime Dashboards (Supabase Realtime + Polling Fallback)

Read docs/PLAN.md (Phase 4) before starting. Project root: C:\Karim\projects\Saas\smart-table.
Phases 1-3 complete and verified. 56 tests passing. Build on top.

## Goal
Replace `wire:poll.3s` on the customer status, owner requests page, AND introduce a waiter dashboard. Use Supabase Realtime (browser-side JS client subscribing to `requests` and `table_sessions` tables filtered by tenant_id / table_session_id). Polling stays as automatic fallback when Realtime fails (degraded network, websocket blocked, etc.).

## A. Supabase Realtime decision context
- DB: Supabase Postgres (production). Local dev: sqlite (no realtime there) — so realtime must be **gracefully degraded** to polling when DB driver is sqlite or when supabase env vars are missing. Detect: if `config('services.supabase.url')` empty -> realtime disabled, polling-only mode.
- We only run realtime in browser. PHP doesn't open a websocket. Good for Hostinger.

## B. Frontend setup
- Install supabase-js: `npm install @supabase/supabase-js`
- Create `resources/js/realtime.js` — exports a singleton client built from `window.SUPABASE_URL` + `window.SUPABASE_ANON_KEY` (rendered into the page from a Blade @push or a meta tag). If either is missing, export a no-op stub.
- In `resources/js/app.js`, import and expose `window.AppRealtime = { onRequestChange(filter, callback), onSessionChange(filter, callback), unsubscribe(handle) }`.
- Build with Vite (`npm run build` must succeed, `npm run dev` for local).

## C. Blade plumbing
- Add a partial `resources/views/partials/realtime-config.blade.php` that emits:
  ```html
  <script>
    window.SUPABASE_URL = @json(config('services.supabase.url'));
    window.SUPABASE_ANON_KEY = @json(config('services.supabase.anon_key'));
    window.REALTIME_ENABLED = {{ config('services.supabase.url') ? 'true' : 'false' }};
  </script>
  ```
- Include this partial in customer, owner, waiter layouts.
- Add `config/services.php` entries for supabase: url, anon_key, service_role (server-side only, optional). Document `.env.example` keys: SUPABASE_URL, SUPABASE_ANON_KEY, SUPABASE_SERVICE_ROLE_KEY.

## D. Realtime channels
- Owner Requests page: subscribe to `public:requests` filtered by `tenant_id=eq.{currentTenantId}`. On INSERT/UPDATE/DELETE -> dispatch a Livewire event (`$wire.dispatch('refresh')`) which triggers the existing component to refetch.
- Customer status panel: subscribe to `public:requests` filtered by `table_session_id=eq.{sessionId}` -> on UPDATE call `$wire.dispatch('refresh-status')`.
- Waiter dashboard (new this phase): subscribe to `public:requests` filtered by `tenant_id=eq.{currentTenantId}` AND `status=in.(pending,accepted)` (server filter is `tenant_id`; further filter in JS).
- Polling fallback: keep `wire:poll.3s` BUT only activate it when `window.REALTIME_ENABLED !== true`. Easiest: in Blade, conditionally render `wire:poll.3s` attribute via `@if(!config('services.supabase.url')) wire:poll.3s @endif`. Acceptable alternative: always poll at 10s as safety net and let realtime handle the fast updates.

## E. Waiter dashboard (new)
- `app/Livewire/Waiter/Requests/Index.php` — full page. Lists pending+accepted requests for the waiter's tenant. "Accept" (sets accepted_by=waiter.id, status=accepted). "Resolved" same as owner.
- Route in waiter group `[auth, tenant, role:waiter]`: GET `/waiter/dashboard` renders the requests list (replace placeholder dashboard view), GET `/waiter/requests` alias.
- Update `layouts/waiter.blade.php` nav: link to Requests.
- Waiter CANNOT see /owner/* routes (already enforced).

Note: at this point we still need a way to seed waiters for testing. Phase 6 builds the owner UI for managing waiters. For now, seed via factory in tests + tinker for manual smoke.

## F. Authorization
- Re-confirm requests can only be accepted by users in the same tenant (TenantScope handles).
- Both owner AND waiter can accept/resolve requests in their tenant — update RequestPolicy if introduced; otherwise inline check in components is fine.

## G. Tests

### Existing
- All current 56 tests must still pass.

### New: `tests/Feature/Waiter/WaiterRequestsTest.php`
- Waiter sees pending+accepted requests for own tenant.
- Waiter cannot see other tenants' requests.
- Waiter accepts a request -> accepted_by = waiter.id, status = accepted.
- Waiter resolves a request -> resolved_at set, status = resolved.
- Owner cannot access /waiter/dashboard (403).
- Anonymous cannot access /waiter/* (302 to login).

### New: `tests/Feature/Realtime/RealtimeConfigTest.php`
- When SUPABASE_URL is set: rendered owner page contains `window.REALTIME_ENABLED = true;`.
- When SUPABASE_URL is empty: rendered owner page contains `window.REALTIME_ENABLED = false;` AND has `wire:poll` somewhere.
- Realtime config partial does not leak service-role key to HTML.

### Note
- Don't try to test browser-level Supabase client behavior in PHPUnit. Test only the Blade-rendered config + conditional polling attributes + waiter feature flow.

## H. Manual smoke (record)
- `npm run build` succeeds.
- With SUPABASE_URL empty in .env: load /owner/requests -> view source contains `wire:poll`. Functional flow still works (create pending request via tinker, owner page updates within 3s).
- With SUPABASE_URL + ANON_KEY set to a real Supabase project (if available) OR placeholder: page renders the realtime client init script, browser console doesn't throw on missing project — graceful failure mode logs once and falls back. Document this in the smoke report.
- Login as a seeded waiter: /waiter/dashboard shows requests list; accept a request; verify DB.
- Owner cannot reach /waiter/dashboard.

## I. Acceptance criteria
- `php artisan test` -> all green (existing 56 + new ~6-8 tests).
- `php artisan migrate:fresh` clean.
- `npm run build` succeeds.
- Polling fallback verified works when realtime disabled.
- Waiter dashboard functional.
- Cross-tenant isolation still holds for waiters.

## J. Constraints
- Do NOT modify Phase 1-3 schema unless strictly necessary. If you must (e.g. adding an index), justify.
- Do NOT use Supabase Auth / RLS yet — RLS is acknowledged in plan as defense-in-depth, will be added Phase 6 hardening.
- Do NOT build Phase 5 catalog (products + images).
- Realtime is browser-only. PHP must remain stateless / no PHP websocket.

## K. Reporting
Return:
- Decisions (polling-fallback approach, env-detection strategy, supabase-js wiring).
- File diff list.
- Full `php artisan test` output.
- `npm run build` output.
- Manual smoke transcript with both modes (realtime-off and at least placeholder realtime-on).
- Deviations from PLAN.md / brief.
- Open questions (e.g., whether RLS should ship now vs Phase 6).
