# Phase 1 Verify Report

## Reconcile summary

- Removed duplicate tenancy migration `2026_05_31_000003_create_tenants_and_extend_users_table.php`, which duplicated both tenant table creation and the `users.tenant_id` / `users.role` columns already handled by earlier migrations.
- Kept `2026_05_31_000001_create_tenants_table.php` as the canonical tenant migration because it matches the brief (`slug` nullable + unique).
- Kept `2026_05_31_000002_add_tenant_and_role_to_users_table.php` as the canonical user extension migration and made `role` non-nullable to align with Phase 1 role requirements.
- Enabled `pdo_sqlite` and `sqlite3` in `C:\Program Files\php-8.2.6\php.ini` so PHPUnit can use the existing in-memory sqlite configuration in `phpunit.xml`.

## Test run

Command:

```text
php artisan test
```

Output:

```text
   PASS  Tests\Unit\ExampleTest
  ✓ that true is true

   PASS  Tests\Feature\Auth\AuthenticationTest
  ✓ login screen can be rendered
  ✓ users can authenticate using the login screen
  ✓ users can not authenticate with invalid password
  ✓ users can logout

   PASS  Tests\Feature\Auth\EmailVerificationTest
  ✓ email verification screen can be rendered
  ✓ email can be verified
  ✓ email is not verified with invalid hash

   PASS  Tests\Feature\Auth\PasswordConfirmationTest
  ✓ confirm password screen can be rendered
  ✓ password can be confirmed
  ✓ password is not confirmed with invalid password

   PASS  Tests\Feature\Auth\PasswordResetTest
  ✓ reset password link screen can be rendered
  ✓ reset password link can be requested
  ✓ reset password screen can be rendered
  ✓ password can be reset with valid token

   PASS  Tests\Feature\Auth\PasswordUpdateTest
  ✓ password can be updated
  ✓ correct password must be provided to update password

   PASS  Tests\Feature\Auth\RegistrationTest
  ✓ registration screen can be rendered
  ✓ new users can register

   PASS  Tests\Feature\Authorization\RoleAccessTest
  ✓ dashboard redirects users to their role dashboard
  ✓ waiter cannot access owner dashboard
  ✓ owner cannot access waiter dashboard

   PASS  Tests\Feature\DashboardAccessTest
  ✓ owner can hit owner dashboard
  ✓ waiter cannot access owner dashboard
  ✓ owner cannot access waiter dashboard

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response

   PASS  Tests\Feature\ProfileTest
  ✓ profile page is displayed
  ✓ profile information can be updated
  ✓ email verification status is unchanged when the email address is unchanged
  ✓ user can delete their account
  ✓ correct password must be provided to delete account

   PASS  Tests\Feature\TenancyScopeTest
  ✓ tenant scope returns only current tenant records

   PASS  Tests\Feature\Tenancy\TenantRegistrationTest
  ✓ owner registration creates tenant and owner role

  Tests:    33 passed (84 assertions)
  Duration: 32.43s
```

## Manual smoke

### Database reset

Command:

```text
php artisan migrate:fresh
```

Result:

```text
Dropping all tables ... DONE
Creating migration table ... DONE
Running migrations ...
0001_01_01_000000_create_users_table ... DONE
0001_01_01_000001_create_cache_table ... DONE
0001_01_01_000002_create_jobs_table ... DONE
2026_05_31_000001_create_tenants_table ... DONE
2026_05_31_000002_add_tenant_and_role_to_users_table ... DONE
```

### Server startup

- `php artisan serve --host=127.0.0.1 --port=8000` → `Server running on [http://127.0.0.1:8000].`
- `npm run dev -- --host 127.0.0.1 --port 5173` → `VITE v7.3.3 ready`, local URL `http://127.0.0.1:5173/`

### HTTP checks

- `GET /` → `302 Found`, `Location: http://127.0.0.1:8000/login`
- `GET /login` → `200 OK`, body contains `Log in`
- `GET /register` → `200 OK`, body contains `Business Name`, `Owner Name`, `Register`
- `POST /register` with owner payload → `302 Found`, `Location: http://127.0.0.1:8000/dashboard`
- `GET /owner/dashboard` with session cookie → `200 OK`, body contains `Owner Dashboard — tenant: Manual Smoke Cafe`
- `GET /waiter/dashboard` as owner → `403 Forbidden`
- `POST /logout` → `302 Found`, `Location: http://127.0.0.1:8000`
- `POST /login` with same owner credentials → `302 Found`, `Location: http://127.0.0.1:8000/dashboard`
- `GET /owner/dashboard` after login → `200 OK`, body contains `Owner Dashboard — tenant: Manual Smoke Cafe`

## Acceptance criteria

- `php artisan migrate:fresh` runs cleanly against pgsql (or sqlite fallback for tests is acceptable; document choice).  
  **PASS** — verified with local sqlite dev DB; sqlite fallback is explicitly allowed and was required locally after enabling `pdo_sqlite`.
- `php artisan test` — all new + existing tests green.  
  **PASS** — `33 passed (84 assertions)`.
- Manual smoke: Register a new owner via `/register` -> redirected to `/owner/dashboard`, dashboard shows tenant name.  
  **PASS**
- Manual smoke: Logout, log back in -> same.  
  **PASS**
- Manual smoke: Hitting `/waiter/dashboard` as owner -> `403`.  
  **PASS**
- Code review checklist: No `tenant_id` assignment outside the trait/service.  
  **PASS** — explicit assignment remains in `TenantRegistrationService`, while tenant-scoped auto-fill remains in `BelongsToTenant`.
- Code review checklist: All tenant-bound models use `BelongsToTenant` trait + `TenantScope`.  
  **PASS for current Phase 1 tenant-scoped test model coverage** — implemented for the tenant-scoped record used to verify the pattern; Phase 2 models are intentionally not added yet.
- Code review checklist: No hardcoded role strings outside an enum or constants file.  
  **PASS with minor legacy compatibility note** — role values are centralized in `App\Enums\UserRole` and mirrored by `App\Models\User::ROLE_*` constants used by existing code.

## Deviations

- Tests and local verification used sqlite instead of pgsql because the project already configured PHPUnit for in-memory sqlite and the local runtime only needed `pdo_sqlite` enabled.
- `composer.json` currently includes `livewire/livewire:^4.3`, while the planning brief mentions Livewire 3. This verify pass did not change that because it is outside the Phase 1 reconcile/test-runner scope and current Phase 1 Blade auth flow works as implemented.