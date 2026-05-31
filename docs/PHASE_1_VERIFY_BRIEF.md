PHASE 1 RECONCILE + VERIFY — Smart-Table SaaS

Two tasks worked on Phase 1 concurrently and produced overlapping changes. Your job:

## Step 1 — Reconcile
Read the current state of these files and confirm they form a coherent, working Phase 1 foundation. Resolve any leftover inconsistency:
- app/Enums/UserRole.php
- app/Models/User.php (tenant relation, role enum cast, isOwner/isWaiter)
- app/Models/Tenant.php
- app/Models/Scopes/TenantScope.php
- app/Models/Concerns/BelongsToTenant.php
- app/Support/CurrentTenant.php
- app/Http/Middleware/IdentifyTenant.php
- app/Http/Middleware/EnsureRole.php
- app/Services/TenantRegistrationService.php
- app/Http/Controllers/Auth/RegisteredUserController.php
- bootstrap/app.php (tenant + role middleware aliases)
- routes/web.php (owner/waiter route groups, root redirect)
- database/migrations/*tenants*.php
- database/factories/TenantFactory.php, UserFactory.php
- resources/views/auth/register.blade.php (business name field)
- resources/views/layouts/owner.blade.php, waiter.blade.php
- resources/views/owner/dashboard.blade.php, waiter/dashboard.blade.php
- tests/Feature/Tenancy/TenantRegistrationTest.php
- tests/Feature/Authorization/RoleAccessTest.php
- tests/Feature/Auth/RegistrationTest.php

If anything is broken, half-done, or duplicated, fix it minimally.

## Step 2 — Make tests runnable
The local PHP runtime lacks pdo_sqlite. Pick the simplest fix:

Option A (preferred): enable pdo_sqlite extension.
- Find php.ini: `php --ini`
- Uncomment `extension=pdo_sqlite` and `extension=sqlite3`
- Confirm: `php -m | findstr sqlite` shows pdo_sqlite + sqlite3
- If the DLLs are missing entirely from the PHP install, fall back to Option B.

Option B: configure phpunit.xml to use an in-memory pgsql to a local Postgres (if available) OR use the `array` cache + a temp pgsql connection. If Postgres isn't local, document the blocker clearly and skip.

Then run `php artisan test` and capture FULL output.

## Step 3 — Manual smoke (record evidence)
1. `php artisan migrate:fresh` against local dev DB (sqlite is fine for local dev — set DB_CONNECTION=sqlite + touch database/database.sqlite if needed). Capture output.
2. Start `php artisan serve` (port 8000) and `npm run dev` in parallel. Confirm both come up.
3. Use `curl` (or Invoke-WebRequest) to:
   - GET / -> expect redirect to /login
   - GET /login -> 200, contains "Log in"
   - GET /register -> 200, contains "business name" field
   - POST /register with name, business_name, email, password, password_confirmation -> redirect to /owner/dashboard (follow with cookie jar)
   - GET /owner/dashboard authenticated -> 200, contains tenant business name
   - GET /waiter/dashboard authenticated as owner -> 403
4. Stop servers.

## Step 4 — Report
Return:
- Reconcile diff summary (what was inconsistent, what you changed).
- `php artisan test` raw output (all tests must pass — if any fail, fix and rerun).
- Manual smoke transcript (status codes + key snippets).
- Confirmed pass/fail against each Phase 1 acceptance criterion in docs/PHASE_1_BRIEF.md.
- Any deviation from PLAN.md / PHASE_1_BRIEF.md, with justification.

## Constraints
- Do NOT add Phase 2+ features (tables, QR, sessions, products).
- Do NOT touch Supabase Realtime/Storage code.
- Keep changes minimal and focused on making Phase 1 actually verifiable.
