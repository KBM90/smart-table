PHASE 6 IMPLEMENTATION — Waiter Management + Authorization Hardening + RLS

Read docs/PLAN.md (Phase 6) before starting. Project root: C:\Karim\projects\Saas\smart-table.
Phases 1-5 complete and verified. 80 tests passing. Build on top.

## Goal
1. Owner UI to create/list/delete waiter accounts (name, email, password) — waiters belong to owner's tenant.
2. Authorization hardening: policies for ServiceRequest, TableSession; comprehensive cross-tenant tests; rate limiting on public + auth-mutating endpoints.
3. Supabase RLS policies as defense-in-depth (deferred from earlier phases).

## A. Waiter management UI

### Routes (owner group `[auth, tenant, role:owner]`)
- GET `/owner/staff` -> Owner\Staff\Index Livewire full-page
- (Form is inline modal/panel like products/tables — no separate routes needed)

### Livewire components
- `app/Livewire/Owner/Staff/Index.php`: list waiters in this tenant, search by name/email, "Create waiter" panel toggle, per-row "Delete" (soft delete on user — see below).
- `app/Livewire/Owner/Staff/Form.php`: fields name, email, password, password_confirmation. Validation: unique email globally (Laravel default), min password 8.
- On create: User::create with tenant_id = current tenant, role = 'waiter'. Email-verified flag: set verified at creation since owner is provisioning the account; document this decision.
- On delete: soft-delete the user (use SoftDeletes trait on User if not present yet). Owner cannot delete themselves or other owners. Waiter can never reach this UI.

### Updates
- Add `SoftDeletes` to User model + migration `add_deleted_at_to_users_table`. Authentication still queries non-deleted users only (default Eloquent behavior).
- Owner cannot self-delete; cannot delete users in other tenants (Tenant scope already prevents).
- Owner navigation: add "Staff" link to layouts/owner.blade.php.

### Policy
- `app/Policies/UserPolicy.php`: viewAny/view/create/delete:
  - viewAny/create: only owner role.
  - view: owner can view users in same tenant.
  - delete: owner can delete waiters in same tenant; cannot delete owners; cannot delete self.

## B. Authorization hardening

### Policies (add the missing ones)
- `app/Policies/ServiceRequestPolicy.php`: viewAny (auth+tenant), view (same tenant), accept (same tenant + role in [owner,waiter] + status=pending), resolve (same tenant + role in [owner,waiter] + status=accepted), cancel (customer-only via session token — keep that check inline since it's not user-based).
- `app/Policies/TableSessionPolicy.php`: viewAny/view (same tenant + auth). Close (same tenant + role=owner only). Inline checks in TableSessionService remain.
- Wire policies via Laravel auto-discovery or AuthServiceProvider.
- Use `$this->authorize('accept', $request)` in Livewire actions where user-driven.

### Rate limiting
In `app/Providers/AppServiceProvider.php` or RouteServiceProvider:
- `RateLimiter::for('login')`: 5 per minute by IP.
- `RateLimiter::for('register')`: 3 per minute by IP.
- `RateLimiter::for('customer-actions')`: 30 per minute by IP+session_token (covers callWaiter/cancelRequest).
- `RateLimiter::for('staff-actions')`: 60 per minute by user.id (covers accept/resolve to prevent click-spam abuse).
- Apply to relevant routes/groups.

### Defensive checks
- Audit Livewire components: every mutation must (a) re-resolve the model with tenant scope active, (b) call $this->authorize where applicable.
- Confirm `BelongsToTenant` auto-set logic doesn't allow tenant_id mass-assignment from outside.

## C. Supabase RLS policies (defense-in-depth)

This is for the production Supabase Postgres. Local dev uses sqlite, so tests don't exercise RLS. We deliver migration files + a documented script.

### File: `database/supabase/rls.sql`
Idempotent SQL applying RLS to: tenants, users, tables, table_sessions, requests, products. Pattern:
```sql
ALTER TABLE public.requests ENABLE ROW LEVEL SECURITY;
DROP POLICY IF EXISTS requests_tenant_isolation_select ON public.requests;
CREATE POLICY requests_tenant_isolation_select ON public.requests FOR SELECT
  USING (tenant_id::text = current_setting('app.current_tenant_id', true));
-- and similar for INSERT/UPDATE/DELETE
```
Plus deny-all default and a `bypass_rls` role (the Laravel app's DB user) that has BYPASSRLS so server-side queries are unaffected — Laravel remains the primary enforcer; RLS is for any direct PostgREST/Supabase Realtime access from clients.

### Realtime channel safety
For Phase 4 realtime: the browser uses the anon key. With RLS enforced, `SELECT` policies determine what the realtime stream can see. Add policy comment: "anon role can read requests/table_sessions only when tenant_id matches the JWT claim or the table_session_id matches a public claim". Since we don't yet issue Supabase JWTs to the browser, the simplest safe default is: **disable anon SELECT entirely on `requests` and `table_sessions`** and rely on Laravel server-pushed Livewire updates instead. This means Supabase Realtime as currently wired (anon subscribe) WON'T receive rows after RLS is enabled in production. Document this clearly.

### Decision required (worker should make and document)
Two paths for production realtime:
1. **Recommended for v1:** Disable anon-client realtime subscriptions; rely on Livewire wire:poll fallback in production. RLS fully locks tables. Simple, secure, fits Hostinger.
2. **Stretch:** Issue short-lived Supabase JWTs from Laravel (signed with the JWT secret) including tenant_id claim, browser uses them for realtime. Adds complexity.

Worker: implement path 1 cleanly. Add a feature flag `config('services.supabase.realtime_anon_enabled')` defaulting false. When false, realtime.js still loads but logs "anon realtime disabled" and short-circuits to no-op (polling fallback handles updates). Note in deploy doc.

### Docs
- `docs/SUPABASE_RLS.md` — how to apply rls.sql, when to apply (after Laravel app user is granted BYPASSRLS), how to verify.

## D. Tests

### `tests/Feature/Owner/StaffManagementTest.php`
- Owner creates a waiter -> User created with tenant_id, role=waiter; new waiter can log in; lands on /waiter/dashboard.
- Validation: missing fields, weak password, duplicate email all rejected.
- Owner sees only own-tenant waiters in list; waiters from tenant B are not visible.
- Owner cannot delete themselves.
- Owner cannot delete a waiter from another tenant (404 via tenant scope).
- Owner soft-deletes a waiter -> waiter cannot log in afterwards.
- Waiter cannot access /owner/staff (403).

### `tests/Feature/Authorization/PoliciesTest.php`
- ServiceRequestPolicy: owner of A can't accept request in tenant B (403/404).
- ServiceRequestPolicy: waiter in same tenant can accept and resolve.
- ServiceRequestPolicy: cannot accept already-accepted request.
- TableSessionPolicy: only owner can close manually; waiter blocked.

### `tests/Feature/Security/RateLimitTest.php`
- 6 failed logins from same IP -> 429 on 6th.
- 4 registers in a minute -> 429 on 4th.
- Customer callWaiter spam -> 429 after threshold.
- Staff accept-action spam -> 429 after threshold.

### `tests/Feature/Tenancy/CrossTenantHardeningTest.php`
- Comprehensive cross-tenant tests across ALL models: Table, TableSession, ServiceRequest, Product, User. Owner of A cannot access any model belonging to tenant B via direct route (route model binding) — expect 404 (tenant scope) or 403 (policy).

### `tests/Feature/Realtime/RealtimeAnonDisabledTest.php`
- When `services.supabase.realtime_anon_enabled` is false, the rendered page contains the realtime config but the JS module short-circuit flag is set. Verify by Blade-rendered string contains `window.REALTIME_ANON_ENABLED = false` (or similar marker).

## E. Acceptance criteria
- `php artisan test` -> all green (80 + ~15-20 new tests).
- `php artisan migrate:fresh` clean (including the new soft-delete column on users).
- `npm run build` clean.
- `database/supabase/rls.sql` is valid SQL (worker should `psql` lint or at least syntax-check via a runnable parser if no Postgres available — at minimum, manually review and document).
- Manual smoke (record):
  - Login as owner, /owner/staff: empty.
  - Create waiter "ali@test.com" / pwd "Password123".
  - Logout; login as ali@test.com -> lands /waiter/dashboard.
  - Logout; login as owner; delete ali. Logout; ali login fails.
  - Hammer /login with wrong password 6 times -> 6th -> 429.
  - Cross-tenant probe: as owner of A, GET /owner/staff/{user_id_of_B_waiter} or any tenant-B route -> 404/403.

## F. Constraints
- Do NOT add Supabase JWT for realtime in this phase (noted as stretch).
- Do NOT touch Phase 5 catalog functionality.
- Do NOT modify customer flow except where rate limiting applies.
- Keep RLS changes in a separate SQL file — do NOT enable RLS in Laravel migrations (sqlite would break).
- Soft-deleting users should not break currently logged-in waiter sessions ungracefully — at least redirect to login on next request.

## G. Reporting
Return:
- Decisions (RLS strategy, anon-realtime feature flag, soft-delete on User vs hard delete).
- File diff list.
- Full `php artisan test` output.
- `npm run build` output.
- Manual smoke transcript (incl. rate limit confirmation).
- `database/supabase/rls.sql` summary.
- `docs/SUPABASE_RLS.md` summary.
- Deviations + open questions.
