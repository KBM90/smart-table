PHASE 3 IMPLEMENTATION — Anonymous Customer Sessions + Call Waiter

Read docs/PLAN.md (Phase 3) before starting. Project root: C:\Karim\projects\Saas\smart-table.
Phase 1 (auth + tenancy) and Phase 2 (tables + QR + Livewire 3) are DONE & verified. Build on top.

## Goal
A customer scans a table QR -> public Livewire page -> can browse a (placeholder) catalog link + click "Call Waiter" -> creates a request -> sees a live status timer ("Waiting…", "Accepted by {waiter_name}"). Re-scanning the same QR on the same device resumes the session. New device on an occupied table gets blocked. Owner/waiter realtime dashboards land in Phase 4 — for Phase 3, expose a basic owner Requests page (no realtime yet, polling every 3s via `wire:poll` is fine) so we can prove the lifecycle end-to-end.

## A. Migrations

### `table_sessions`
- id
- tenant_id (FK, indexed)
- table_id (FK -> tables, indexed)
- session_token (string 40, unique)
- status (string, default 'active') — 'active' | 'closed'
- started_at (timestamp, default now)
- ended_at (timestamp, nullable)
- timestamps
- index (table_id, status)

### `requests`
- id
- tenant_id (FK, indexed)
- table_session_id (FK -> table_sessions, cascade)
- type (string, default 'call_waiter')
- status (string, default 'pending') — 'pending' | 'accepted' | 'resolved' | 'cancelled'
- accepted_by (FK -> users, nullable)
- accepted_at (timestamp, nullable)
- resolved_at (timestamp, nullable)
- timestamps
- index (tenant_id, status), index (table_session_id)

### Update `tables`
- nothing to change schema-wise; status field already exists. We update it from sessions logic.

## B. Models

### `app/Models/TableSession.php`
- BelongsToTenant, TenantScope.
- Relations: belongsTo Table, belongsTo Tenant, hasMany Request.
- Constants STATUS_ACTIVE, STATUS_CLOSED.
- `isActive()`, `close()` (sets status closed, ended_at, sets parent table to free).
- Auto-generate session_token on create (Str::random(40)).

### `app/Models/Request.php`
- Note: name conflict with `Illuminate\Http\Request`. Rename class to `ServiceRequest` and table stays `requests`. Update everywhere consistently.
- BelongsToTenant, TenantScope.
- Relations: belongsTo TableSession, belongsTo User as 'acceptedBy'.
- Constants for type + status.
- Methods: accept(User), resolve(), cancel().

### Update `Table` model
- hasMany TableSession.
- `activeSession()` -> hasOne with where status=active.
- `markOccupied()`, `markFree()` helpers. `markFree()` also closes any active session.

### Update `Tenant` model
- Add hasMany TableSession, hasMany ServiceRequest relations.

## C. Service: `app/Services/TableSessionService.php`
Methods:
- `resolveOrStart(Table $table, ?string $sessionTokenFromCookie): array{session: TableSession, isNew: bool, blocked: bool}`
  - If table has active session AND token matches -> return {session, isNew:false, blocked:false}
  - If table has active session AND no/different token -> {session, isNew:false, blocked:true}
  - If no active session -> create one, mark table occupied, return {isNew:true}
- `close(TableSession $session)` -> closes session + frees table (atomic transaction).

Use DB transactions + row-level lock (SELECT ... FOR UPDATE; under sqlite tests this is a no-op but use Laravel's `lockForUpdate`).

## D. Public customer routes (no auth, no tenant middleware — tenant resolved from table)
Replace the Phase 2 stub at `/t/{qr_token}` with a Livewire full-page component.

### Routes
- GET `/t/{qr_token}` -> `customer.table` -> Livewire `Customer\TablePage`
- (Internal) Livewire actions handle: callWaiter, cancelRequest. No additional named routes needed.

### Cookie
- Cookie name: `st_session_token` (HTTP-only, SameSite=Lax, 6 hours TTL).
- Set on session create/resume, cleared when session is closed.

## E. Livewire components

### `app/Livewire/Customer/TablePage.php` (full-page)
Mounts with $qrToken. Resolves table (404 if invalid). Calls TableSessionService.
- If `blocked` -> render "This table is currently in use. Please ask a waiter to free it." view, no actions available.
- Else: show table name + tenant name + "Call Waiter" button + "View Catalog" link (link to `/t/{qr_token}/catalog` -> Phase 5 placeholder for now: a simple "Catalog coming soon" page).
- On Call Waiter -> create ServiceRequest with type=call_waiter, status=pending. Component switches to "request status" view.
- Status view shows:
  - Elapsed timer (Alpine, simple `setInterval` updating displayed seconds since `created_at`).
  - Status text live: pending -> "Waiting for a waiter…"; accepted -> "Accepted by {acceptedBy.name}". Uses `wire:poll.3s` to re-fetch the active request from DB.
  - "Cancel request" button (sets status to cancelled, returns to call-waiter view).

### `app/Livewire/Owner/Requests/Index.php` (full-page)
- Lists all current pending+accepted requests for the tenant (sorted oldest first).
- `wire:poll.3s` for now (realtime in Phase 4).
- Each row: table name, status, elapsed time, "Accept" button (visible if pending), "Resolved" button (visible if accepted), "View session" link (just a tooltip is fine).
- Accepting sets accepted_by = auth user, accepted_at = now, status = accepted.
- Resolving sets resolved_at = now, status = resolved.
- Add `/owner/requests` route under existing owner group; add nav link.

### Customer catalog placeholder
- Route `/t/{qr_token}/catalog` -> Blade view "Catalog coming soon. Tenant: {{ tenant.name }}". 404 if invalid token.

## F. Authorization
- Customer routes: NO auth middleware. Validate qr_token resolves to a non-deleted table.
- Owner Requests: existing `[auth, tenant, role:owner]` group.
- ServiceRequest mutations from owner: enforce tenant scope (TenantScope already does it; verify with policy if needed).
- Customer mutations (callWaiter, cancelRequest) must verify the cookie token matches the table's active session — refuse silently otherwise (404/403).

## G. Tests

### `tests/Feature/Customer/CustomerSessionTest.php`
- Free table: GET /t/{token} -> 200, page contains "Call Waiter", new session created, table now occupied.
- Same device (cookie present) re-scan: GET /t/{token} -> 200, same session_id in DB, no new session.
- Different device (no cookie) on occupied table: GET /t/{token} -> 200 but renders "currently in use" view, no new session created.
- Soft-deleted table: 404.

### `tests/Feature/Customer/CallWaiterTest.php`
- With active session: trigger Livewire action `callWaiter` -> ServiceRequest row created with status pending.
- Component now shows status view.
- Cancel request -> request status becomes cancelled, component returns to call-waiter view.
- Cannot create a second pending request while one is already pending for the same session.

### `tests/Feature/Owner/RequestsManagementTest.php`
- Owner sees pending requests for own tenant only (cross-tenant isolation).
- Accept flips status to accepted with accepted_by=owner.id.
- Resolve flips status to resolved with resolved_at set.
- Waiter cannot access /owner/requests yet (403; will get its own dashboard in Phase 4 — for Phase 3, owner only).

### `tests/Feature/TableLifecycleTest.php`
- markFree() on a table closes the active session and sets status free.
- Closing session via service triggers free state.
- New customer can start a fresh session after free.

## H. Acceptance criteria
- `php artisan test` -> all green (existing 45 + new tests).
- `php artisan migrate:fresh` clean.
- Manual smoke (record):
  - As anonymous (cookie jar 1): GET /t/{token of seeded free table} -> 200 with "Call Waiter".
  - In same cookie jar: trigger Livewire callWaiter (use the curl trick: snapshot+update is brittle, so seed a request directly via tinker if needed and document; OR via headless browser if available). At minimum, prove DB state + the index page renders status view via direct route.
  - As anonymous cookie jar 2: GET /t/{same token} -> "currently in use".
  - Login as owner: GET /owner/requests -> sees the pending request.
  - Owner clicks Accept (simulate via tinker or direct DB update in smoke is fine; document) -> request status becomes accepted.
  - Owner: mark table free (action on /owner/tables) -> session closed, table free.
  - GET /t/{same token} again as a fresh cookie jar -> 200, fresh session, "Call Waiter" available.

## I. Constraints
- Do NOT add Supabase Realtime yet. Use `wire:poll.3s` only. Realtime lands in Phase 4.
- Do NOT build the full waiter dashboard yet — owner-only Requests page in Phase 3.
- Do NOT touch product catalog model — Phase 5 (only the "coming soon" stub view).
- Use TenantScope and BelongsToTenant patterns established in Phases 1-2.
- ServiceRequest class name (avoid Illuminate\Http\Request collision). Table name is still `requests`.

## J. Reporting
Return:
- Decisions (cookie strategy, ServiceRequest naming, polling interval).
- File diff list.
- Full `php artisan test` output.
- Manual smoke transcript.
- Any deviation from PLAN.md or this brief with justification.
- Open questions only on real ambiguity.
