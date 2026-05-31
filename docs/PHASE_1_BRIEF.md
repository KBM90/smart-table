PHASE 1 IMPLEMENTATION — Smart-Table SaaS Foundation

Read docs/PLAN.md (full architecture plan) and implement Phase 1 exactly as specified there. Project root: C:\Karim\projects\Saas\smart-table.

## Phase 1 scope (per PLAN.md)
Goal: tenant-aware foundation + staff auth (owner/waiter roles).

## Concrete work
1. Add Laravel auth scaffolding suitable for Blade + Livewire 3 + Alpine + Tailwind v4. Use Laravel Breeze (Blade stack) OR Fortify+Jetstream Livewire — choose the one that pairs cleanest with Livewire 3 and Tailwind v4. Justify your pick in 1-2 lines.
2. Configure Supabase Postgres connection in .env and config/database.php (pgsql with sslmode). Document required env vars in .env.example. Local dev: if Supabase project not yet provisioned, set placeholder values and note them clearly so the owner can fill them.
3. Migrations:
   - tenants (id, name, slug unique nullable, timestamps)
   - users: add tenant_id (FK, nullable) and role (string: owner | waiter), index (tenant_id, role)
4. Models:
   - app/Models/Tenant.php with hasMany(User), hasMany(Table) etc (relations stubbed)
   - app/Models/User.php updated: belongsTo(Tenant), role accessor, isOwner()/isWaiter() helpers
   - app/Models/Concerns/BelongsToTenant.php trait — auto-fills tenant_id on create from auth context
   - app/Models/Scopes/TenantScope.php — global where tenant_id = currentTenantId()
   - app/Support/CurrentTenant.php — resolves tenant from authenticated user, holds it for the request
5. Middleware:
   - app/Http/Middleware/IdentifyTenant.php — resolves and binds CurrentTenant from auth user
   - app/Http/Middleware/EnsureRole.php — accepts role param (owner|waiter), aborts 403 otherwise
   - Register aliases in bootstrap/app.php: 'tenant' and 'role'
6. Tenant-aware owner registration:
   - app/Services/TenantRegistrationService.php — DB transaction creating tenant + first owner user
   - Override the auth registration controller/action to call this service (set role=owner, tenant_id=new tenant.id)
7. Routes (routes/web.php):
   - Public: auth routes (login/register) — registration is for owners only
   - /owner/* group: middleware ['auth','tenant','role:owner'] — minimal placeholder dashboard view "Owner Dashboard — tenant: {{ tenant.name }}"
   - /waiter/* group: middleware ['auth','tenant','role:waiter'] — minimal placeholder "Waiter Dashboard"
   - Root /: redirect to /owner/dashboard if authenticated owner, /waiter/dashboard if waiter, else /login
8. Layouts: minimal Blade layout with Tailwind v4, separate owner/waiter shells (header showing tenant name + logout).
9. Tests (PHPUnit/Pest — match existing project preference):
   - Owner registration creates tenant + owner user; user is logged in.
   - Owner can hit /owner/dashboard.
   - Waiter (manually created in test) cannot access /owner/dashboard (403).
   - Owner cannot access /waiter/dashboard (403).
   - Tenant scope: create two tenants A, B; query as user of A returns only A's records (use a temporary tenant-scoped seed model — even Tenant itself is fine).

## Acceptance criteria (must verify before reporting done)
- `php artisan migrate:fresh` runs cleanly against pgsql (or sqlite fallback for tests is acceptable; document choice).
- `php artisan test` — all new + existing tests green.
- Manual smoke (document with command output / screenshots-as-text):
  - Register a new owner via /register -> redirected to /owner/dashboard, dashboard shows tenant name.
  - Logout, log back in -> same.
  - Hitting /waiter/dashboard as owner -> 403.
- Code review checklist:
  - No tenant_id assignment outside the trait/service.
  - All tenant-bound models use BelongsToTenant trait + TenantScope.
  - No hardcoded role strings outside an enum or constants file.

## Constraints
- Do NOT scaffold tables, products, sessions, requests yet — those are Phase 2/3/5.
- Do NOT implement Supabase Storage / Realtime / QR yet.
- Keep migrations idempotent; do not break existing users table beyond adding nullable columns.
- Use English for code identifiers; UI strings can stay English for now.

## Reporting
When done, return:
- Summary of choices made (auth stack, role storage, registration flow override mechanism).
- Test results (raw output).
- Manual smoke evidence.
- Any deviations from PLAN.md with justification.
- Open questions for the owner (e.g., should waiter self-register? — answer should be NO; waiters created by owner only, but confirm in your report).
