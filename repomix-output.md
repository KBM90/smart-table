This file is a merged representation of the entire codebase, combined into a single document by Repomix.

# File Summary

## Purpose
This file contains a packed representation of the entire repository's contents.
It is designed to be easily consumable by AI systems for analysis, code review,
or other automated processes.

## File Format
The content is organized as follows:
1. This summary section
2. Repository information
3. Directory structure
4. Repository files (if enabled)
5. Multiple file entries, each consisting of:
  a. A header with the file path (## File: path/to/file)
  b. The full contents of the file in a code block

## Usage Guidelines
- This file should be treated as read-only. Any changes should be made to the
  original repository files, not this packed version.
- When processing this file, use the file path to distinguish
  between different files in the repository.
- Be aware that this file may contain sensitive information. Handle it with
  the same level of security as you would the original repository.

## Notes
- Some files may have been excluded based on .gitignore rules and Repomix's configuration
- Binary files are not included in this packed representation. Please refer to the Repository Structure section for a complete list of file paths, including binary files
- Files matching patterns in .gitignore are excluded
- Files matching default ignore patterns are excluded
- Files are sorted by Git change count (files with more changes are at the bottom)

# Directory Structure
```
.editorconfig
.env.example
.env.production.example
.gitattributes
.github/workflows/ci.yml
.gitignore
app/Enums/UserRole.php
app/Http/Controllers/Auth/AuthenticatedSessionController.php
app/Http/Controllers/Auth/ConfirmablePasswordController.php
app/Http/Controllers/Auth/EmailVerificationNotificationController.php
app/Http/Controllers/Auth/EmailVerificationPromptController.php
app/Http/Controllers/Auth/NewPasswordController.php
app/Http/Controllers/Auth/PasswordController.php
app/Http/Controllers/Auth/PasswordResetLinkController.php
app/Http/Controllers/Auth/RegisteredUserController.php
app/Http/Controllers/Auth/VerifyEmailController.php
app/Http/Controllers/Controller.php
app/Http/Controllers/Customers/CustomerRequestController.php
app/Http/Controllers/Owner/DashboardController.php
app/Http/Controllers/Owner/TableQrCodeController.php
app/Http/Controllers/ProfileController.php
app/Http/Controllers/Waiter/TableAssignmentController.php
app/Http/Middleware/EnsureRole.php
app/Http/Middleware/IdentifyTenant.php
app/Http/Requests/Auth/LoginRequest.php
app/Http/Requests/ProfileUpdateRequest.php
app/Livewire/Customer/Catalog.php
app/Livewire/Customer/TablePage.php
app/Livewire/Owner/Categories/Form.php
app/Livewire/Owner/Categories/Index.php
app/Livewire/Owner/DashboardRequests.php
app/Livewire/Owner/Products/Form.php
app/Livewire/Owner/Products/Index.php
app/Livewire/Owner/Requests/Index.php
app/Livewire/Owner/Staff/Form.php
app/Livewire/Owner/Staff/Index.php
app/Livewire/Owner/Tables/Form.php
app/Livewire/Owner/Tables/Index.php
app/Livewire/Owner/Tables/QrPreview.php
app/Livewire/Waiter/Requests/Index.php
app/Livewire/Waiter/Tables/Index.php
app/Models/Category.php
app/Models/Concerns/BelongsToTenant.php
app/Models/Product.php
app/Models/ProductCategory.php
app/Models/Scopes/TenantScope.php
app/Models/ServiceRequest.php
app/Models/Table.php
app/Models/TableSession.php
app/Models/Tenant.php
app/Models/User.php
app/Policies/ProductCategoryPolicy.php
app/Policies/ProductPolicy.php
app/Policies/ServiceRequestPolicy.php
app/Policies/TablePolicy.php
app/Policies/TableSessionPolicy.php
app/Policies/UserPolicy.php
app/Providers/AppServiceProvider.php
app/Services/ProductImageService.php
app/Services/QrCodeService.php
app/Services/ServiceRequestService.php
app/Services/TableSessionService.php
app/Services/TenantRegistrationService.php
app/Support/ComponentRateLimiter.php
app/Support/CurrentTenant.php
app/Support/LibraryImage.php
app/View/Components/AppLayout.php
app/View/Components/GuestLayout.php
artisan
bootstrap/app.php
bootstrap/cache/.gitignore
bootstrap/providers.php
composer.json
config/app.php
config/auth.php
config/cache.php
config/database.php
config/filesystems.php
config/image_library.php
config/logging.php
config/mail.php
config/queue.php
config/services.php
config/session.php
cookies.txt
database/.gitignore
database/factories/ProductFactory.php
database/factories/ServiceRequestFactory.php
database/factories/TableFactory.php
database/factories/TableSessionFactory.php
database/factories/TenantFactory.php
database/factories/UserFactory.php
database/migrations/0001_01_01_000000_create_users_table.php
database/migrations/0001_01_01_000001_create_cache_table.php
database/migrations/0001_01_01_000002_create_jobs_table.php
database/migrations/2026_05_31_000001_create_tenants_table.php
database/migrations/2026_05_31_000002_add_tenant_and_role_to_users_table.php
database/migrations/2026_05_31_000003_create_tables_table.php
database/migrations/2026_05_31_000004_create_table_sessions_table.php
database/migrations/2026_05_31_000005_create_requests_table.php
database/migrations/2026_05_31_000006_create_products_table.php
database/migrations/2026_05_31_000007_add_deleted_at_to_users_table.php
database/migrations/2026_05_31_000008_create_categories_table.php
database/migrations/2026_06_07_000001_create_product_categories_table.php
database/migrations/2026_06_07_000002_add_category_id_to_products_table.php
database/migrations/2026_06_09_000001_create_table_waiter_table.php
database/seeders/CategorySeeder.php
database/seeders/DatabaseSeeder.php
database/supabase/rls.sql
deploy.sh
docs/DEPLOY_HOSTINGER.md
docs/LOCAL_SUPABASE_SETUP.md
docs/PHASE_1_BRIEF.md
docs/PHASE_1_VERIFY_BRIEF.md
docs/PHASE_1_VERIFY_REPORT.md
docs/PHASE_2_BRIEF.md
docs/PHASE_3_BRIEF.md
docs/PHASE_4_BRIEF.md
docs/PHASE_5_BRIEF.md
docs/PHASE_5_NOTES.md
docs/PHASE_6_BRIEF.md
docs/PHASE_7_BRIEF.md
docs/PLAN.md
docs/PLANNING_BRIEF.md
docs/SMOKE_CHECKLIST.md
docs/SUPABASE_RLS.md
docs/SUPABASE_WIREUP_BRIEF.md
package.json
phpunit.xml
post-after-fix.txt
postcss.config.js
public/.htaccess
public/favicon.ico
public/img/library/_placeholder.png
public/img/library/cappuccino.jpg
public/img/library/drink-6.jpg
public/img/library/espresso.jpg
public/img/library/food-1.jpg
public/img/library/food-2.jpg
public/img/library/food-3.jpg
public/img/library/food-4.jpg
public/img/library/food-5.jpg
public/img/library/food-6.jpg
public/img/library/ice-tea.jpg
public/img/library/iced-coffee.jpg
public/img/library/pizza-1.jpg
public/img/library/smoothie.jpg
public/img/library/soda.jpg
public/img/library/tea-maroc.jpeg
public/index.php
public/robots.txt
README.md
register.html
resources/css/app.css
resources/js/app.js
resources/js/bootstrap.js
resources/js/realtime.js
resources/views/auth/confirm-password.blade.php
resources/views/auth/forgot-password.blade.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/auth/reset-password.blade.php
resources/views/auth/verify-email.blade.php
resources/views/components/application-logo.blade.php
resources/views/components/auth-session-status.blade.php
resources/views/components/danger-button.blade.php
resources/views/components/dropdown-link.blade.php
resources/views/components/dropdown.blade.php
resources/views/components/input-error.blade.php
resources/views/components/input-label.blade.php
resources/views/components/modal.blade.php
resources/views/components/nav-link.blade.php
resources/views/components/primary-button.blade.php
resources/views/components/responsive-nav-link.blade.php
resources/views/components/secondary-button.blade.php
resources/views/components/text-input.blade.php
resources/views/customer/catalog.blade.php
resources/views/layouts/app.blade.php
resources/views/layouts/customer.blade.php
resources/views/layouts/guest.blade.php
resources/views/layouts/navigation.blade.php
resources/views/layouts/owner.blade.php
resources/views/layouts/waiter.blade.php
resources/views/livewire/customer/catalog.blade.php
resources/views/livewire/customer/table-page.blade.php
resources/views/livewire/owner/categories/form.blade.php
resources/views/livewire/owner/categories/index.blade.php
resources/views/livewire/owner/dashboard-requests.blade.php
resources/views/livewire/owner/products/form.blade.php
resources/views/livewire/owner/products/index.blade.php
resources/views/livewire/owner/requests/index.blade.php
resources/views/livewire/owner/staff/form.blade.php
resources/views/livewire/owner/staff/index.blade.php
resources/views/livewire/owner/tables/form.blade.php
resources/views/livewire/owner/tables/index.blade.php
resources/views/livewire/owner/tables/qr-preview.blade.php
resources/views/livewire/waiter/requests/index.blade.php
resources/views/livewire/waiter/tables/index.blade.php
resources/views/owner/dashboard.blade.php
resources/views/partials/realtime-config.blade.php
resources/views/profile/edit.blade.php
resources/views/profile/partials/delete-user-form.blade.php
resources/views/profile/partials/update-password-form.blade.php
resources/views/profile/partials/update-profile-information-form.blade.php
resources/views/waiter/dashboard.blade.php
resources/views/welcome.blade.php
routes/auth.php
routes/console.php
routes/web.php
storage/app/.gitignore
storage/app/private/.gitignore
storage/app/public/.gitignore
storage/framework/.gitignore
storage/framework/cache/.gitignore
storage/framework/cache/data/.gitignore
storage/framework/sessions/.gitignore
storage/framework/testing/.gitignore
storage/framework/views/.gitignore
storage/logs/.gitignore
tailwind.config.js
tests/Feature/Auth/AuthenticationTest.php
tests/Feature/Auth/EmailVerificationTest.php
tests/Feature/Auth/PasswordConfirmationTest.php
tests/Feature/Auth/PasswordResetTest.php
tests/Feature/Auth/PasswordUpdateTest.php
tests/Feature/Auth/RegistrationTest.php
tests/Feature/Authorization/PoliciesTest.php
tests/Feature/Authorization/RoleAccessTest.php
tests/Feature/Customer/CallWaiterTest.php
tests/Feature/Customer/CatalogTest.php
tests/Feature/Customer/CustomerSessionTest.php
tests/Feature/DashboardAccessTest.php
tests/Feature/ExampleTest.php
tests/Feature/Owner/ProductImageTest.php
tests/Feature/Owner/ProductsTest.php
tests/Feature/Owner/RequestsManagementTest.php
tests/Feature/Owner/StaffManagementTest.php
tests/Feature/Owner/TableQrDownloadTest.php
tests/Feature/Owner/TablesTest.php
tests/Feature/Production/ConfigSanityTest.php
tests/Feature/ProfileTest.php
tests/Feature/Realtime/RealtimeAnonDisabledTest.php
tests/Feature/Realtime/RealtimeConfigTest.php
tests/Feature/Security/RateLimitTest.php
tests/Feature/TableLifecycleTest.php
tests/Feature/Tenancy/CrossTenantHardeningTest.php
tests/Feature/Tenancy/TenantRegistrationTest.php
tests/Feature/TenancyScopeTest.php
tests/Feature/Waiter/WaiterRequestsTest.php
tests/TestCase.php
tests/Unit/ExampleTest.php
vite.config.js
```

# Files

## File: .editorconfig
````
root = true

[*]
charset = utf-8
end_of_line = lf
indent_size = 4
indent_style = space
insert_final_newline = true
trim_trailing_whitespace = true

[*.md]
trim_trailing_whitespace = false

[*.{yml,yaml}]
indent_size = 2

[compose.yaml]
indent_size = 4
````

## File: .env.example
````
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=db.your-supabase-project.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-supabase-db-password
DB_SCHEMA=public
DB_SSLMODE=require
SUPABASE_URL=
SUPABASE_ANON_KEY=
SUPABASE_SERVICE_ROLE_KEY=
SUPABASE_REALTIME_ANON_ENABLED=false
SUPABASE_BUCKET=
SUPABASE_S3_ENDPOINT=
SUPABASE_REGION=us-east-1
SUPABASE_S3_KEY=
SUPABASE_S3_SECRET=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
````

## File: .gitattributes
````
* text=auto eol=lf

*.blade.php diff=html
*.css diff=css
*.html diff=html
*.md diff=markdown
*.php diff=php

/.github export-ignore
CHANGELOG.md export-ignore
.styleci.yml export-ignore
````

## File: .github/workflows/ci.yml
````yaml
name: ci

on:
  push:
  pull_request:

jobs:
  test:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v4

      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mbstring, pdo_sqlite, pdo_pgsql, curl, fileinfo, gd, zip
          coverage: none

      - uses: actions/setup-node@v4
        with:
          node-version: '20'
          cache: 'npm'

      - name: Install PHP dependencies
        run: composer install --no-interaction --prefer-dist

      - name: Install Node dependencies
        run: npm ci

      - name: Prepare application
        run: |
          cp .env.example .env
          php artisan key:generate

      - name: Build assets
        run: npm run build

      - name: Run tests
        run: php artisan test
````

## File: app/Enums/UserRole.php
````php
<?php

namespace App\Enums;

enum UserRole: string
{
    case Owner = 'owner';
    case Waiter = 'waiter';
}
````

## File: app/Http/Controllers/Auth/ConfirmablePasswordController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
````

## File: app/Http/Controllers/Auth/EmailVerificationNotificationController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
````

## File: app/Http/Controllers/Auth/EmailVerificationPromptController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }
}
````

## File: app/Http/Controllers/Auth/NewPasswordController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
````

## File: app/Http/Controllers/Auth/PasswordController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
````

## File: app/Http/Controllers/Auth/PasswordResetLinkController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
    }
}
````

## File: app/Http/Controllers/Auth/RegisteredUserController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TenantRegistrationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'business_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = app(TenantRegistrationService::class)->registerOwner([
            'tenant_name' => $request->string('business_name')->toString(),
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->toString(),
            'password' => $request->string('password')->toString(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
````

## File: app/Http/Controllers/Auth/VerifyEmailController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
````

## File: app/Http/Controllers/Controller.php
````php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;
}
````

## File: app/Http/Controllers/Customers/CustomerRequestController.php
````php
<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\TableSession;
use App\Support\ComponentRateLimiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerRequestController extends Controller
{
    public const SESSION_COOKIE = 'st_session_token';

    /**
     * POST /api/table/request
     * Body: { session_id: int }
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate(['session_id' => ['required', 'integer']]);

        $session = $this->authorizedActiveSession(
            $request->integer('session_id'),
            $request->cookie(self::SESSION_COOKIE),
        );

        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        // Idempotent — return existing open request if one exists
        $existing = $this->currentOpenRequest($session);
        if ($existing !== null) {
            return response()->json([
                'id' => $existing->getKey(),
                'status' => $existing->status,
                'requests_ahead' => $this->countAhead($existing),
            ]);
        }

        // Mark table occupied
        $session->table()->withoutGlobalScopes()->first()?->markOccupied();

        // Resolve stale pending/accepted requests for this table across all sessions
        ServiceRequest::withoutGlobalScopes()
            ->whereHas('tableSession', fn($q) => $q->where('table_id', $session->table_id))
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->update(['status' => ServiceRequest::STATUS_RESOLVED, 'resolved_at' => now()]);

        $serviceRequest = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $session->tenant_id,
            'table_session_id' => $session->getKey(),
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        return response()->json([
            'id' => $serviceRequest->getKey(),
            'status' => $serviceRequest->status,
            'requests_ahead' => 0,
        ], Response::HTTP_CREATED);
    }

    /**
     * DELETE /api/table/request/{id}
     * Body: { session_id: int }
     */
    public function cancel(Request $request, int $id): JsonResponse
    {
        $request->validate(['session_id' => ['required', 'integer']]);

        $session = $this->authorizedActiveSession(
            $request->integer('session_id'),
            $request->cookie(self::SESSION_COOKIE),
        );

        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        $serviceRequest = ServiceRequest::withoutGlobalScopes()
            ->whereKey($id)
            ->where('table_session_id', $session->getKey())
            ->first();

        if ($serviceRequest !== null) {
            $serviceRequest->cancel();
        }

        return response()->json(['ok' => true]);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function authorizedActiveSession(int $sessionId, ?string $cookieToken): TableSession
    {
        $session = TableSession::withoutGlobalScopes()
            ->whereKey($sessionId)
            ->where('status', TableSession::STATUS_ACTIVE)
            ->firstOrFail();

        abort_unless(
            $cookieToken !== null && hash_equals($session->session_token, $cookieToken),
            Response::HTTP_FORBIDDEN,
        );

        return $session;
    }

    private function currentOpenRequest(TableSession $session): ?ServiceRequest
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('table_session_id', $session->getKey())
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->oldest('created_at')
            ->first();
    }

    private function countAhead(ServiceRequest $request): int
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('tenant_id', $request->tenant_id)
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->where('created_at', '<', $request->created_at)
            ->count();
    }
}
````

## File: app/Http/Controllers/Owner/DashboardController.php
````php
<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request): \Illuminate\View\View
    {
        $tenantId = $request->user()->tenant_id;

        return view('owner.dashboard', [
            'pendingCount' => $this->pendingCount($tenantId),
            'avgResponseForHumans' => $this->avgResponseForHumans($tenantId),
            'activeSessionsCount' => $this->activeSessionsCount($tenantId),
            'completionRate' => $this->completionRate($tenantId),
        ]);
    }

    // ---------------------------------------------------------------------------
    // Stat helpers
    // ---------------------------------------------------------------------------

    private function pendingCount(int $tenantId): int
    {
        return DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->where('status', 'pending')
            ->count();
    }

    private function avgResponseForHumans(int $tenantId): ?string
    {
        $avgSeconds = DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->whereNotNull('accepted_at')
            ->whereDate('created_at', today())
            ->selectRaw('AVG(EXTRACT(EPOCH FROM (accepted_at - created_at))) as avg_seconds')
            ->value('avg_seconds');

        if ($avgSeconds === null) {
            return null;
        }

        $total = (int) round($avgSeconds);
        $minutes = intdiv($total, 60);
        $seconds = $total % 60;

        return $minutes > 0 ? "{$minutes}m {$seconds}s" : "{$seconds}s";
    }

    private function activeSessionsCount(int $tenantId): int
    {
        return DB::table('table_sessions')
            ->where('tenant_id', $tenantId)
            ->where('status', 'active')
            ->count();
    }

    private function completionRate(int $tenantId): float
    {
        $since = now()->subHours(24);

        $total = DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->where('created_at', '>=', $since)
            ->count();

        if ($total === 0) {
            return 100.0;
        }

        $resolved = DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->where('status', 'resolved')
            ->where('created_at', '>=', $since)
            ->count();

        return round(($resolved / $total) * 100, 1);
    }
}
````

## File: app/Http/Controllers/Owner/TableQrCodeController.php
````php
<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Services\QrCodeService;
use Illuminate\Http\Response;

class TableQrCodeController extends Controller
{
    public function __invoke(Table $table, QrCodeService $qrCodeService): Response
    {
        $this->authorize('view', $table);

        return response($qrCodeService->pngFor($table), 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="table-'.$table->id.'-qr.png"',
        ]);
    }
}
````

## File: app/Http/Controllers/ProfileController.php
````php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
````

## File: app/Http/Middleware/EnsureRole.php
````php
<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if ($user === null) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $requiredRole = UserRole::tryFrom($role);

        if ($requiredRole === null || $user->role?->value !== $requiredRole->value) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
````

## File: app/Http/Middleware/IdentifyTenant.php
````php
<?php

namespace App\Http\Middleware;

use App\Support\CurrentTenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = app(CurrentTenant::class)->resolveFromAuth();

        if ($request->user() !== null && $tenant === null) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
````

## File: app/Http/Requests/Auth/LoginRequest.php
````php
<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
````

## File: app/Http/Requests/ProfileUpdateRequest.php
````php
<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}
````

## File: app/Livewire/Owner/Categories/Form.php
````php
<?php

namespace App\Livewire\Owner\Categories;

use App\Models\ProductCategory;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;

class Form extends Component
{
    public ?int $categoryId = null;

    public string $name = '';

    public int $sortOrder = 0;

    public function mount(?int $categoryId = null): void
    {
        $this->categoryId = $categoryId;

        if ($categoryId === null) {
            $this->authorize('create', ProductCategory::class);
            return;
        }

        $category = ProductCategory::query()->find($categoryId);
        abort_if($category === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $category);

        $this->name      = $category->name;
        $this->sortOrder = $category->sort_order;
    }

    public function save(): void
    {
        if ($this->categoryId === null) {
            $this->authorize('create', ProductCategory::class);
        }

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('product_categories', 'name')
                    ->where(fn ($q) => $q->where('tenant_id', auth()->user()->tenant_id)->whereNull('deleted_at'))
                    ->ignore($this->categoryId),
            ],
            'sortOrder' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);

        $category = $this->categoryId === null
            ? new ProductCategory(['tenant_id' => auth()->user()->tenant_id])
            : ProductCategory::query()->find($this->categoryId);

        abort_if($category === null, Response::HTTP_NOT_FOUND);

        if ($this->categoryId !== null) {
            $this->authorize('update', $category);
        }

        try {
            $category->forceFill([
                'name'       => $validated['name'],
                'sort_order' => $validated['sortOrder'],
            ])->save();
        } catch (UniqueConstraintViolationException) {
            $this->addError('name', 'A category with this name already exists.');
            return;
        }

        $this->dispatch('category-saved', categoryId: $category->id);
    }

    public function render()
    {
        return view('livewire.owner.categories.form');
    }
}
````

## File: app/Livewire/Owner/Categories/Index.php
````php
<?php

namespace App\Livewire\Owner\Categories;

use App\Models\ProductCategory;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.owner')]
class Index extends Component
{
    public ?int $editingCategoryId = null;

    public bool $showForm = false;

    public function createCategory(): void
    {
        $this->authorize('create', ProductCategory::class);
        $this->editingCategoryId = null;
        $this->showForm = true;
    }

    public function editCategory(int $categoryId): void
    {
        $category = ProductCategory::query()->find($categoryId);
        abort_if($category === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $category);

        $this->editingCategoryId = $categoryId;
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->editingCategoryId = null;
        $this->showForm = false;
    }

    public function handleSaved(int $categoryId): void
    {
        $this->editingCategoryId = $categoryId;
        $this->showForm = false;
    }

    public function deleteCategory(int $categoryId): void
    {
        $category = ProductCategory::query()->find($categoryId);
        abort_if($category === null, Response::HTTP_NOT_FOUND);
        $this->authorize('delete', $category);

        $category->delete();

        if ($this->editingCategoryId === $categoryId) {
            $this->closeForm();
        }
    }

    public function render()
    {
        $categories = ProductCategory::query()
            ->withCount('products')
            ->get();

        return view('livewire.owner.categories.index', [
            'categories' => $categories,
        ]);
    }
}
````

## File: app/Livewire/Owner/DashboardRequests.php
````php
<?php

namespace App\Livewire\Owner;

use App\Models\ServiceRequest;
use App\Support\ComponentRateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\On;
use Livewire\Component;

class DashboardRequests extends Component
{
    #[On('refresh')]
    public function refreshRequests(): void
    {
    }

    public function acceptRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('accept', $request);
        $request->accept(auth()->user());
    }

    public function resolveRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('resolve', $request);
        $request->resolve();
    }

    public function render()
    {
        return view('livewire.owner.dashboard-requests', [
            'requests' => ServiceRequest::query()
                ->with(['tableSession.table', 'acceptedBy'])
                ->whereIn('status', [
                    ServiceRequest::STATUS_PENDING,
                    ServiceRequest::STATUS_ACCEPTED,
                ])
                ->oldest('created_at')
                ->limit(5)
                ->get(),
        ]);
    }
}
````

## File: app/Livewire/Owner/Requests/Index.php
````php
<?php

namespace App\Livewire\Owner\Requests;

use App\Models\ServiceRequest;
use App\Support\ComponentRateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.owner')]
class Index extends Component
{
    #[On('refresh')]
    public function refreshRequests(): void
    {
    }

    public function acceptRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('accept', $request);
        $request->accept(auth()->user());
    }

    public function resolveRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('resolve', $request);
        $request->resolve();
    }

    public function render()
    {
        return view('livewire.owner.requests.index', [
            'requests' => ServiceRequest::query()
                ->with(['tableSession.table', 'acceptedBy'])
                ->whereIn('status', [
                    ServiceRequest::STATUS_PENDING,
                    ServiceRequest::STATUS_ACCEPTED,
                ])
                ->oldest('created_at')
                ->get(),
        ]);
    }
}
````

## File: app/Livewire/Owner/Tables/QrPreview.php
````php
<?php

namespace App\Livewire\Owner\Tables;

use App\Models\Table;
use App\Services\QrCodeService;
use Livewire\Component;

class QrPreview extends Component
{
    public int $tableId;

    public function render(QrCodeService $qrCodeService)
    {
        $table = Table::query()->findOrFail($this->tableId);
        $this->authorize('view', $table);

        return view('livewire.owner.tables.qr-preview', [
            'table' => $table,
            'qrDataUrl' => $qrCodeService->dataUrlFor($table),
        ]);
    }
}
````

## File: app/Livewire/Waiter/Tables/Index.php
````php
<?php

namespace App\Livewire\Waiter\Tables;

use App\Models\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.waiter')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    public function toggleAssignment(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, 404);

        $user = auth()->user();

        if ($table->assignedWaiters()->where('users.id', $user->getKey())->exists()) {
            $table->assignedWaiters()->detach($user->getKey());
        } else {
            $table->assignedWaiters()->syncWithoutDetaching([$user->getKey()]);
        }
    }

    public function render()
    {
        $userId = auth()->id();

        $tables = Table::query()
            ->with(['assignedWaiters' => fn($q) => $q->select('users.id')])
            ->when($this->search !== '', fn(Builder $q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.waiter.tables.index', [
            'tables' => $tables,
            'currentUserId' => $userId,
        ]);
    }
}
````

## File: app/Models/Category.php
````php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('category_order', function (Builder $builder): void {
            $builder->orderBy('sort_order')->orderBy('name');
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
````

## File: app/Models/Concerns/BelongsToTenant.php
````php
<?php

namespace App\Models\Concerns;

use App\Models\Scopes\TenantScope;
use App\Models\Tenant;
use App\Support\CurrentTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTenant
{
    public static function bootBelongsToTenant(): void
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function (Model $model): void {
            $tenantId = app(CurrentTenant::class)->id();

            if ($tenantId !== null) {
                $model->setAttribute('tenant_id', $tenantId);
            }
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
````

## File: app/Models/ProductCategory.php
````php
<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use BelongsToTenant, HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'name',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('category_order', function (Builder $builder): void {
            $builder->orderBy('sort_order')->orderBy('name');
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
````

## File: app/Models/Scopes/TenantScope.php
````php
<?php

namespace App\Models\Scopes;

use App\Support\CurrentTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $tenantId = app(CurrentTenant::class)->id();

        if ($tenantId === null) {
            return;
        }

        $builder->where($model->qualifyColumn('tenant_id'), $tenantId);
    }
}
````

## File: app/Models/Tenant.php
````php
<?php

namespace App\Models;

use Database\Factories\TenantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    /** @use HasFactory<TenantFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class);
    }

    public function tableSessions(): HasMany
    {
        return $this->hasMany(TableSession::class);
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
````

## File: app/Policies/ProductCategoryPolicy.php
````php
<?php

namespace App\Policies;

use App\Models\ProductCategory;
use App\Models\User;

class ProductCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, ProductCategory $category): bool
    {
        return $user->isOwner() && $user->tenant_id === $category->tenant_id;
    }

    public function update(User $user, ProductCategory $category): bool
    {
        return $user->isOwner() && $user->tenant_id === $category->tenant_id;
    }

    public function delete(User $user, ProductCategory $category): bool
    {
        return $user->isOwner() && $user->tenant_id === $category->tenant_id;
    }
}
````

## File: app/Policies/ProductPolicy.php
````php
<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, Product $product): bool
    {
        return $user->isOwner() && $user->tenant_id === $product->tenant_id;
    }

    public function update(User $user, Product $product): bool
    {
        return $user->isOwner() && $user->tenant_id === $product->tenant_id;
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->isOwner() && $user->tenant_id === $product->tenant_id;
    }
}
````

## File: app/Policies/TablePolicy.php
````php
<?php

namespace App\Policies;

use App\Models\Table;
use App\Models\User;

class TablePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, Table $table): bool
    {
        return $user->isOwner() && $user->tenant_id === $table->tenant_id;
    }

    public function update(User $user, Table $table): bool
    {
        return $user->isOwner() && $user->tenant_id === $table->tenant_id;
    }

    public function delete(User $user, Table $table): bool
    {
        return $user->isOwner() && $user->tenant_id === $table->tenant_id;
    }
}
````

## File: app/Policies/TableSessionPolicy.php
````php
<?php

namespace App\Policies;

use App\Models\TableSession;
use App\Models\User;

class TableSessionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->tenant_id !== null;
    }

    public function view(User $user, TableSession $tableSession): bool
    {
        return $user->tenant_id !== null && $user->tenant_id === $tableSession->tenant_id;
    }

    public function close(User $user, TableSession $tableSession): bool
    {
        return $user->isOwner()
            && $user->tenant_id !== null
            && $user->tenant_id === $tableSession->tenant_id
            && $tableSession->isActive();
    }
}
````

## File: app/Policies/UserPolicy.php
````php
<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, User $staff): bool
    {
        return $user->isOwner() && $user->tenant_id === $staff->tenant_id;
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function delete(User $user, User $staff): bool
    {
        return $user->isOwner()
            && $user->tenant_id === $staff->tenant_id
            && $staff->isWaiter()
            && $user->getKey() !== $staff->getKey();
    }
}
````

## File: app/Services/TenantRegistrationService.php
````php
<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantRegistrationService
{
    /**
     * @param  array{name: string, email: string, password: string, tenant_name: string}  $attributes
     */
    public function registerOwner(array $attributes): User
    {
        return DB::transaction(function () use ($attributes): User {
            $tenant = Tenant::create([
                'name' => $attributes['tenant_name'],
                'slug' => $this->uniqueSlug($attributes['tenant_name']),
            ]);

            return User::create([
                'tenant_id' => $tenant->id,
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'password' => Hash::make($attributes['password']),
                'role' => UserRole::Owner->value,
            ]);
        });
    }

    protected function uniqueSlug(string $tenantName): ?string
    {
        $baseSlug = Str::slug($tenantName);

        if ($baseSlug === '') {
            return null;
        }

        $slug = $baseSlug;
        $suffix = 2;

        while (Tenant::query()->where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
````

## File: app/Support/ComponentRateLimiter.php
````php
<?php

namespace App\Support;

use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ComponentRateLimiter
{
    public function ensureCustomerActionLimit(string $sessionToken): void
    {
        $key = $this->customerKey($sessionToken);

        if (RateLimiter::tooManyAttempts($key, 30)) {
            abort(Response::HTTP_TOO_MANY_REQUESTS);
        }

        RateLimiter::hit($key, 60);
    }

    public function ensureStaffActionLimit(int|string|null $userId): void
    {
        $key = 'staff-actions|'.($userId ?? 'guest');

        if (RateLimiter::tooManyAttempts($key, 60)) {
            abort(Response::HTTP_TOO_MANY_REQUESTS);
        }

        RateLimiter::hit($key, 60);
    }

    protected function customerKey(string $sessionToken): string
    {
        return 'customer-actions|'.request()->ip().'|'.$sessionToken;
    }
}
````

## File: app/Support/LibraryImage.php
````php
<?php

namespace App\Support;

/**
 * Resolves image-library config keys to display URLs.
 *
 * Keys are Unsplash photo IDs stored in config/image_library.php.
 * The helper builds a CDN URL that works without any API key for
 * display/thumbnail purposes.
 */
class LibraryImage
{
    /**
     * Default thumbnail dimensions used across the application.
     */
    public const DEFAULT_WIDTH = 400;
    public const DEFAULT_HEIGHT = 400;

    /**
     * Resolve a library key (Unsplash photo ID) to a fully qualified URL.
     *
     * Falls back to the local placeholder when the key is empty/null so
     * callers never receive a broken image source.
     */
    public static function url(?string $key, int $width = self::DEFAULT_WIDTH, int $height = self::DEFAULT_HEIGHT): string
    {
        if (empty($key)) {
            return asset('img/library/_placeholder.png');
        }

        // Already a full URL (e.g. legacy entries or future-proof external URLs)
        if (str_starts_with($key, 'http://') || str_starts_with($key, 'https://')) {
            return $key;
        }

        // Legacy local path support (library/food-1.jpg) kept for any rows
        // that were stored before the Unsplash migration.
        if (str_contains($key, '/') || str_ends_with($key, '.jpg') || str_ends_with($key, '.png')) {
            return asset('img/' . ltrim($key, '/'));
        }

        // Unsplash photo ID — build the CDN URL directly (no API key needed).
        return sprintf(
            'https://images.unsplash.com/photo-%s?auto=format&fit=crop&w=%d&h=%d&q=80',
            $key,
            $width,
            $height,
        );
    }

    /**
     * Return a larger version of the same photo for full-size display.
     */
    public static function fullUrl(?string $key, int $width = 800, int $height = 600): string
    {
        return static::url($key, $width, $height);
    }

    /**
     * Retrieve the full library config array.
     *
     * @return array<int, array{key: string, label: string}>
     */
    public static function all(): array
    {
        return config('image_library', []);
    }

    /**
     * Check whether a key exists in the configured library.
     */
    public static function exists(string $key): bool
    {
        return collect(static::all())->pluck('key')->contains($key);
    }
}
````

## File: app/View/Components/AppLayout.php
````php
<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
````

## File: app/View/Components/GuestLayout.php
````php
<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
````

## File: artisan
````
#!/usr/bin/env php
<?php

use Illuminate\Foundation\Application;
use Symfony\Component\Console\Input\ArgvInput;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel and handle the command...
/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

$status = $app->handleCommand(new ArgvInput);

exit($status);
````

## File: bootstrap/cache/.gitignore
````
*
!.gitignore
````

## File: bootstrap/providers.php
````php
<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
];
````

## File: config/auth.php
````php
<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | which utilizes session storage plus the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent the model / table. These providers may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These configuration options specify the behavior of Laravel's password
    | reset functionality, including the table utilized for token storage
    | and the user provider that is invoked to actually retrieve users.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the number of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
````

## File: config/cache.php
````php
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    */

    'default' => env('CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "array", "database", "file", "memcached",
    |                    "redis", "dynamodb", "octane",
    |                    "failover", "null"
    |
    */

    'stores' => [

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_CACHE_CONNECTION'),
            'table' => env('DB_CACHE_TABLE', 'cache'),
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
            'lock_table' => env('DB_CACHE_LOCK_TABLE'),
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
            'lock_connection' => env('REDIS_CACHE_LOCK_CONNECTION', 'default'),
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        'octane' => [
            'driver' => 'octane',
        ],

        'failover' => [
            'driver' => 'failover',
            'stores' => [
                'database',
                'array',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing the APC, database, memcached, Redis, and DynamoDB cache
    | stores, there might be other applications using the same cache. For
    | that reason, you may prefix every cache key to avoid collisions.
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-cache-'),

];
````

## File: config/database.php
````php
<?php

use Illuminate\Support\Str;
use Pdo\Mysql;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
            'transaction_mode' => 'DEFERRED',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'db.your-supabase-project.supabase.co'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'postgres'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => env('DB_SCHEMA', 'public'),
            'sslmode' => env('DB_SSLMODE', 'require'),
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

    ],

];
````

## File: config/logging.php
````php
<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that is utilized to write
    | messages to your logs. The value provided here should match one of
    | the channels present in the list of "channels" configured below.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Laravel
    | utilizes the Monolog PHP logging library, which includes a variety
    | of powerful log handlers and formatters that you're free to use.
    |
    | Available drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog", "custom", "stack"
    |
    */

    'channels' => [

        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', (string) env('LOG_STACK', 'single')),
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAILY_DAYS', 14),
            'replace_placeholders' => true,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', env('APP_NAME', 'Laravel')),
            'emoji' => env('LOG_SLACK_EMOJI', ':boom:'),
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'handler_with' => [
                'stream' => 'php://stderr',
            ],
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => env('LOG_SYSLOG_FACILITY', LOG_USER),
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

    ],

];
````

## File: config/mail.php
````php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Laravel')),
    ],

];
````

## File: config/queue.php
````php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue supports a variety of backends via a single, unified
    | API, giving you convenient access to each backend using identical
    | syntax for each. The default queue connection is defined below.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection options for every queue backend
    | used by your application. An example configuration is provided for
    | each backend supported by Laravel. You're also free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis",
    |          "deferred", "background", "failover", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_QUEUE_CONNECTION'),
            'table' => env('DB_QUEUE_TABLE', 'jobs'),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int) env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => env('BEANSTALKD_QUEUE_HOST', 'localhost'),
            'queue' => env('BEANSTALKD_QUEUE', 'default'),
            'retry_after' => (int) env('BEANSTALKD_QUEUE_RETRY_AFTER', 90),
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for' => null,
            'after_commit' => false,
        ],

        'deferred' => [
            'driver' => 'deferred',
        ],

        'background' => [
            'driver' => 'background',
        ],

        'failover' => [
            'driver' => 'failover',
            'connections' => [
                'database',
                'deferred',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Job Batching
    |--------------------------------------------------------------------------
    |
    | The following options configure the database and table that store job
    | batching information. These options can be updated to any database
    | connection and table which has been defined by your application.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control how and where failed jobs are stored. Laravel ships with
    | support for storing failed jobs in a simple file or in a database.
    |
    | Supported drivers: "database-uuids", "dynamodb", "file", "null"
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];
````

## File: config/services.php
````php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'supabase' => [
        'url' => env('SUPABASE_URL'),
        'anon_key' => env('SUPABASE_ANON_KEY'),
        'service_role' => env('SUPABASE_SERVICE_ROLE_KEY'),
        'realtime_anon_enabled' => env('SUPABASE_REALTIME_ANON_ENABLED', false),
        'bucket' => env('SUPABASE_BUCKET'),
        's3_endpoint' => env('SUPABASE_S3_ENDPOINT'),
        'region' => env('SUPABASE_REGION', 'us-east-1'),
        's3_key' => env('SUPABASE_S3_KEY'),
        's3_secret' => env('SUPABASE_S3_SECRET'),
    ],

];
````

## File: config/session.php
````php
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | This option determines the default session driver that is utilized for
    | incoming requests. Laravel supports a variety of storage options to
    | persist session data. Database storage is a great default choice.
    |
    | Supported: "file", "cookie", "database", "memcached",
    |            "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes that you wish the session
    | to be allowed to remain idle before it expires. If you want them
    | to expire immediately when the browser is closed then you may
    | indicate that via the expire_on_close configuration option.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | This option allows you to easily specify that all of your session data
    | should be encrypted before it's stored. All encryption is performed
    | automatically by Laravel and you may use the session like normal.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | When utilizing the "file" session driver, the session files are placed
    | on disk. The default storage location is defined here; however, you
    | are free to provide another location where they should be stored.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Connection
    |--------------------------------------------------------------------------
    |
    | When using the "database" or "redis" session drivers, you may specify a
    | connection that should be used to manage these sessions. This should
    | correspond to a connection in your database configuration options.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Table
    |--------------------------------------------------------------------------
    |
    | When using the "database" session driver, you may specify the table to
    | be used to store sessions. Of course, a sensible default is defined
    | for you; however, you're welcome to change this to another table.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Cache Store
    |--------------------------------------------------------------------------
    |
    | When using one of the framework's cache driven session backends, you may
    | define the cache store which should be used to store the session data
    | between requests. This must match one of your defined cache stores.
    |
    | Affects: "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    |
    | Some session drivers must manually sweep their storage location to get
    | rid of old sessions from storage. Here are the chances that it will
    | happen on a given request. By default, the odds are 2 out of 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Here you may change the name of the session cookie that is created by
    | the framework. Typically, you should not need to change this value
    | since doing so does not grant a meaningful security improvement.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    |
    | The session cookie path determines the path for which the cookie will
    | be regarded as available. Typically, this will be the root path of
    | your application, but you're free to change this when necessary.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    |
    | This value determines the domain and subdomains the session cookie is
    | available to. By default, the cookie will be available to the root
    | domain without subdomains. Typically, this shouldn't be changed.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | By setting this option to true, session cookies will only be sent back
    | to the server if the browser has a HTTPS connection. This will keep
    | the cookie from being sent to you when it can't be done securely.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Access Only
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will prevent JavaScript from accessing the
    | value of the cookie and the cookie will only be accessible through
    | the HTTP protocol. It's unlikely you should disable this option.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | take place, and can be used to mitigate CSRF attacks. By default, we
    | will set this value to "lax" to permit secure cross-site requests.
    |
    | See: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Supported: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Partitioned Cookies
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will tie the cookie to the top-level site for
    | a cross-site context. Partitioned cookies are accepted by the browser
    | when flagged "secure" and the Same-Site attribute is set to "none".
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
````

## File: cookies.txt
````
# Netscape HTTP Cookie File
# https://curl.se/docs/http-cookies.html
# This file was generated by libcurl! Edit at your own risk.

127.0.0.1	FALSE	/	FALSE	1780284345	XSRF-TOKEN	eyJpdiI6Ikt3U1ExVmpOR1U0d01aaHcyak9PM3c9PSIsInZhbHVlIjoicVlSRmtBVC94bjd4VWVDRkpYaEx6Q3c5eEREVkNZVkJNRlZkdGp6YittSEdYRUZRV1BJaktOcVZPRTE1K2Nqb25TUWpudTIya3BWQkhEMHQvOVQ5VHVMbkh1aXl0eDN3R2NWOGt4UE5JSnd2R2F3MDMvRVhqUjVRcDRVWG1VSWIiLCJtYWMiOiJjOTdkZTFkMDc5NTQxNTI0ZjQ3ZGQ3Zjg2MjNmNDYzMzRkODdiNTI4YTdmMWUwZDhiZDhhZDI2NDE0MGMyYzMzIiwidGFnIjoiIn0%3D
#HttpOnly_127.0.0.1	FALSE	/	FALSE	1780284345	smart-table-session	eyJpdiI6InBGYk9kT2lGNzZwV3YvSkRqN0RkNlE9PSIsInZhbHVlIjoiNDhlZG5WQVBVSlgzWVpWcjUrQkI0a3pjdm9lOU50MGlSUVFxU2E0N0RnOEdGUDJNcjNYRTBJWGFRbU41MjNMOTl0QmFOSGU3NERWLzBsMjM5cDVULzc1bEcraTBjUkExZUwwRVZuWDNpSTNzbHp1V05qZkdrL0xuWUJtamcvNTciLCJtYWMiOiI5NDQ5ZTdmNjU0YjkxM2I3NjRkN2U0NTAzMTllNzg4NDhlYjRkZjlhYTM1MmY3ZTRjZDdmZTExZGM4OWQ1NWQ0IiwidGFnIjoiIn0%3D
````

## File: database/.gitignore
````
*.sqlite*
````

## File: database/factories/ProductFactory.php
````php
<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'name' => fake()->unique()->words(2, true),
            'description' => fake()->sentence(),
            'price_cents' => fake()->numberBetween(200, 2500),
            'image_source' => Product::IMAGE_SOURCE_NONE,
            'image_path' => null,
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
````

## File: database/factories/ServiceRequestFactory.php
````php
<?php

namespace Database\Factories;

use App\Models\ServiceRequest;
use App\Models\TableSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceRequest>
 */
class ServiceRequestFactory extends Factory
{
    protected $model = ServiceRequest::class;

    public function definition(): array
    {
        $session = TableSession::factory()->create();

        return [
            'tenant_id' => $session->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
            'accepted_by' => null,
            'accepted_at' => null,
            'resolved_at' => null,
        ];
    }

    public function accepted(?User $user = null): static
    {
        return $this->state(function (array $attributes) use ($user): array {
            $acceptedBy = $user ?? User::factory()->owner();

            return [
                'status' => ServiceRequest::STATUS_ACCEPTED,
                'accepted_by' => $acceptedBy,
                'accepted_at' => now(),
            ];
        });
    }
}
````

## File: database/factories/TableFactory.php
````php
<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Table>
 */
class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition(): array
    {
        static $sequence = 1;

        return [
            'tenant_id' => Tenant::factory(),
            'name' => 'Table '.$sequence++,
            'status' => Table::STATUS_FREE,
        ];
    }
}
````

## File: database/factories/TableSessionFactory.php
````php
<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TableSession>
 */
class TableSessionFactory extends Factory
{
    protected $model = TableSession::class;

    public function definition(): array
    {
        $table = Table::factory()->create();

        return [
            'tenant_id' => $table->tenant_id,
            'table_id' => $table->id,
            'session_token' => Str::random(40),
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
            'ended_at' => null,
        ];
    }

    public function closed(): static
    {
        return $this->state(fn () => [
            'status' => TableSession::STATUS_CLOSED,
            'ended_at' => now(),
        ]);
    }
}
````

## File: database/factories/TenantFactory.php
````php
<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        $company = fake()->unique()->company();

        return [
            'name' => $company,
            'slug' => Str::slug($company),
        ];
    }
}
````

## File: database/factories/UserFactory.php
````php
<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'tenant_id' => null,
            'role' => UserRole::Owner->value,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function owner(?Tenant $tenant = null): static
    {
        return $this->state(fn () => [
            'tenant_id' => ($tenant ?? Tenant::factory()->create())->id,
            'role' => UserRole::Owner->value,
        ]);
    }

    public function waiter(?Tenant $tenant = null): static
    {
        return $this->state(fn () => [
            'tenant_id' => ($tenant ?? Tenant::factory()->create())->id,
            'role' => UserRole::Waiter->value,
        ]);
    }
}
````

## File: database/migrations/0001_01_01_000000_create_users_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
````

## File: database/migrations/0001_01_01_000001_create_cache_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration')->index();
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
````

## File: database/migrations/0001_01_01_000002_create_jobs_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
````

## File: database/migrations/2026_05_31_000001_create_tenants_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
````

## File: database/migrations/2026_05_31_000002_add_tenant_and_role_to_users_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('role')->after('password');
            $table->index(['tenant_id', 'role']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['tenant_id', 'role']);
            $table->dropConstrainedForeignId('tenant_id');
            $table->dropColumn('role');
        });
    }
};
````

## File: database/migrations/2026_05_31_000003_create_tables_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete()->index();
            $table->string('name');
            $table->string('qr_token', 32)->unique()->index();
            $table->string('status')->default('free');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['tenant_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
````

## File: database/migrations/2026_05_31_000007_add_deleted_at_to_users_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
````

## File: database/migrations/2026_05_31_000008_create_categories_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
````

## File: database/migrations/2026_06_07_000001_create_product_categories_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
````

## File: database/migrations/2026_06_09_000001_create_table_waiter_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('table_waiter', function (Blueprint $table): void {
            $table->foreignId('table_id')
                ->constrained('tables')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->primary(['table_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_waiter');
    }
};
````

## File: database/seeders/CategorySeeder.php
````php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Starters', 'slug' => 'starters', 'sort_order' => 1],
            ['name' => 'Soups & Salads', 'slug' => 'soups-salads', 'sort_order' => 2],
            ['name' => 'Main Course', 'slug' => 'main-course', 'sort_order' => 3],
            ['name' => 'Pizza & Pasta', 'slug' => 'pizza-pasta', 'sort_order' => 4],
            ['name' => 'Sandwiches & Wraps', 'slug' => 'sandwiches-wraps', 'sort_order' => 5],
            ['name' => 'Desserts', 'slug' => 'desserts', 'sort_order' => 6],
            ['name' => 'Hot Beverages', 'slug' => 'hot-beverages', 'sort_order' => 7],
            ['name' => 'Cold Beverages', 'slug' => 'cold-beverages', 'sort_order' => 8],
            ['name' => 'Cocktails & Mocktails', 'slug' => 'cocktails-mocktails', 'sort_order' => 9],
            ['name' => 'Specials', 'slug' => 'specials', 'sort_order' => 10],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insertOrIgnore([
                ...$category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
````

## File: database/supabase/rls.sql
````sql
BEGIN;

DO $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'bypass_rls') THEN
        CREATE ROLE bypass_rls NOLOGIN BYPASSRLS;
    END IF;
END
$$;

COMMENT ON ROLE bypass_rls IS 'Grant this role to the Laravel database user before enabling RLS so server-side queries bypass Supabase defense-in-depth policies.';

ALTER TABLE public.tenants ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.users ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.tables ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.table_sessions ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.requests ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.products ENABLE ROW LEVEL SECURITY;

DROP POLICY IF EXISTS tenants_tenant_isolation_select ON public.tenants;
DROP POLICY IF EXISTS tenants_tenant_isolation_insert ON public.tenants;
DROP POLICY IF EXISTS tenants_tenant_isolation_update ON public.tenants;
DROP POLICY IF EXISTS tenants_tenant_isolation_delete ON public.tenants;
CREATE POLICY tenants_tenant_isolation_select ON public.tenants FOR SELECT
    USING (id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tenants_tenant_isolation_insert ON public.tenants FOR INSERT
    WITH CHECK (id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tenants_tenant_isolation_update ON public.tenants FOR UPDATE
    USING (id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tenants_tenant_isolation_delete ON public.tenants FOR DELETE
    USING (id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS users_tenant_isolation_select ON public.users;
DROP POLICY IF EXISTS users_tenant_isolation_insert ON public.users;
DROP POLICY IF EXISTS users_tenant_isolation_update ON public.users;
DROP POLICY IF EXISTS users_tenant_isolation_delete ON public.users;
CREATE POLICY users_tenant_isolation_select ON public.users FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY users_tenant_isolation_insert ON public.users FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY users_tenant_isolation_update ON public.users FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY users_tenant_isolation_delete ON public.users FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS tables_tenant_isolation_select ON public.tables;
DROP POLICY IF EXISTS tables_tenant_isolation_insert ON public.tables;
DROP POLICY IF EXISTS tables_tenant_isolation_update ON public.tables;
DROP POLICY IF EXISTS tables_tenant_isolation_delete ON public.tables;
CREATE POLICY tables_tenant_isolation_select ON public.tables FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tables_tenant_isolation_insert ON public.tables FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tables_tenant_isolation_update ON public.tables FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tables_tenant_isolation_delete ON public.tables FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS table_sessions_tenant_isolation_select ON public.table_sessions;
DROP POLICY IF EXISTS table_sessions_tenant_isolation_insert ON public.table_sessions;
DROP POLICY IF EXISTS table_sessions_tenant_isolation_update ON public.table_sessions;
DROP POLICY IF EXISTS table_sessions_tenant_isolation_delete ON public.table_sessions;
CREATE POLICY table_sessions_tenant_isolation_select ON public.table_sessions FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY table_sessions_tenant_isolation_insert ON public.table_sessions FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY table_sessions_tenant_isolation_update ON public.table_sessions FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY table_sessions_tenant_isolation_delete ON public.table_sessions FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS requests_tenant_isolation_select ON public.requests;
DROP POLICY IF EXISTS requests_tenant_isolation_insert ON public.requests;
DROP POLICY IF EXISTS requests_tenant_isolation_update ON public.requests;
DROP POLICY IF EXISTS requests_tenant_isolation_delete ON public.requests;
CREATE POLICY requests_tenant_isolation_select ON public.requests FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY requests_tenant_isolation_insert ON public.requests FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY requests_tenant_isolation_update ON public.requests FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY requests_tenant_isolation_delete ON public.requests FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS products_tenant_isolation_select ON public.products;
DROP POLICY IF EXISTS products_tenant_isolation_insert ON public.products;
DROP POLICY IF EXISTS products_tenant_isolation_update ON public.products;
DROP POLICY IF EXISTS products_tenant_isolation_delete ON public.products;
CREATE POLICY products_tenant_isolation_select ON public.products FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY products_tenant_isolation_insert ON public.products FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY products_tenant_isolation_update ON public.products FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY products_tenant_isolation_delete ON public.products FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

COMMENT ON POLICY requests_tenant_isolation_select ON public.requests IS 'Anon Supabase realtime remains effectively disabled because browser clients do not set app.current_tenant_id in v1.';
COMMENT ON POLICY table_sessions_tenant_isolation_select ON public.table_sessions IS 'Anon Supabase realtime remains effectively disabled because browser clients do not set app.current_tenant_id in v1.';

COMMIT;
````

## File: deploy.sh
````bash
#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"

php artisan optimize:clear
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
npm ci
npm run build
php artisan migrate --force

if [ ! -L public/storage ] && [ ! -e public/storage ]; then
    php artisan storage:link
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
````

## File: docs/DEPLOY_HOSTINGER.md
````markdown
# Hostinger deployment runbook

This runbook applies to the Smart Table SaaS project at `C:\Karim\projects\Saas\smart-table`.

## Deployment position

- Recommended target: Hostinger VPS
- Fallback target: Hostinger shared hosting
- Database: Supabase Postgres via pooler transaction mode on port `6543`
- File storage: Supabase Storage via S3-compatible endpoint
- Browser realtime: disabled for anon clients in production with `SUPABASE_REALTIME_ANON_ENABLED=false`
- Live updates in production: Livewire polling fallback

## Files involved

- Production env template: `C:\Karim\projects\Saas\smart-table\.env.production.example`
- Deploy script: `C:\Karim\projects\Saas\smart-table\deploy.sh`
- RLS SQL: `C:\Karim\projects\Saas\smart-table\database\supabase\rls.sql`
- Smoke checklist: `C:\Karim\projects\Saas\smart-table\docs\SMOKE_CHECKLIST.md`
- Architecture context: `C:\Karim\projects\Saas\smart-table\docs\PLAN.md`

## Supabase one-time setup checklist

1. Create the Supabase project.
2. Copy the project URL, anon key, and service role key.
3. Open Supabase project settings and collect Postgres pooler credentials.
4. Use transaction mode on port `6543` for production.
5. Create the Storage bucket named `product-images` and make it public.
6. In Supabase Storage settings, create S3 credentials and copy:
   - access key
   - secret
   - endpoint
7. Apply `C:\Karim\projects\Saas\smart-table\database\supabase\rls.sql` in the Supabase SQL editor after granting `BYPASSRLS` to the Laravel database user.
8. Verify RLS by attempting a `SELECT` as the anon role and confirming access is denied.

## Environment file

Start from `C:\Karim\projects\Saas\smart-table\.env.production.example`.

Important production values:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://your-domain.tld`
- `DB_CONNECTION=pgsql`
- `DB_PORT=6543`
- `DB_SSLMODE=require`
- `SESSION_DRIVER=database`
- `CACHE_STORE=database`
- `QUEUE_CONNECTION=database`
- `BROADCAST_CONNECTION=null`
- `FILESYSTEM_DISK=public`
- `SUPABASE_REALTIME_ANON_ENABLED=false`
- `TRUSTED_PROXIES=*`

`TRUSTED_PROXIES=*` is supported by the application bootstrap so Hostinger proxy headers are trusted when the env value is set.

## Build and deploy pipeline

Production order:

1. `composer install --no-dev --optimize-autoloader`
2. `npm ci`
3. `npm run build`
4. `php artisan migrate --force`
5. `php artisan storage:link`
6. `php artisan config:cache`
7. `php artisan route:cache`
8. `php artisan view:cache`
9. `php artisan event:cache`

For VPS usage, run `./deploy.sh`.

## Hostinger VPS

### Recommended server shape

- Ubuntu 22.04
- PHP 8.2
- Nginx
- Composer 2
- Node.js 20+
- Supervisor

### PHP extensions

Install these extensions:

- `pdo_pgsql`
- `gd`
- `mbstring`
- `openssl`
- `curl`
- `fileinfo`
- `zip`

### Nginx server block example

```nginx
server {
    listen 80;
    server_name your-domain.tld www.your-domain.tld;
    root /var/www/smart-table/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Supervisor queue worker

```ini
[program:smart-table-queue]
command=/usr/bin/php /var/www/smart-table/artisan queue:work --sleep=3 --tries=3 --timeout=90
directory=/var/www/smart-table
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/smart-table/storage/logs/queue-worker.log
```

### Cron

Run Laravel scheduler every minute:

```cron
* * * * * cd /var/www/smart-table && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

### TLS

Use Hostinger's panel-managed TLS or Certbot.

### Storage link

On VPS, `php artisan storage:link` should work normally and create `public/storage`.

## Hostinger shared hosting

### Supported but limited

Shared hosting is a fallback only.

Limitations:

- no long-running queue workers
- queue processing should prefer `sync` if background work becomes necessary
- scheduler must be configured through Hostinger cron UI
- `public/storage` symlink creation may be blocked
- Composer is often easier to run locally, then upload `vendor/`

### Shared-hosting recommendations

- keep `SUPABASE_REALTIME_ANON_ENABLED=false`
- rely on Livewire polling fallback
- if queue workers are unavailable, use `QUEUE_CONNECTION=sync`
- upload prebuilt assets from `public/build`
- if `composer install` is not available on-host, build locally and upload the generated `vendor/` directory

### Storage workaround when symlinks are blocked

If `php artisan storage:link` fails on shared hosting:

1. point the web server or Hostinger public path so `/storage/*` can resolve to `storage/app/public/*`, or
2. use a lightweight `public/storage/.htaccess` rewrite/proxy strategy handled by the shared Apache environment

The VPS path remains the preferred deployment because it avoids this workaround.

## Session, cache, and queue tables

The repo already includes migrations for:

- `sessions`
- `cache`
- `cache_locks`
- `jobs`
- `job_batches`
- `failed_jobs`

Run:

```bash
php artisan migrate --force
```

## Operational commands

Clear caches before a fresh deploy:

```bash
php artisan optimize:clear
```

Rebuild caches after the deploy:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## Recovery notes

### Realtime degradation

Production is intentionally configured with anon realtime disabled. If browsers cannot open websocket subscriptions or RLS blocks anon access, the app stays correct because:

- owner request screens poll
- waiter request screens poll
- customer request status polls

### Storage failures

If Supabase Storage S3 credentials are missing or invalid:

- local/public image handling still exists for non-production fallback
- production should be treated as misconfigured until `SUPABASE_BUCKET`, `SUPABASE_S3_ENDPOINT`, `SUPABASE_S3_KEY`, and `SUPABASE_S3_SECRET` are corrected

### Proxy/TLS issues

If HTTPS redirects or secure cookies behave incorrectly behind Hostinger:

- verify `APP_URL`
- verify `SESSION_SECURE_COOKIE=true`
- verify `TRUSTED_PROXIES=*`

## Post-deploy smoke test

Run the checklist in `C:\Karim\projects\Saas\smart-table\docs\SMOKE_CHECKLIST.md`.
````

## File: docs/PHASE_1_BRIEF.md
````markdown
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
````

## File: docs/PHASE_1_VERIFY_BRIEF.md
````markdown
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
````

## File: docs/PHASE_1_VERIFY_REPORT.md
````markdown
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
````

## File: docs/PHASE_2_BRIEF.md
````markdown
PHASE 2 IMPLEMENTATION — Tables + QR Lifecycle + Livewire 3 install

Read docs/PLAN.md (Phase 2 section) before starting. Project root: C:\Karim\projects\Saas\smart-table. Phase 1 is already complete (tenancy, auth, owner/waiter dashboards). Build on top of it.

## Work items

### A. Install Livewire 3 (was deferred from Phase 1)
- `composer require livewire/livewire:^3.0`
- `php artisan livewire:publish --config` (optional)
- Confirm @livewireStyles / @livewireScripts directives are added to base layouts (layouts/owner.blade.php, layouts/waiter.blade.php, layouts/app.blade.php — wherever needed).
- Smoke: create a tiny Livewire component (e.g. `Owner\HelloLivewire`) on the owner dashboard, confirm it renders + a wire:click counter works locally; then remove or keep as a debug component. Document.

### B. QR code package
- Install `simplesoftwareio/simple-qrcode` (works on PHP 8.2, no GD-only dependency issues) OR `bacon/bacon-qr-code` if Imagick is available. Pick one and justify.

### C. Migration: tables
File: `database/migrations/2026_..._create_tables_table.php`
Columns:
- id
- tenant_id (FK -> tenants, cascade delete, indexed)
- name (string, required) — e.g. "Table 5", "T-12"
- qr_token (string 32, unique, indexed)
- status (string, default 'free') — values: 'free' | 'occupied'
- timestamps
- soft deletes (so owners can "remove" without losing historical data)

Constraints: unique(tenant_id, name) so two tables in same tenant can't have same label.

### D. Model: app/Models/Table.php
- `use HasFactory, SoftDeletes, BelongsToTenant;`
- Apply TenantScope global scope.
- Fillable: name, status. tenant_id auto-set by trait.
- `qr_token` auto-generated on create (32-char URL-safe, e.g. `Str::random(32)`) if not provided. Ensure uniqueness with retry on collision.
- Constants for status: STATUS_FREE, STATUS_OCCUPIED.
- Relations: `belongsTo(Tenant::class)`.
- `getPublicUrl()` -> route('customer.table', ['qr_token' => $this->qr_token]).

### E. Factory: database/factories/TableFactory.php
- Default: tenant via Tenant::factory(), name "Table {n}", status free.

### F. Service: app/Services/QrCodeService.php
- `pngFor(Table $table): string` returns PNG bytes (base64 not needed — return raw).
- `dataUrlFor(Table $table): string` for inline preview.
- Size + margin configurable; default 512px, margin 2.

### G. Livewire components (Owner)
File-based or class. Use Livewire 3 conventions.
- `app/Livewire/Owner/Tables/Index.php` — paginated list, search by name, status filter, "Create table" button (opens form modal or route), per-row "Edit", "Delete" (soft), "Mark Free", "Download QR (PNG)".
- `app/Livewire/Owner/Tables/Form.php` — create/edit a single table (just `name` is editable; `qr_token` auto, `status` read-only here — managed by sessions in later phases, plus manual "Mark Free" action).
- `app/Livewire/Owner/Tables/QrPreview.php` — shows QR + name + public URL + Download button.

Views under `resources/views/livewire/owner/tables/`.

### H. Routes (routes/web.php)
Inside the existing owner group `[auth, tenant, role:owner]`:
- GET `/owner/tables` -> Owner\Tables\Index (Livewire full-page)
- GET `/owner/tables/{table}/qr.png` -> controller action returning the PNG (signed not required, but enforce tenant scope via route model binding + middleware)

Public (no auth):
- GET `/t/{qr_token}` named `customer.table` -> stub view "Welcome to {{ table.tenant.name }} — Table {{ table.name }}". Real customer flow lands in Phase 3.
- 404 if qr_token doesn't match any non-deleted table.

### I. Owner dashboard nav
Update `layouts/owner.blade.php` (or partial) to include a "Tables" link to `/owner/tables`.

### J. Authorization
- Tenant scope already auto-filters Table queries.
- Add a Policy `app/Policies/TablePolicy.php` (only `update`, `delete`, `view` — all simply check $user->tenant_id === $table->tenant_id and $user->isOwner()).
- Register policy in AuthServiceProvider (or auto-discovery).

### K. Tests
`tests/Feature/Owner/TablesTest.php`:
- owner can create a table with a name; qr_token is generated and unique.
- duplicate name in same tenant fails validation.
- duplicate name across tenants is allowed.
- owner can soft-delete a table; deleted table is not in index.
- owner cannot see another tenant's tables (create tenants A,B; assert).
- owner cannot edit/delete another tenant's table (assert 403/404).
- waiter cannot access /owner/tables (403).

`tests/Feature/Customer/TableScanStubTest.php`:
- GET /t/{valid-qr-token} -> 200, contains tenant name + table name.
- GET /t/{nonexistent-token} -> 404.
- GET /t/{soft-deleted-table-token} -> 404.

`tests/Feature/Owner/TableQrDownloadTest.php`:
- GET /owner/tables/{table}/qr.png authenticated owner -> 200, content-type image/png, body length > 100 bytes.
- Cross-tenant: owner of A requesting B's table QR -> 403/404.

### L. Acceptance criteria
- `php artisan test` -> all green (existing 33 + new tests).
- `php artisan migrate:fresh` runs cleanly.
- Manual smoke (record output):
  - Login as owner.
  - Create 3 tables.
  - Open one's QR preview, download PNG (verify file > 0 bytes).
  - Visit /t/{that_qr_token} in incognito -> stub welcome page shows tenant + table name.
  - Visit /t/garbage -> 404.
  - Login as a manually-seeded waiter -> /owner/tables -> 403.
  - Cross-tenant: seed second tenant + owner; ensure first owner's tables list doesn't include second tenant's tables.

## Constraints
- Do NOT implement table_sessions, requests, customer call-waiter flow, or realtime — Phase 3+.
- Do NOT touch product catalog — Phase 5.
- Keep Livewire 3 install changes minimal; goal is to wire it in cleanly so subsequent phases can use it.
- All identifiers in English. UI strings English for now.
- Use the TenantScope + BelongsToTenant patterns established in Phase 1 — do NOT reinvent.

## Reporting
Return:
- Decisions (QR package choice + why, Livewire layout integration approach).
- File diff list (added/modified/deleted).
- `php artisan test` raw output.
- Manual smoke transcript (curl or Invoke-WebRequest with cookie jar).
- Any deviation from this brief or PLAN.md with justification.
- Open questions only if a real ambiguity exists.
````

## File: docs/PHASE_3_BRIEF.md
````markdown
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
````

## File: docs/PHASE_4_BRIEF.md
````markdown
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
````

## File: docs/PHASE_5_BRIEF.md
````markdown
PHASE 5 IMPLEMENTATION — Product Catalog + Image Upload + Built-in Image Library

Read docs/PLAN.md (Phase 5) before starting. Project root: C:\Karim\projects\Saas\smart-table.
Phases 1-4 complete and verified. 64 tests passing. Build on top.

## Goal
Owners can manage a product catalog (CRUD: name, price, image, description, active flag, sort order). Images come from one of two sources:
1. Upload from device -> stored in Supabase Storage (production) or local `storage/app/public/products/` (local dev fallback when Supabase Storage env not set).
2. Pick from a built-in image library shipped with the app (`/public/img/library/*.jpg` or similar) — pre-seeded with ~12-20 generic café/restaurant stock images.

Customer page consumes the catalog at `/t/{qr_token}/catalog` (was a "coming soon" stub in Phase 3 — replace with the real list now). Browse-only, no ordering checkout.

## A. Migration: products
File: `database/migrations/2026_..._create_products_table.php`
Columns:
- id
- tenant_id (FK -> tenants, cascade, indexed)
- name (string, required)
- description (text, nullable)
- price_cents (integer, required) — store cents to avoid float issues. Currency assumed single-currency-per-tenant for v1; add `tenant.currency_code` later (Phase 7 polish).
- image_source (string, default 'none') — 'none' | 'upload' | 'library'
- image_path (string, nullable) — for 'upload': storage path; for 'library': library key like `library/coffee-1.jpg`
- is_active (boolean, default true)
- sort_order (integer, default 0)
- timestamps
- soft deletes
- index (tenant_id, is_active, sort_order)
- unique (tenant_id, name) — same-name product not allowed within a tenant

## B. Model: app/Models/Product.php
- BelongsToTenant + TenantScope.
- Constants for IMAGE_SOURCE_NONE/UPLOAD/LIBRARY.
- `priceFormatted()` accessor -> "12.50" from price_cents.
- `imageUrl()` accessor -> resolves source:
  - 'upload' -> Storage::disk(config('filesystems.product_disk'))->url($image_path)
  - 'library' -> asset('img/library/'.basename($image_path))
  - 'none' -> placeholder asset (e.g., asset('img/library/_placeholder.png'))
- Scope: active() -> where is_active=true.
- Default order: sort_order asc, name asc.

## C. Image Library
- Place 12+ stock-style images under `public/img/library/` named `food-1.jpg .. food-6.jpg`, `drink-1.jpg .. drink-6.jpg`. Use existing royalty-free or generated/SVG fallback images. If real photos aren't available, use simple labeled placeholders (1080x1080, plain colored backgrounds with category text rendered, generated programmatically via GD if needed). Document approach.
- Add a `_placeholder.png` for products with no image.
- Create `config/image_library.php` listing the keys + display labels (used by the picker UI).

## D. Storage configuration
- `config/filesystems.php`: add a disk `supabase_storage` (use `s3` driver since Supabase Storage is S3-compatible; pull endpoint/bucket from `services.supabase`). If Supabase env not set, map `product_disk` to `public` disk (local fallback).
- `config/services.php`: extend supabase config with `bucket`, `s3_endpoint` (e.g., `https://{project}.supabase.co/storage/v1/s3`), `region` (default `us-east-1`).
- `.env.example`: SUPABASE_BUCKET, SUPABASE_S3_ENDPOINT, SUPABASE_S3_KEY, SUPABASE_S3_SECRET (Supabase exposes S3 credentials in dashboard).
- `config('filesystems.product_disk')` -> dynamic: `'supabase_storage'` if env set, else `'public'`.
- Add `php artisan storage:link` reminder in deploy docs.

## E. Service: app/Services/ProductImageService.php
Methods:
- `validateUpload(UploadedFile $file): void` — only image/jpeg, image/png, image/webp; max 4MB; min dimensions 256x256.
- `storeUpload(Tenant $tenant, UploadedFile $file): string` — saves to `products/{tenant_id}/{uuid}.{ext}` on the configured disk; returns the storage path.
- `deleteUpload(string $path): void` — removes from disk; safe if missing.
- `applyToProduct(Product $product, string $source, ?string $key, ?UploadedFile $upload): void` — orchestrates: if 'upload' use storeUpload (and delete previous if any), if 'library' validate key against config('image_library'), if 'none' clear.
- All file operations isolated to this service — Livewire components don't touch Storage directly.

## F. Livewire components (Owner)

### `app/Livewire/Owner/Products/Index.php` (full-page)
- Paginated list: image thumb, name, price (formatted), is_active toggle, sort_order, edit, delete.
- Search by name. Filter by active/inactive.
- "Create product" button -> opens Form panel/modal.
- Sort: drag-and-drop is a polish item — for v1, edit sort_order numerically. (Document.)

### `app/Livewire/Owner/Products/Form.php`
- Fields: name, description, price (decimal input, converted to price_cents on save), is_active, sort_order.
- Image picker section:
  - Tabs/radio: "No image" | "Upload" | "Pick from library"
  - Upload tab: Livewire `WithFileUploads` + temporary preview.
  - Library tab: grid of library thumbnails from `config('image_library')` — click to select.
  - Current image preview always visible.
- Validation rules per tab.
- On submit: ProductImageService.applyToProduct -> save Product.

### `app/Livewire/Owner/Products/LibraryPicker.php` (optional sub-component)
- Encapsulates the library grid + selection emit. Use if it cleans up Form.php; otherwise inline.

## G. Customer catalog
Replace the placeholder `resources/views/customer/catalog.blade.php` with a real Livewire component:
- `app/Livewire/Customer/Catalog.php`
- Mounts with $qrToken; resolves table -> tenant; lists active products ordered by sort_order then name.
- Image, name, description, price.
- Mobile-first card grid (Tailwind).
- Header shows tenant name + table name.
- "Back to table" link -> `/t/{qr_token}`.
- No add-to-cart in v1 (browse only).

Routes:
- GET `/t/{qr_token}/catalog` -> Customer\Catalog (replace existing static view route).
- 404 if invalid qr_token.

## H. Owner navigation
Add "Products" link in `layouts/owner.blade.php` -> `/owner/products`.

## I. Authorization
- ProductPolicy: view/update/delete checked against tenant_id (same pattern as TablePolicy).
- Customer catalog: no auth, but only shows products of the QR's tenant + only `is_active=true`.
- Waiter cannot access /owner/products (already enforced by role middleware).

## J. Tests

### `tests/Feature/Owner/ProductsTest.php`
- Owner creates a product with price entered as "12.50" -> stored as 1250 cents.
- Duplicate name in same tenant fails validation.
- Cross-tenant: owner of A can't see/edit/delete tenant B's products.
- Soft delete works; deleted not in index.
- is_active toggle works.
- Sort order respected in index list.
- Waiter cannot access /owner/products (403).

### `tests/Feature/Owner/ProductImageTest.php` (uses `Storage::fake`)
- Upload image: file stored, image_source='upload', image_path matches `products/{tenant_id}/...`.
- Replace image with library pick: previous upload deleted; image_source='library'; image_path matches a library key.
- Replace with 'none': previous deleted; image_path null.
- Reject upload > 4MB or unsupported mime.
- Library key must exist in config or validation fails.

### `tests/Feature/Customer/CatalogTest.php`
- GET /t/{token}/catalog -> 200, lists active products only, ordered by sort_order.
- Inactive products hidden.
- Cross-tenant: products from another tenant never appear.
- Invalid token -> 404.

### Update existing
- Make sure 64 prior tests still green.

## K. Acceptance criteria
- `php artisan test` -> all green (64 + ~12 new tests).
- `php artisan migrate:fresh` clean.
- `npm run build` clean.
- Manual smoke (record):
  - Login as owner, /owner/products: empty list initially.
  - Create product "Cappuccino" 3.50 with library image -> appears in list with thumb.
  - Create product "Croissant" 2.00 with uploaded image (use a small test PNG) -> appears with uploaded image rendered (200 OK on the image URL).
  - Toggle "Cappuccino" inactive.
  - Visit /t/{seeded-qr-token}/catalog: only "Croissant" visible.
  - Reactivate "Cappuccino", refresh customer catalog: both visible, in sort_order.
  - Cross-tenant isolation: second tenant's owner can't see these products.

## L. Constraints
- Do NOT touch Phase 4 realtime code unless strictly necessary (e.g., Product changes generally don't need realtime in v1; do not subscribe customer catalog to realtime).
- Do NOT build waiter management UI (Phase 6).
- Do NOT add ordering/checkout — browse-only.
- Local dev MUST work without Supabase env vars set (fallback to public disk + library).
- TenantScope + BelongsToTenant patterns required on Product.

## M. Reporting
Return:
- Decisions (S3 disk vs custom driver, library image generation approach, price storage).
- File diff list.
- Full `php artisan test` output.
- `npm run build` output.
- Manual smoke transcript.
- Deviations from PLAN.md / brief.
- Any open questions.
````

## File: docs/PHASE_5_NOTES.md
````markdown
# Phase 5 Notes

- Product prices are stored in integer cents to avoid float precision issues.
- Product uploads use the `supabase_storage` S3-compatible disk when all Supabase Storage env vars are present; otherwise they fall back to the local `public` disk.
- Built-in image library assets are generated placeholders stored under `public/img/library/`.
- Local environments should run `php artisan storage:link` so uploaded product images resolve from the `public` disk fallback.
````

## File: docs/PHASE_6_BRIEF.md
````markdown
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
````

## File: docs/PHASE_7_BRIEF.md
````markdown
PHASE 7 IMPLEMENTATION — Production Readiness + Hostinger Deploy Docs

Read docs/PLAN.md (Phase 7) before starting. Project root: C:\Karim\projects\Saas\smart-table.
Phases 1-6 complete and verified. 97 tests passing. Build on top.

## Goal
Make the app production-deployable to Hostinger (VPS preferred, but document shared-hosting limitations) with Supabase Postgres + Storage + (disabled) Realtime. Deliver runbook + smoke checklist + .env.production template + Hostinger-specific gotchas. NO new features — operational work only.

## A. Production config

### `.env.production.example` (new, in project root)
Comprehensive template:
- APP_KEY (generate)
- APP_ENV=production
- APP_DEBUG=false
- APP_URL=https://your-domain.tld
- LOG_CHANNEL=stack, LOG_LEVEL=warning
- DB_CONNECTION=pgsql
- DB_HOST/PORT/DATABASE/USERNAME/PASSWORD (Supabase pooler — port 6543 for transaction mode)
- DB_SSLMODE=require
- SESSION_DRIVER=database (so single-server -> multi-server upgrade is painless)
- CACHE_STORE=database (Hostinger shared has no Redis; VPS can swap to redis)
- QUEUE_CONNECTION=database
- BROADCAST_CONNECTION=null (we don't broadcast from PHP)
- FILESYSTEM_DISK=public (assets) — products use product_disk
- SUPABASE_URL, SUPABASE_ANON_KEY (browser-side; safe)
- SUPABASE_SERVICE_ROLE_KEY (server-only; NEVER expose)
- SUPABASE_S3_ENDPOINT, SUPABASE_BUCKET, SUPABASE_S3_KEY, SUPABASE_S3_SECRET
- SUPABASE_REALTIME_ANON_ENABLED=false (per Phase 6 decision)
- TRUSTED_PROXIES=* (Hostinger usually fronts via shared proxy; document)
- MAIL_* (Hostinger SMTP example — leave placeholders)

### `config/session.php`, `config/cache.php`, `config/queue.php`
Confirm sane production defaults; only modify if currently broken for prod (driver should default to env). No code changes expected — verify only.

### Sessions/cache/queue migrations
- Ensure migrations exist for sessions, cache, jobs (Laravel 11+ usually includes them; create if missing).
- Verify `php artisan migrate` includes them in pgsql.

### Storage on Hostinger
- `php artisan storage:link` -> creates `public/storage` symlink. On Hostinger shared: symlinks may be restricted -> document the workaround (point Apache directly to `storage/app/public` or use a `public/storage/.htaccess` proxy). On VPS: works normally.

## B. Build pipeline
- Document: `composer install --no-dev --optimize-autoloader` -> `npm ci && npm run build` -> `php artisan migrate --force` -> `php artisan config:cache route:cache view:cache event:cache`.
- Add `deploy.sh` in repo root for VPS users (idempotent steps + `php artisan optimize:clear` first).

## C. Hostinger-specific notes
Document in `docs/DEPLOY_HOSTINGER.md`:

### VPS (recommended)
- Ubuntu 22.04 example. PHP 8.2 with extensions: pdo_pgsql, gd, mbstring, openssl, curl, fileinfo, zip.
- Nginx vhost example pointing document root to `public/`.
- `supervisord` snippet for `php artisan queue:work` (single worker for now).
- `cron` entry for `php artisan schedule:run` every minute.
- TLS via Hostinger's panel or Certbot.

### Shared hosting (fallback)
- Document limitations: no SSH for queue workers; `schedule:run` via cron control panel; symlink workaround; no long-running processes -> prefer sync queue + sync notifications.
- Note: realtime is anon-disabled, so polling fallback is what users see — works fine on shared.
- Composer install: usually run locally and upload vendor/.

### Supabase setup checklist
Document one-time setup:
1. Create Supabase project, copy URL + anon key + service role key.
2. Get Postgres credentials from project Settings -> Database (use pooler for production: port 6543, transaction mode).
3. Create Storage bucket `product-images` (public). Configure S3 access keys in Storage settings -> S3.
4. Apply `database/supabase/rls.sql` via Supabase SQL editor (after granting BYPASSRLS to the Laravel app DB user).
5. Verify RLS by attempting a SELECT as anon role -> should be blocked.

## D. Production smoke checklist
`docs/SMOKE_CHECKLIST.md` — step-by-step with expected results:
1. Hit `/` -> redirects to /login.
2. Register a new business owner -> lands on /dashboard with tenant name visible.
3. Create a table -> QR PNG downloads (open the PNG, scan with phone).
4. Open the scanned URL on a real phone -> public table page renders mobile-friendly with "Call Waiter".
5. Click Call Waiter -> status view appears, timer counts.
6. In another browser as owner: /owner/requests -> sees pending request within 10s (polling fallback).
7. Owner clicks Accept -> customer page updates within 10s ("Accepted by …").
8. Owner marks table free -> customer can scan again, fresh session.
9. Catalog: create a product with library image + product with uploaded image. Visit catalog from QR -> images load over HTTPS.
10. Create a waiter -> log in as waiter -> only sees /waiter/dashboard with requests; can't reach /owner/*.
11. Run rate-limit probes: 6 bad logins -> 429.
12. Verify HTTPS, security headers (HSTS recommended), no mixed content.

## E. Repo cleanup
- Add/refresh `README.md`: project description, requirements, local setup (one-page), link to docs/PLAN.md, docs/DEPLOY_HOSTINGER.md, docs/SUPABASE_RLS.md, docs/SMOKE_CHECKLIST.md.
- Move existing `smoke-*.html` artifacts produced during dev out of repo root into `storage/app/smoke/` (or delete) so they don't clutter prod deploys. Add `smoke-*.html` to .gitignore.
- `.gitignore` review: ensure .env, .env.production, storage/app/products/*, public/storage are properly handled (public/storage is the symlink — keep gitignored).
- Verify no secrets in committed files (grep for SUPABASE_SERVICE_ROLE_KEY, hardcoded keys).

## F. CI hint (optional but valued)
Add a minimal `.github/workflows/ci.yml` running on push: composer install, npm ci, npm run build, php artisan test against sqlite. Don't enable any deployment in CI.

## G. Tests
- All 97 prior tests must still pass.
- Add `tests/Feature/Production/ConfigSanityTest.php`:
  - When APP_ENV=production and APP_DEBUG=true -> assert this would log a warning (or simply assert that .env.production.example sets APP_DEBUG=false). A pure-text test reading the file is acceptable.
  - assert config('services.supabase.realtime_anon_enabled') === false by default.
  - assert config('app.debug') === false in env=production simulation (use `Config::set` or env switch).

## H. Acceptance criteria
- `php artisan test` -> all green (97 + ~3 new).
- `npm run build` clean.
- `composer install --no-dev --optimize-autoloader` simulated locally OR documented exactly.
- `.env.production.example` exists, has every key needed, no real secrets.
- `docs/DEPLOY_HOSTINGER.md` exists with VPS + shared sections, supabase setup, supervisord/cron snippets.
- `docs/SMOKE_CHECKLIST.md` exists with all 12 steps.
- `README.md` is end-to-end-readable for someone new to the project.
- Repo is clean: no dev smoke HTML files committed; .gitignore correct.

## I. Manual verification (record)
- Run `composer install --no-dev --optimize-autoloader -d "C:\Karim\projects\Saas\smart-table"` against a copy if possible OR on the live tree (then run a `composer install` afterward to restore dev deps). Document.
- Run `php artisan config:cache && php artisan route:cache && php artisan view:cache` -> verify no errors. Then `php artisan optimize:clear` to undo (so dev tests still work).
- Confirm `php artisan migrate:fresh --seed` still succeeds.
- Confirm `php artisan test` still 100/100 (or whatever the new total is) green.

## J. Constraints
- Do NOT change application functionality.
- Do NOT introduce new dependencies unless strictly necessary (e.g., a logger driver). If you do, justify.
- Do NOT modify Phase 6 RLS SQL.
- Documentation must reference real file paths under `C:\Karim\projects\Saas\smart-table\`.

## K. Reporting
Return:
- File diff list (configs, docs, .env templates, README, .gitignore, CI).
- Full `php artisan test` output.
- `npm run build` output.
- `composer install --no-dev --optimize-autoloader` evidence (or full justification if skipped).
- `php artisan config/route/view:cache` outputs.
- Summary of DEPLOY_HOSTINGER.md, SMOKE_CHECKLIST.md, README.md key sections.
- Final overall project status: total tests passing, all phases complete.
- Open issues / known limitations the owner should be aware of before going live.
````

## File: docs/PLAN.md
````markdown
# Objective

Deliver a production-oriented implementation plan for a **multi-tenant restaurant/cafe Smart Table SaaS** built on Laravel 12, Livewire 3, Alpine.js, Tailwind CSS v4, and Supabase Postgres/Realtime/Storage, aligned to the requirements in `C:\Karim\projects\Saas\smart-table\docs\PLANNING_BRIEF.md` and the current minimal Laravel application scaffold.

## Recommended Architecture Summary

- **Application architecture:** Laravel monolith with Blade + Livewire full-page components, Alpine.js for light client interactivity, Vite for assets.
- **Tenancy model:** Single database, row-level tenant partitioning using `tenant_id` on all tenant-owned tables, enforced in Laravel with a global scope and middleware; Supabase RLS added as defense-in-depth.
- **Authentication:** Laravel-native auth for staff only. Owners and waiters authenticate; customers remain anonymous.
- **Realtime:** Supabase Realtime in the browser for dashboard/request updates, with Livewire polling fallback.
- **Customer interaction model:** QR token identifies table; session token identifies active table session.
- **Deployment model:** Laravel app hosted on Hostinger VPS, connected to Supabase-managed Postgres, Realtime, and Storage.

## Key Design Decisions

### 1) Tenancy Strategy
**Chosen:** Single database with `tenant_id` on tenant-bound tables.

**Why:**
- Best fit for SaaS MVP complexity and hosting constraints.
- Matches current Laravel scaffold and avoids per-tenant connection orchestration.
- Works cleanly with Supabase Postgres and Laravel Eloquent scopes.

**Rejected alternatives:**
- Database-per-tenant: too much operational overhead for MVP.
- Schema-per-tenant: more complex migrations and deployment story than required.

### 2) Authentication Boundary
**Chosen:** Laravel handles all authenticated staff access; Supabase Auth is not used.

**Why:**
- Keeps roles, middleware, policies, and session management centralized in Laravel.
- Avoids dual-auth complexity across Laravel and Supabase.

**Rejected alternatives:**
- Supabase Auth for staff: duplicates auth concerns and increases coordination complexity.

### 3) Customer Session Model
**Chosen:** QR token for table discovery + server-issued table session token for active anonymous sessions.

**Why:**
- Cleanly distinguishes stable table identity from ephemeral customer occupancy.
- Supports “resume current session on same device” behavior.

**Risk and mitigation:**
- In-app browser cookie persistence can be unreliable. Add a fallback path to resume via signed URL/session token when cookies are missing.

### 4) Realtime Strategy
**Chosen:** Supabase JS client subscribes directly from the browser to request/session updates; Livewire polling remains the fallback.

**Why:**
- Avoids PHP websocket hosting complexity.
- Fits Hostinger constraints while still delivering live UX.

### 5) Product Image Strategy
**Chosen:** Start with Supabase Storage for all uploaded product images; defer any built-in image library until after core flows are stable.

**Why:**
- Lowest-complexity path to deliver core catalog management.
- Keeps storage concerns consistent across environments.

**Rejected for initial phase:**
- Shipping a curated built-in image library and extra image-processing workflow in the MVP foundation.

---

# Current Repository Baseline

## Verified Current State
- Laravel 12 app scaffold exists.
- PostgreSQL connection support is already present.
- Frontend uses Vite + Tailwind CSS v4.
- Routing is still at the default minimal state.
- `User` model is still the stock Laravel model.
- No tenant model, tenant middleware, dashboard structure, or QR/customer flow exists yet.
- No auth starter kit is currently present in dependencies.

## Existing Files That Anchor This Plan
- `C:\Karim\projects\Saas\smart-table\docs\PLANNING_BRIEF.md`
- `C:\Karim\projects\Saas\smart-table\composer.json`
- `C:\Karim\projects\Saas\smart-table\package.json`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\config\database.php`

---

# Target Architecture

```mermaid
flowchart TD
    A[Customer scans QR] --> B[Customer route /t/{qr_token}]
    B --> C[Resolve table]
    C --> D[Create or resume table session]
    D --> E[Livewire customer page]
    E --> F[Create request: call waiter]
    F --> G[(Supabase Postgres)]
    G --> H[Supabase Realtime]
    H --> I[Owner dashboard]
    H --> J[Waiter dashboard]
    I --> K[Accept request]
    J --> K
    K --> G
    G --> H
    H --> E

    L[Owner auth] --> M[Laravel auth/session]
    N[Waiter auth] --> M
    M --> O[Role middleware]
    O --> I
    O --> J
```

## Bounded Contexts

### Tenant & Identity
- Tenant creation during owner onboarding.
- Staff users belong to exactly one tenant.
- Role model: `owner`, `waiter`.

### Venue Operations
- Tables belong to a tenant.
- Each table has a stable QR token.
- Table occupancy is represented by active `table_sessions`.

### Catalog
- Products belong to a tenant.
- Products have image, name, price, and active state.

### Service Requests
- Customer raises waiter requests from a live table session.
- Staff accepts and resolves requests.
- Dashboard views show current pending/accepted activity.

---

# Domain Model

## Core Tables

### `tenants`
Suggested fields:
- `id`
- `name`
- `slug` (unique, optional but recommended)
- timestamps

### `users` (extend existing)
Add:
- `tenant_id` nullable initially for migration safety, then required for tenant staff records
- `role` enum/string: `owner`, `waiter`
- timestamps as existing

Relationships:
- belongs to `tenant`

### `tables`
Fields:
- `id`
- `tenant_id`
- `name` or `label`
- `qr_token` unique
- `status` enum/string: `free`, `occupied`
- timestamps

### `table_sessions`
Fields:
- `id`
- `tenant_id`
- `table_id`
- `session_token` unique
- `status` enum/string: `active`, `closed`
- `started_at`
- `ended_at` nullable
- timestamps

### `products`
Fields:
- `id`
- `tenant_id`
- `name`
- `description` nullable
- `price`
- `image_path` nullable
- `is_active` boolean
- `sort_order` integer default 0
- timestamps

### `requests`
Fields:
- `id`
- `tenant_id`
- `table_session_id`
- `type` enum/string, start with `call_waiter`
- `status` enum/string: `pending`, `accepted`, `resolved`
- `accepted_by` nullable FK to `users`
- `accepted_at` nullable timestamp
- `resolved_at` nullable timestamp
- timestamps

## Eloquent Model Plan
Create or extend:
- `C:\Karim\projects\Saas\smart-table\app\Models\Tenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Table.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\TableSession.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Product.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Request.php`

## Shared Tenant Enforcement Layer
Create:
- `C:\Karim\projects\Saas\smart-table\app\Models\Scopes\TenantScope.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Concerns\BelongsToTenant.php`

Behavior:
- Automatically add `where tenant_id = currentTenantId()` to tenant-bound model queries.
- Automatically assign `tenant_id` on create when authenticated tenant context exists.

---

# Routing and Access Model

## Route Groups

### Public customer routes
- `GET /t/{qr_token}` → customer table page
- Optional resume/fallback route for session recovery if cookie is absent

### Authenticated owner routes
Prefix: `/owner`
- `/owner/dashboard`
- `/owner/tables`
- `/owner/products`
- `/owner/staff`
- `/owner/requests`

### Authenticated waiter routes
Prefix: `/waiter`
- `/waiter/dashboard`
- `/waiter/requests`

## Middleware / Bootstrapping Updates
Update:
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`

Add middleware aliases:
- `tenant`
- `role`

Middleware responsibilities:
- `IdentifyTenant`: resolve current tenant from authenticated user
- `EnsureRole`: verify required role for route group

---

# UI / Livewire Architecture

## Recommended Livewire Structure

```text
C:\Karim\projects\Saas\smart-table\app\Livewire\
├── Customer\
│   ├── TablePage.php
│   └── RequestStatus.php
├── Owner\
│   ├── Dashboard.php
│   ├── Tables\
│   │   ├── Index.php
│   │   ├── Form.php
│   │   └── QrPreview.php
│   ├── Products\
│   │   ├── Index.php
│   │   └── Form.php
│   ├── Staff\
│   │   ├── Index.php
│   │   └── Form.php
│   └── Requests\
│       └── Index.php
└── Waiter\
    ├── Dashboard.php
    └── Requests\
        └── Index.php
```

## Blade Layouts / Views
Recommended additions under:
- `C:\Karim\projects\Saas\smart-table\resources\views\layouts\`
- `C:\Karim\projects\Saas\smart-table\resources\views\livewire\customer\`
- `C:\Karim\projects\Saas\smart-table\resources\views\livewire\owner\`
- `C:\Karim\projects\Saas\smart-table\resources\views\livewire\waiter\`

## UX Principles
- Mobile-first for customer experience.
- Dashboard-first clarity for staff workflows.
- Keep owner and waiter layouts distinct.
- Use Livewire loading states and lightweight Alpine interactions.

---

# Customer Flow Design

## Scan / Session / Occupancy Rules
1. Customer scans QR.
2. Route resolves table by `qr_token`.
3. If table has no active session:
   - create `table_sessions` row
   - mark table as `occupied`
   - set session token in cookie
4. If table has an active session and cookie/session token matches:
   - resume session
5. If table has an active session and no valid session token:
   - show “table currently in use” screen
6. Customer sees catalog and waiter call action.

## Request Lifecycle
Statuses:
- `pending`
- `accepted`
- `resolved`

Flow:
- Customer creates request.
- Owner or waiter accepts request.
- Customer sees accepted status live.
- Staff resolves request after service completion.

## Fallback for QR Session Fragility
Implement a planned fallback path:
- signed resume URL or one-time resume token
- only used when cookie/session persistence fails
- keep this behind a service abstraction so it can be enabled without redesigning the flow

---

# Supabase Integration Plan

## Postgres Connection
Use Laravel `pgsql` connection against Supabase Postgres.

Config impact:
- existing `C:\Karim\projects\Saas\smart-table\config\database.php` already supports `pgsql`
- environment config will supply host, port, db, username, password, ssl mode as required

## Realtime
Use browser-side Supabase client for:
- owner request dashboards
- waiter request dashboards
- customer request status updates

Recommended subscription targets:
- `requests` filtered by `tenant_id` for staff dashboards
- `requests` filtered by current `table_session_id` for customer status
- optionally `table_sessions` for table state refreshes

## Storage
Use Supabase Storage for product images.

Recommended service wrapper:
- `C:\Karim\projects\Saas\smart-table\app\Services\ProductImageService.php`

Responsibilities:
- validate file type/size
- upload/delete image
- return stored path/public URL mapping
- isolate storage vendor details from Livewire components

## Optional RLS Policies
Add after Laravel-based tenancy is working:
- `requests` tenant filter policies
- `products` tenant filter policies
- `tables` tenant filter policies
- `table_sessions` tenant filter policies

This is defense-in-depth, not the primary isolation layer.

---

# Services, Policies, and Supporting Classes

## Services to Introduce
- `C:\Karim\projects\Saas\smart-table\app\Services\TenantRegistrationService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\TableSessionService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\QrCodeService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\ProductImageService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\RequestRealtimePayloadService.php` (optional)

## Middleware / Support
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\IdentifyTenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\EnsureRole.php`
- `C:\Karim\projects\Saas\smart-table\app\Support\CurrentTenant.php`

## Policies
Recommended if authorization complexity grows:
- `TablePolicy`
- `ProductPolicy`
- `UserPolicy`
- `RequestPolicy`

For MVP, route middleware + tenant scope can carry most of the load, but policies should be introduced as owner capabilities expand.

---

# Security Plan

## Core Controls
- Tenant isolation via scope + middleware.
- Authenticated staff-only route groups.
- Anonymous customers constrained to QR/session-based pages.
- Livewire validation for every mutating action.
- CSRF and session security from Laravel defaults.
- Blade escaping for rendered content.
- Rate limiting on public QR and request endpoints.
- Signed/fallback session recovery for in-app browser edge cases.

## Abuse / Edge Cases
- Repeated QR scans on occupied tables.
- Customers attempting to forge session tokens.
- Cross-tenant data leakage through incorrectly scoped queries.
- Unauthorized waiter access to owner-only management features.
- Realtime subscription filters being broader than intended.

---

# Testing and Validation Strategy

## Test Categories

### Feature tests
- owner registration creates tenant + owner user
- waiter cannot access owner routes
- customer scan creates session only when table is free
- customer without valid session cannot hijack occupied table
- request creation is limited to active table session
- request accept/resolve updates statuses correctly

### Tenancy tests
- tenant A cannot see tenant B tables/products/requests
- scoped models auto-filter correctly
- owner-created staff/users stay within tenant

### Integration tests
- QR route resolution
- product image upload service behavior (faked storage in tests)
- fallback polling path when realtime is unavailable

### Manual verification checklist
- QR scan on mobile
- live waiter call updates owner/waiter dashboards
- customer sees accepted state without refresh
- owner CRUD for tables/products/staff works end-to-end

## Definition of Done
- Tenancy enforced across all tenant-owned models and routes.
- Auth and role boundaries implemented for owner/waiter.
- Customer QR flow works with table locking/resume behavior.
- Waiter-call lifecycle works end-to-end.
- Realtime updates function with polling fallback.
- Product images upload successfully to Supabase Storage.
- Core tenant-isolation and access-control tests pass.
- Deployment/config documentation is sufficient for production setup.

---

# Phased Implementation Plan

## Phase 1 — Foundation: Auth, Tenant Core, Roles

### Goals
- Establish tenant-aware architecture and staff authentication.
- Convert the stock user system into owner/waiter tenant staff management.

### Primary targets
- `C:\Karim\projects\Saas\smart-table\composer.json`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`
- new tenant-related migrations/models/middleware/services

### Work items
- Add Laravel auth scaffolding appropriate for Blade/Alpine.
- Create `tenants` table and extend `users` with `tenant_id` and `role`.
- Create tenant scope/trait/current-tenant support.
- Add role middleware and owner/waiter route groups.
- Implement tenant-aware registration flow for owners.

### Verification
- Owner registration creates tenant and owner user.
- Authenticated owner reaches owner dashboard.
- Waiter role guard blocks owner-only routes.

---

## Phase 2 — Tables and QR Lifecycle

### Goals
- Enable owner-managed tables and QR generation.
- Prepare stable table discovery entry point for customers.

### Primary targets
- new `tables` migration/model/factory
- owner table Livewire components
- QR generation service
- customer table route

### Work items
- Create table CRUD.
- Generate unique `qr_token` per table.
- Implement QR rendering/download flow.
- Add table status handling (`free`, `occupied`).

### Verification
- Owner can create/update/archive tables.
- QR resolves to correct public route.
- Duplicate QR tokens are prevented.

---

## Phase 3 — Anonymous Customer Sessions and Waiter Call

### Goals
- Create customer-facing table session flow and v1 waiter-call interaction.

### Primary targets
- new `table_sessions` and `requests` migrations/models
- `TableSessionService`
- customer Livewire components/views
- request lifecycle handlers

### Work items
- Build QR scan entry flow.
- Create/resume active session with session token.
- Lock occupied tables against unauthorized reuse.
- Add “call waiter” action and status display.

### Verification
- Free table opens new session.
- Same device resumes active session.
- Other devices cannot hijack active table.
- Request record is created and visible to staff.

---

## Phase 4 — Staff Dashboards and Realtime

### Goals
- Surface live requests to owner and waiter dashboards.
- Reflect status changes back to customers.

### Primary targets
- owner and waiter dashboard Livewire components
- frontend JS bootstrap for Supabase client
- request list/status UI

### Work items
- Add owner request overview panel.
- Add waiter-focused pending request screen.
- Connect Supabase Realtime subscriptions in frontend.
- Add polling fallback for degraded network/websocket conditions.

### Verification
- New customer request appears on dashboards without page refresh.
- Accepting request updates customer status live.
- Polling fallback preserves correctness when realtime is unavailable.

---

## Phase 5 — Product Catalog and Images

### Goals
- Allow owners to manage menu/catalog content used on customer table pages.

### Primary targets
- `products` migration/model
- owner products Livewire components
- Supabase Storage service adapter
- customer catalog view composition

### Work items
- Add product CRUD with validation.
- Upload/store product images in Supabase Storage.
- Render catalog on customer page.
- Add active/inactive and sort ordering controls.

### Verification
- Owner can create/edit/deactivate products.
- Images upload and display correctly.
- Customer sees only active products for the current tenant.

---

## Phase 6 — Staff Management, Authorization Hardening, and QA

### Goals
- Complete owner-driven waiter management.
- Harden authorization and tenant isolation.

### Primary targets
- staff management UI
- policies/middleware refinements
- feature and tenancy tests

### Work items
- Owner creates, edits, and disables waiter accounts.
- Tighten route, component, and service authorization checks.
- Expand automated tests around isolation and role boundaries.
- Add rate limiting and edge-case handling.

### Verification
- Owner can manage waiters successfully.
- Waiters are isolated to tenant resources only.
- Access-control and tenancy test suite passes.

---

## Phase 7 — Production Readiness and Deployment Documentation

### Goals
- Finalize operational readiness for Hostinger deployment.

### Primary targets
- env/deployment documentation
- queue/session/cache config choices
- production bootstrap notes

### Work items
- Document Supabase/Postgres/Storage config.
- Define production queue/session/cache drivers.
- Document migration/build/deploy flow.
- Add recovery notes for realtime degradation and storage failures.

### Verification
- Deployment checklist is executable end-to-end.
- Production environment variables are fully enumerated.
- Smoke test plan covers login, dashboard, QR scan, and waiter-call flow.

---

# Step → Targets → Verification Traceability

| Step | Targets | Verification |
|---|---|---|
| Phase 1 | `User`, tenant models, middleware, auth routes | owner onboarding, role guard, tenant creation |
| Phase 2 | tables model/components/routes/services | QR uniqueness, owner CRUD, public route resolution |
| Phase 3 | table sessions, requests, customer UI | occupied-table protection, session resume, request creation |
| Phase 4 | owner/waiter dashboards, JS realtime integration | live updates, accept flow, polling fallback |
| Phase 5 | products model/components/storage service | product CRUD, image upload, tenant-scoped catalog rendering |
| Phase 6 | staff management, auth hardening, tests | cross-tenant isolation, owner/waiter permissions |
| Phase 7 | deployment docs/config | production smoke checklist and environment completeness |

---

# Dependencies and Sequencing Constraints

- Tenant foundation must land before any tenant-owned CRUD.
- Table model and QR flow must exist before customer sessions.
- Customer request lifecycle must exist before realtime dashboard work.
- Product catalog can be parallelized somewhat after tenant foundation, but should integrate after customer page structure exists.
- RLS should be added after Laravel tenancy is already validated, not before.

---

# Risks and Mitigations

## Risk: Incorrect tenant scoping causes data leakage
**Mitigation:** centralize scope/trait pattern, add explicit tenancy tests early.

## Risk: In-app browsers drop cookies for anonymous customers
**Mitigation:** design a signed resume fallback path in the customer session service.

## Risk: Realtime subscriptions drift from authorization intent
**Mitigation:** keep channel filters narrow and derive filter values from server-rendered tenant/session context.

## Risk: Storage/vendor logic leaks into UI components
**Mitigation:** use a dedicated image service layer.

## Risk: Overbuilding before the core waiter-call flow works
**Mitigation:** prioritize phases strictly around the MVP journey: auth → tables → customer session → request flow → realtime → catalog.

---

# Recommended Initial File Creation/Modification Set

## Likely first-wave modifications
- `C:\Karim\projects\Saas\smart-table\composer.json`
- `C:\Karim\projects\Saas\smart-table\package.json`
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\config\database.php`

## Likely first-wave additions
- `C:\Karim\projects\Saas\smart-table\app\Models\Tenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Table.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\TableSession.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Product.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Request.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Scopes\TenantScope.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Concerns\BelongsToTenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\IdentifyTenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\EnsureRole.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\TenantRegistrationService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\TableSessionService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\QrCodeService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\ProductImageService.php`
- tenant/table/session/request/product migrations
- Livewire components and matching Blade views for customer/owner/waiter flows
- docs for deployment/setup

---

# Approval Request

The implementation plan has been prepared and is ready for approval. Once approved, execution can proceed phase-by-phase starting with tenancy, auth, and role foundations.
````

## File: docs/PLANNING_BRIEF.md
````markdown
@Multi-model-planner

Produce a comprehensive architecture and phased implementation plan for a multi-tenant SaaS called "smart-table" for cafes/restaurants.

## Tech stack (locked)
- Backend: Laravel (already scaffolded at C:\Karim\projects\Saas\smart-table)
- Frontend: Laravel Blade + Livewire 3 + Alpine.js (mobile-first)
- Database: Supabase (Postgres) - use Supabase Postgres directly via Laravel's pgsql connection. Use Supabase Realtime for live updates from customer pages and waiter dashboards.
- Storage: Supabase Storage for product/catalog images + a built-in image library shipped with the app
- Auth: Laravel's own auth (Breeze or Fortify) for owners and waiters. Customers are anonymous (no login).
- Local first, deploy target: Hostinger (shared/VPS - keep deploy assumptions realistic)

## Product scope
1. Customer flow (no login)
   - Scans QR on table -> opens a public URL bound to that table.
   - Sees: a "Call Waiter" button + link to catalog (browse only, no ordering checkout in v1).
   - On click: a session/request is created, button becomes a live timer/status ("Waiting...", "Accepted by waiter X").
   - QR is "locked" to the active session: re-scans during an open session resume the same session. New customer can't open a new session on a busy table until owner/waiter marks the table free.
2. Business owner
   - Register/login. Each owner = a tenant. Strict tenant isolation.
   - Dashboard: live list of incoming customer requests (Realtime). Click a request to mark "responded/accepted" -> customer page updates instantly.
   - Tables CRUD. Each table auto-generates a printable QR (PNG/PDF download).
   - Catalog CRUD (name, price, image). Image: upload from device (Supabase Storage) OR pick from a built-in image library.
   - Waiter user management: create/remove waiters (name, email, password). Waiters belong to the owner's tenant.
   - Mark table as "free" (closes active session, unlocks QR).
3. Waiter
   - Login. Sees ONLY the customer requests for their tenant. Can accept/respond. Cannot access catalog/tables/users management.

## Deliverables I need from the plan
1. Database schema - full ER: tenants/owners, users (with role: owner/waiter), tables, table_sessions (the "lock"), requests, products, product_images, image_library. Include Supabase RLS policies (defense-in-depth) and indexes.
2. Auth & roles - how Laravel auth + middleware enforces tenant scoping and owner-vs-waiter permissions. Global scopes for tenancy.
3. Real-time strategy - exactly how customer page subscribes to its session (Supabase Realtime channel design) and how owner/waiter dashboards subscribe to incoming requests. Fallback (polling) if Realtime fails.
4. QR / table session lifecycle - URL design (signed? token?), how a session locks the QR, how re-scan resumes, how owner unlocks.
5. Livewire component map - list every Livewire component, its responsibilities, and which page it lives on. Customer page, owner dashboard, waiter dashboard, catalog editor, tables manager, users manager, login/register.
6. Routes & controllers - full route list (web + any internal API), grouped by guard.
7. File/folder structure inside the existing Laravel project.
8. Image handling - upload pipeline to Supabase Storage, image library seeding, how to swap, max sizes/formats.
9. Phased build roadmap - concrete phases (e.g. Phase 1: tenancy + auth; Phase 2: tables + QR; Phase 3: customer page + call waiter; Phase 4: realtime requests; Phase 5: catalog; Phase 6: waiter role; Phase 7: polish + deploy). Each phase = explicit acceptance criteria so we can verify before moving on.
10. Local dev setup - exact env vars, Supabase project setup steps, how to run locally (php artisan serve + npm run dev), seed data.
11. Risks & open questions - anything ambiguous, anything Hostinger might break (websockets? long polling?), and recommended decisions.

Output a single plan document saved to the project at `docs/PLAN.md` inside C:\Karim\projects\Saas\smart-table and return the path. Do not start coding - planning only.
````

## File: docs/SMOKE_CHECKLIST.md
````markdown
# Production smoke checklist

This checklist applies to the Smart Table SaaS project at `C:\Karim\projects\Saas\smart-table`.

## Preconditions

- production env created from `C:\Karim\projects\Saas\smart-table\.env.production.example`
- migrations executed
- assets built
- `php artisan config:cache`, `php artisan route:cache`, and `php artisan view:cache` completed successfully
- HTTPS enabled

## Steps

1. Visit `/`.
   - Expected: redirects to `/login`.
2. Register a new business owner.
   - Expected: owner lands on `/dashboard` and sees the tenant name.
3. Create a table from the owner dashboard.
   - Expected: QR PNG downloads successfully.
   - Verify: open the PNG and scan it with a real phone.
4. Open the scanned URL on a phone.
   - Expected: the public table page loads in a mobile-friendly layout and shows `Call Waiter`.
5. Tap `Call Waiter`.
   - Expected: the customer request status view appears and the timer starts counting.
6. In another browser, log in as the owner and open `/owner/requests`.
   - Expected: the pending request appears within 10 seconds.
7. Accept the request as owner.
   - Expected: the customer page updates within 10 seconds and shows an accepted state.
8. Mark the table free.
   - Expected: the current customer session ends and the table can be scanned again for a fresh session.
9. Create one product with a library image and one with an uploaded image.
   - Expected: both product images load from the catalog over HTTPS.
10. Create a waiter account, sign in as that waiter, and open `/waiter/dashboard`.
    - Expected: waiter sees waiter request screens only and cannot access `/owner/*`.
11. Run login rate-limit probes with 6 failed login attempts from the same IP.
    - Expected: the sixth attempt returns HTTP `429`.
12. Verify transport and headers.
    - Expected: HTTPS is active, HSTS is recommended, and there is no mixed content in the browser console.
````

## File: docs/SUPABASE_RLS.md
````markdown
# Supabase RLS rollout for Smart Table

Phase 6 adds `C:\Karim\projects\Saas\smart-table\database\supabase\rls.sql` as defense-in-depth for production Supabase Postgres. Laravel tenancy and policies remain the primary enforcement layer.

## Recommended v1 rollout

1. Confirm the Laravel database user has been granted the `bypass_rls` role or equivalent `BYPASSRLS` capability.
2. Apply `database/supabase/rls.sql` in the Supabase SQL editor or through `psql`.
3. Keep `SUPABASE_REALTIME_ANON_ENABLED=false` in production.
4. Rely on Livewire polling fallback for request/session updates until Laravel starts issuing tenant-scoped Supabase JWTs.

## Apply script

Example with `psql`:

```bash
psql "$SUPABASE_DATABASE_URL" -f database/supabase/rls.sql
```

## What the SQL does

- Enables RLS on `tenants`, `users`, `tables`, `table_sessions`, `requests`, and `products`.
- Recreates idempotent tenant-isolation policies for `SELECT`, `INSERT`, `UPDATE`, and `DELETE`.
- Uses `current_setting('app.current_tenant_id', true)` as the tenant boundary.
- Creates a `bypass_rls` role if missing, for the Laravel database user.

## Important realtime note

Current browser realtime uses the anon key only. Once RLS is enabled, anon clients cannot satisfy the tenant-setting checks in `rls.sql`, so direct anon subscriptions to `requests` and `table_sessions` will not receive rows.

That is intentional for Phase 6. The secure v1 posture is:

- `SUPABASE_REALTIME_ANON_ENABLED=false`
- Livewire polling remains active
- No browser-issued Supabase JWTs yet

## Verification checklist

- Laravel app still works normally after the DB user receives `bypass_rls`.
- Owner pages only show same-tenant rows.
- Browser console logs the anon realtime disabled message in production.
- Dashboard and customer request status still update through polling.

## Deferred improvement

If realtime must be re-enabled later without polling fallback, add a Laravel endpoint that issues short-lived Supabase JWTs with tenant-scoped claims and update the browser client to authenticate with those JWTs instead of the anon key.
````

## File: docs/SUPABASE_WIREUP_BRIEF.md
````markdown
SUPABASE LOCAL WIRE-UP — connect local dev to real Supabase project

Project root: C:\Karim\projects\Saas\smart-table.
All 7 phases of the SaaS are complete; 100 tests passing against sqlite. Now wire local dev to the real Supabase backend so the user can verify end-to-end before deploying to smartable.space.

## Credentials (write to .env only — NEVER commit)
- SUPABASE_URL = https://eishomgozxkyefnwdnna.supabase.co
- SUPABASE_PROJECT_REF = eishomgozxkyefnwdnna
- SUPABASE_ANON_KEY = eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVpc2hvbWdvenhreWVmbndkbm5hIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODAyNDUxOTMsImV4cCI6MjA5NTgyMTE5M30.kWG1ybv9iewlQT9fhpf1Rf7PnScF3s39u6ZZGPF9K44
- SUPABASE_SERVICE_ROLE_KEY = eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVpc2hvbWdvenhreWVmbndkbm5hIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc4MDI0NTE5MywiZXhwIjoyMDk1ODIxMTkzfQ.8J-50nvoDkmrt6x3rraxF2ZL2l4rVsCJjB8Tec5CVmQ
- DB password = Jaja1990@Jaja  (URL-encode the @ to %40 when used in connection strings)
- Storage S3 Access Key ID = e54f91ee47931a612ff4b59dd8f2326d
- Storage S3 Secret = a9e7346edab8af934ca33b3d23be54914b330565620886007a0b40f7a70a4e22

## Postgres connection
Use the direct connection or the IPv4 pooler. Discover via `https://eishomgozxkyefnwdnna.supabase.co/rest/v1/?apikey=...` if needed; otherwise:
- Try direct: host = `db.eishomgozxkyefnwdnna.supabase.co`, port 5432, db `postgres`, user `postgres`, password above, sslmode=require.
- If direct fails (Supabase often blocks IPv4 direct), fall back to Transaction Pooler: host = `aws-0-<region>.pooler.supabase.com`, port 6543, user `postgres.eishomgozxkyefnwdnna`, password above, sslmode=require. Determine region by attempting `psql` to `aws-0-eu-central-1.pooler.supabase.com` first; if connection refused/timeout, try `aws-0-us-east-1`, then `aws-0-eu-west-1`, then `aws-0-ap-southeast-1`. Use whichever connects.
- For migrations specifically prefer Session pooler (port 5432 on the pooler host) since transaction pooler can break Laravel's prepared statements. Set `DB_PORT=5432` on the pooler if available; document choice.

## Storage S3
- Endpoint: https://eishomgozxkyefnwdnna.supabase.co/storage/v1/s3
- Region: us-east-1 (Supabase S3 expects this string; ignore project region for S3 client config)
- Bucket: product-images (must be created — see below). Public bucket so public read works without signed URLs.

## Steps

### 1. Backup current .env
Copy `.env` to `.env.sqlite-backup` before changing it (so user can revert to local sqlite quickly).

### 2. Write new .env values
Set:
- APP_URL=http://127.0.0.1:8000
- DB_CONNECTION=pgsql
- DB_HOST, DB_PORT, DB_DATABASE=postgres, DB_USERNAME, DB_PASSWORD (URL-encode the @ when needed; in .env raw value is fine since Laravel parses)
- DB_SSLMODE=require (add if not present in .env example)
- SUPABASE_URL, SUPABASE_ANON_KEY, SUPABASE_SERVICE_ROLE_KEY
- SUPABASE_BUCKET=product-images
- SUPABASE_S3_ENDPOINT=https://eishomgozxkyefnwdnna.supabase.co/storage/v1/s3
- SUPABASE_S3_KEY, SUPABASE_S3_SECRET
- SUPABASE_REALTIME_ANON_ENABLED=false (keep default)
- FILESYSTEM_DISK can stay; product_disk auto-resolves

Verify config/database.php pgsql block honors DB_SSLMODE (Laravel default supports `sslmode` in `options` or via DSN). If it doesn't, add it to the pgsql array in config/database.php.

### 3. Verify Postgres connectivity
- Run `php artisan db:show` (or `php artisan tinker --execute="DB::select('select version()');"`).
- If fails: try pooler hosts as described, document which works.

### 4. Run migrations against Supabase
- `php artisan migrate:fresh --seed --force` — this WILL drop and recreate everything in the Supabase postgres `public` schema. (Acceptable — the project is empty.)
- Confirm all tables created. Use `psql` or `php artisan tinker` to list.

### 5. Create the Storage bucket
Use the Supabase Management API with the service role key:
```
POST https://eishomgozxkyefnwdnna.supabase.co/storage/v1/bucket
Authorization: Bearer <SERVICE_ROLE_KEY>
Content-Type: application/json
{ "id": "product-images", "name": "product-images", "public": true, "file_size_limit": 4194304, "allowed_mime_types": ["image/jpeg","image/png","image/webp"] }
```
Use curl from PowerShell. If bucket already exists (409), continue.

### 6. Apply RLS SQL
- Read `database/supabase/rls.sql`.
- Apply via psql against Supabase. If psql not available locally, use the Supabase REST endpoint? No — use psql. If psql isn't installed, download Postgres client tools or use `php artisan tinker` running each statement. Document approach.
- If `bypass_rls` role creation fails because the postgres user isn't superuser on Supabase, adjust: instead of creating a custom role, grant `BYPASSRLS` is not allowed on Supabase. Workaround: the Supabase `postgres` user is already a superuser-like role and the `service_role` JWT bypasses RLS at the API layer. Since Laravel connects via Postgres directly with the postgres user, RLS won't block Laravel queries (postgres role is owner). DOCUMENT this clearly: Laravel app uses the postgres role which is BYPASSRLS by default on Supabase managed instances; no separate bypass role needed.
- Re-read `database/supabase/rls.sql` and adapt: skip the `CREATE ROLE bypass_rls` if it errors; keep the `ALTER TABLE ... ENABLE ROW LEVEL SECURITY` and policy creates. Document any edits.

### 7. Quick storage smoke
- Use Laravel tinker or a small artisan command: `Storage::disk('supabase_storage')->put('test/hello.txt', 'hello'); Storage::disk('supabase_storage')->url('test/hello.txt');`
- Confirm the file appears in Supabase Storage dashboard (or via API GET) and the public URL returns 200.
- Clean up test file.

### 8. End-to-end smoke against real Supabase
Run `php artisan serve --host=127.0.0.1 --port=8000` and `npm run dev` in parallel. Walk all 12 steps from `docs/SMOKE_CHECKLIST.md` using curl + cookie jar where possible:
- Register an owner.
- Create a table.
- Hit /t/{qr_token} as anonymous; trigger callWaiter (use the seeded approach from Phase 3 smoke).
- Owner sees pending request, accepts it.
- Owner marks free.
- Create a product with library image; create another with uploaded image; verify image hosted on Supabase Storage (URL contains the supabase domain).
- Visit catalog from QR.
- Create a waiter; logout; log in as waiter; sees requests; can't reach /owner.
- Verify cross-tenant isolation by registering a second owner in another tenant.
- Verify rate limiting: 6 bad logins -> 429.
- Confirm in Supabase dashboard: tables populated, storage bucket has uploaded image.

### 9. Test suite
- Tests still run against sqlite (phpunit.xml uses in-memory sqlite). DO NOT change that. Run `php artisan test` once to confirm nothing regressed because of any code changes (e.g., if you tweaked config/database.php).

### 10. Report
Return:
- Final .env diff (REDACT secrets in the report — show keys, redact values).
- Which Postgres host/port worked.
- RLS apply transcript (with any adjustments).
- Storage bucket creation response.
- Storage put/url smoke evidence (URL pattern).
- End-to-end smoke transcript covering all 12 checklist steps.
- `php artisan test` output.
- Any deviations + a clear "ready/not-ready for production deploy" verdict.
- A `docs/LOCAL_SUPABASE_SETUP.md` capturing the working configuration so the user can reproduce.

## Constraints
- DO NOT commit .env.
- DO NOT print full secret values back in the report — redact tokens, show only first/last 4 chars or `***`.
- DO NOT change app behavior. Only config + .env + Storage bucket creation + RLS apply.
- If anything blocks (e.g., Postgres unreachable from this machine, RLS apply fails), STOP and report clearly with the exact blocker — don't fake success.
````

## File: package.json
````json
{
    "$schema": "https://www.schemastore.org/package.json",
    "private": true,
    "type": "module",
    "scripts": {
        "build": "vite build",
        "dev": "vite"
    },
    "devDependencies": {
        "@tailwindcss/forms": "^0.5.2",
        "@tailwindcss/vite": "^4.0.0",
        "alpinejs": "^3.4.2",
        "autoprefixer": "^10.4.2",
        "axios": "^1.11.0",
        "concurrently": "^9.0.1",
        "laravel-vite-plugin": "^2.0.0",
        "postcss": "^8.4.31",
        "tailwindcss": "^3.1.0",
        "vite": "^7.0.7"
    },
    "dependencies": {
        "@supabase/supabase-js": "^2.106.2"
    }
}
````

## File: phpunit.xml
````xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
>
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory>tests/Feature</directory>
        </testsuite>
    </testsuites>
    <source>
        <include>
            <directory>app</directory>
        </include>
    </source>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="APP_MAINTENANCE_DRIVER" value="file"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="BROADCAST_CONNECTION" value="null"/>
        <env name="CACHE_STORE" value="array"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
        <env name="DB_URL" value=""/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="PULSE_ENABLED" value="false"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
        <env name="NIGHTWATCH_ENABLED" value="false"/>
    </php>
</phpunit>
````

## File: post-after-fix.txt
````
HTTP/1.1 302 Found
Host: 127.0.0.1:8000
Date: Mon, 01 Jun 2026 01:25:45 GMT
Connection: close
X-Powered-By: PHP/8.2.6
Cache-Control: no-cache, private
Date: Mon, 01 Jun 2026 01:25:44 GMT
Location: http://127.0.0.1:8000/dashboard
Content-Type: text/html; charset=utf-8
X-RateLimit-Limit: 3
X-RateLimit-Remaining: 2
Set-Cookie: XSRF-TOKEN=eyJpdiI6Ikt3U1ExVmpOR1U0d01aaHcyak9PM3c9PSIsInZhbHVlIjoicVlSRmtBVC94bjd4VWVDRkpYaEx6Q3c5eEREVkNZVkJNRlZkdGp6YittSEdYRUZRV1BJaktOcVZPRTE1K2Nqb25TUWpudTIya3BWQkhEMHQvOVQ5VHVMbkh1aXl0eDN3R2NWOGt4UE5JSnd2R2F3MDMvRVhqUjVRcDRVWG1VSWIiLCJtYWMiOiJjOTdkZTFkMDc5NTQxNTI0ZjQ3ZGQ3Zjg2MjNmNDYzMzRkODdiNTI4YTdmMWUwZDhiZDhhZDI2NDE0MGMyYzMzIiwidGFnIjoiIn0%3D; expires=Mon, 01 Jun 2026 03:25:45 GMT; Max-Age=7200; path=/; samesite=lax
Set-Cookie: smart-table-session=eyJpdiI6InBGYk9kT2lGNzZwV3YvSkRqN0RkNlE9PSIsInZhbHVlIjoiNDhlZG5WQVBVSlgzWVpWcjUrQkI0a3pjdm9lOU50MGlSUVFxU2E0N0RnOEdGUDJNcjNYRTBJWGFRbU41MjNMOTl0QmFOSGU3NERWLzBsMjM5cDVULzc1bEcraTBjUkExZUwwRVZuWDNpSTNzbHp1V05qZkdrL0xuWUJtamcvNTciLCJtYWMiOiI5NDQ5ZTdmNjU0YjkxM2I3NjRkN2U0NTAzMTllNzg4NDhlYjRkZjlhYTM1MmY3ZTRjZDdmZTExZGM4OWQ1NWQ0IiwidGFnIjoiIn0%3D; expires=Mon, 01 Jun 2026 03:25:45 GMT; Max-Age=7200; path=/; httponly; samesite=lax

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="0;url='http://127.0.0.1:8000/dashboard'" />

        <title>Redirecting to http://127.0.0.1:8000/dashboard</title>
    </head>
    <body>
        Redirecting to <a href="http://127.0.0.1:8000/dashboard">http://127.0.0.1:8000/dashboard</a>.
    </body>
</html>
````

## File: postcss.config.js
````javascript
export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
};
````

## File: public/robots.txt
````
User-agent: *
Disallow:
````

## File: README.md
````markdown
# Smart Table SaaS

Smart Table SaaS is a multi-tenant restaurant and cafe workflow app built with Laravel 12, Livewire 3, Alpine.js, Tailwind CSS, and Supabase. It supports owner onboarding, waiter accounts, QR-driven customer table sessions, waiter-call handling, tenant-scoped dashboards, and product catalogs with Supabase-backed or local-public image storage.

The source project root for this workspace is `C:\Karim\projects\Saas\smart-table`.

## Stack

- PHP 8.2+
- Composer
- Node.js 20+
- Laravel 12
- Livewire 3
- Tailwind CSS + Vite
- SQLite for local tests/dev convenience
- Supabase Postgres + Storage for production

## Requirements

- PHP extensions: `pdo_sqlite`, `pdo_pgsql`, `mbstring`, `openssl`, `curl`, `fileinfo`, `gd`, `zip`
- Composer 2
- Node.js + npm

## Local setup

1. From `C:\Karim\projects\Saas\smart-table`, install dependencies:
   - `composer install`
   - `npm install`
2. Create your local env file:
   - `Copy-Item .env.example .env`
3. Configure local development values in `.env`:
   - `APP_ENV=local`
   - `APP_DEBUG=true`
   - `DB_CONNECTION=sqlite`
   - `DB_DATABASE=database/database.sqlite`
4. Create the sqlite file if needed:
   - `New-Item -ItemType File database/database.sqlite -Force`
5. Generate the app key and migrate:
   - `php artisan key:generate`
   - `php artisan migrate --seed`
6. Link public storage for local product-image fallback:
   - `php artisan storage:link`
7. Run the app:
   - `php artisan serve`
   - `npm run dev`

## Quality checks

- `php artisan test`
- `npm run build`

## Production deployment

Use `.env.production.example` as the production template. The primary deployment runbook is in `docs/DEPLOY_HOSTINGER.md`.

Recommended production flow:

1. `composer install --no-dev --optimize-autoloader`
2. `npm ci`
3. `npm run build`
4. `php artisan migrate --force`
5. `php artisan config:cache`
6. `php artisan route:cache`
7. `php artisan view:cache`
8. `php artisan event:cache`

For VPS deployments, use `deploy.sh`.

## Documentation

- Architecture and phase plan: `docs/PLAN.md`
- Hostinger deployment runbook: `docs/DEPLOY_HOSTINGER.md`
- Supabase RLS notes: `docs/SUPABASE_RLS.md`
- Production smoke checklist: `docs/SMOKE_CHECKLIST.md`
- Phase brief used for this deploy work: `docs/PHASE_7_BRIEF.md`

## Notes

- Production keeps `SUPABASE_REALTIME_ANON_ENABLED=false` and relies on Livewire polling fallback.
- Product uploads use the `public` disk locally and switch to Supabase S3-compatible storage when the Supabase storage env keys are present.
- Hostinger shared hosting is supported as a fallback, but VPS is the recommended target because queue workers and symlinks are more reliable.
````

## File: register.html
````html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="gM3mQlDsA8mm3JW4cSuiEKytRAMUlEBvaIO2x0GE">

        <title>Smart Table</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="preload" as="style" href="http://127.0.0.1:8000/build/assets/app-DraWjkb0.css" /><link rel="modulepreload" as="script" href="http://127.0.0.1:8000/build/assets/app-DqgErhaZ.js" /><link rel="stylesheet" href="http://127.0.0.1:8000/build/assets/app-DraWjkb0.css" data-navigate-track="reload" /><script type="module" src="http://127.0.0.1:8000/build/assets/app-DqgErhaZ.js" data-navigate-track="reload"></script>    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 fill-current text-gray-500">
    <path d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205ZM244.75 114.995V164.795L226.39 154.225L201.03 139.625V89.825L219.39 100.395L244.75 114.995ZM249.12 57.105L292.81 82.265L249.12 107.425L205.43 82.265L249.12 57.105ZM114.49 184.425L96.13 194.995V85.305L121.49 70.705L139.85 60.135V169.815L114.49 184.425ZM91.76 27.425L135.45 52.585L91.76 77.745L48.07 52.585L91.76 27.425ZM43.67 60.135L62.03 70.705L87.39 85.305V202.545V202.555V202.565C87.39 202.735 87.44 202.895 87.46 203.055C87.49 203.265 87.49 203.485 87.55 203.695V203.705C87.6 203.875 87.69 204.035 87.76 204.195C87.84 204.375 87.89 204.575 87.99 204.745C87.99 204.745 87.99 204.755 88 204.755C88.09 204.905 88.22 205.035 88.33 205.175C88.45 205.335 88.55 205.495 88.69 205.635L88.7 205.645C88.82 205.765 88.98 205.855 89.12 205.965C89.28 206.085 89.42 206.225 89.59 206.325C89.6 206.325 89.6 206.325 89.61 206.335C89.62 206.335 89.62 206.345 89.63 206.345L139.87 234.775V285.065L43.67 229.705V60.135ZM244.75 229.705L148.58 285.075V234.775L219.8 194.115L244.75 179.875V229.705ZM297.2 139.625L253.49 164.795V114.995L278.85 100.395L297.21 89.825V139.625H297.2Z"/>
</svg>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form method="POST" action="http://127.0.0.1:8000/register">
        <input type="hidden" name="_token" value="gM3mQlDsA8mm3JW4cSuiEKytRAMUlEBvaIO2x0GE" autocomplete="off">
        <div>
            <label class="block font-medium text-sm text-gray-700" for="business_name">
    Business Name
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="business_name" type="text" name="business_name" required="required" autofocus="autofocus" autocomplete="organization">
                    </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="name">
    Owner Name
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="name" type="text" name="name" required="required" autocomplete="name">
                    </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="email">
    Email
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="email" type="email" name="email" required="required" autocomplete="username">
                    </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="password">
    Password
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="password" type="password" name="password" required="required" autocomplete="new-password">
                    </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
    Confirm Password
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="password_confirmation" type="password" name="password_confirmation" required="required" autocomplete="new-password">
                    </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="http://127.0.0.1:8000/login">
                Already registered?
            </a>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-4">
    Register
</button>
        </div>
    </form>
            </div>
        </div>
    </body>
</html>
````

## File: resources/css/app.css
````css
@tailwind base;
@tailwind components;
@tailwind utilities;
````

## File: resources/js/bootstrap.js
````javascript
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
````

## File: resources/js/realtime.js
````javascript
import { createClient } from '@supabase/supabase-js';

const noopHandle = {
    channel: null,
};

let cachedClient;
let warnedAboutRealtime = false;

const requestStatusSet = new Set(['pending', 'accepted']);

function warnOnce(message, details = null) {
    if (warnedAboutRealtime || typeof window === 'undefined') {
        return;
    }

    warnedAboutRealtime = true;

    if (details) {
        console.warn(message, details);

        return;
    }

    console.warn(message);
}

function resolveWindowConfig() {
    if (typeof window === 'undefined') {
        return {
            anonKey: null,
            anonRealtimeEnabled: false,
            url: null,
        };
    }

    return {
        anonKey: window.SUPABASE_ANON_KEY ?? null,
        anonRealtimeEnabled: window.REALTIME_ANON_ENABLED ?? false,
        url: window.SUPABASE_URL ?? null,
    };
}

function getRealtimeClient() {
    if (cachedClient !== undefined) {
        return cachedClient;
    }

    const { anonKey, anonRealtimeEnabled, url } = resolveWindowConfig();

    if (!anonRealtimeEnabled) {
        warnOnce('Supabase anon realtime disabled; Livewire polling fallback will stay active.');
        cachedClient = null;

        return cachedClient;
    }

    if (!url || !anonKey) {
        if (url || anonKey) {
            warnOnce('Supabase Realtime is partially configured; Livewire polling fallback will stay active.');
        }

        cachedClient = null;

        return cachedClient;
    }

    try {
        cachedClient = createClient(url, anonKey, {
            realtime: {
                params: {
                    eventsPerSecond: 5,
                },
            },
        });
    } catch (error) {
        warnOnce('Supabase Realtime client initialization failed; Livewire polling fallback will stay active.', error);
        cachedClient = null;
    }

    return cachedClient;
}

function buildChannelName(table, filter) {
    const suffix = Math.random().toString(36).slice(2, 10);

    return `smart-table:${table}:${filter ?? 'all'}:${suffix}`;
}

function subscribeToTable(table, filter, callback) {
    const client = getRealtimeClient();

    if (!client) {
        return noopHandle;
    }

    try {
        const channel = client.channel(buildChannelName(table, filter));

        channel
            .on(
                'postgres_changes',
                {
                    event: '*',
                    schema: 'public',
                    table,
                    ...(filter ? { filter } : {}),
                },
                callback
            )
            .subscribe((status, error) => {
                if (status === 'CHANNEL_ERROR' || status === 'TIMED_OUT') {
                    warnOnce(`Supabase Realtime subscription failed for ${table}; Livewire polling fallback remains active.`, error);
                }
            });

        return { channel };
    } catch (error) {
        warnOnce(`Supabase Realtime subscription setup failed for ${table}; Livewire polling fallback remains active.`, error);

        return noopHandle;
    }
}

function buildRequestFilter(filter = {}) {
    if (filter.filter) {
        return filter.filter;
    }

    if (filter.tenantId !== undefined && filter.tenantId !== null) {
        return `tenant_id=eq.${filter.tenantId}`;
    }

    if (filter.tableSessionId !== undefined && filter.tableSessionId !== null) {
        return `table_session_id=eq.${filter.tableSessionId}`;
    }

    return null;
}

function buildSessionFilter(filter = {}) {
    if (filter.filter) {
        return filter.filter;
    }

    if (filter.tenantId !== undefined && filter.tenantId !== null) {
        return `tenant_id=eq.${filter.tenantId}`;
    }

    if (filter.id !== undefined && filter.id !== null) {
        return `id=eq.${filter.id}`;
    }

    return null;
}

export function onRequestChange(filter = {}, callback) {
    return subscribeToTable('requests', buildRequestFilter(filter), (payload) => {
        if (typeof callback === 'function') {
            callback(payload);
        }
    });
}

export function onSessionChange(filter = {}, callback) {
    return subscribeToTable('table_sessions', buildSessionFilter(filter), (payload) => {
        if (typeof callback === 'function') {
            callback(payload);
        }
    });
}

export function unsubscribe(handle) {
    if (!handle?.channel) {
        return;
    }

    const client = getRealtimeClient();

    if (!client) {
        return;
    }

    client.removeChannel(handle.channel);
}

export function shouldRefreshWaiterList(payload) {
    const oldStatus = payload.old?.status ?? null;
    const newStatus = payload.new?.status ?? null;

    return requestStatusSet.has(oldStatus) || requestStatusSet.has(newStatus);
}

export const realtimeClient = {
    onRequestChange,
    onSessionChange,
    unsubscribe,
};
````

## File: resources/views/auth/confirm-password.blade.php
````php
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
````

## File: resources/views/auth/forgot-password.blade.php
````php
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
````

## File: resources/views/auth/login.blade.php
````php
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
````

## File: resources/views/auth/register.blade.php
````php
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="business_name" :value="__('Business Name')" />
            <x-text-input id="business_name" class="block mt-1 w-full" type="text" name="business_name" :value="old('business_name')" required autofocus autocomplete="organization" />
            <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Owner Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
````

## File: resources/views/auth/reset-password.blade.php
````php
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
````

## File: resources/views/auth/verify-email.blade.php
````php
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
````

## File: resources/views/components/application-logo.blade.php
````php
<svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <path d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205ZM244.75 114.995V164.795L226.39 154.225L201.03 139.625V89.825L219.39 100.395L244.75 114.995ZM249.12 57.105L292.81 82.265L249.12 107.425L205.43 82.265L249.12 57.105ZM114.49 184.425L96.13 194.995V85.305L121.49 70.705L139.85 60.135V169.815L114.49 184.425ZM91.76 27.425L135.45 52.585L91.76 77.745L48.07 52.585L91.76 27.425ZM43.67 60.135L62.03 70.705L87.39 85.305V202.545V202.555V202.565C87.39 202.735 87.44 202.895 87.46 203.055C87.49 203.265 87.49 203.485 87.55 203.695V203.705C87.6 203.875 87.69 204.035 87.76 204.195C87.84 204.375 87.89 204.575 87.99 204.745C87.99 204.745 87.99 204.755 88 204.755C88.09 204.905 88.22 205.035 88.33 205.175C88.45 205.335 88.55 205.495 88.69 205.635L88.7 205.645C88.82 205.765 88.98 205.855 89.12 205.965C89.28 206.085 89.42 206.225 89.59 206.325C89.6 206.325 89.6 206.325 89.61 206.335C89.62 206.335 89.62 206.345 89.63 206.345L139.87 234.775V285.065L43.67 229.705V60.135ZM244.75 229.705L148.58 285.075V234.775L219.8 194.115L244.75 179.875V229.705ZM297.2 139.625L253.49 164.795V114.995L278.85 100.395L297.21 89.825V139.625H297.2Z"/>
</svg>
````

## File: resources/views/components/auth-session-status.blade.php
````php
@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif
````

## File: resources/views/components/danger-button.blade.php
````php
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
````

## File: resources/views/components/dropdown-link.blade.php
````php
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out']) }}>{{ $slot }}</a>
````

## File: resources/views/components/dropdown.blade.php
````php
@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
````

## File: resources/views/components/input-error.blade.php
````php
@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
````

## File: resources/views/components/input-label.blade.php
````php
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
````

## File: resources/views/components/modal.blade.php
````php
@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>
````

## File: resources/views/components/nav-link.blade.php
````php
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
````

## File: resources/views/components/primary-button.blade.php
````php
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
````

## File: resources/views/components/responsive-nav-link.blade.php
````php
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
````

## File: resources/views/components/secondary-button.blade.php
````php
<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
````

## File: resources/views/components/text-input.blade.php
````php
@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
````

## File: resources/views/customer/catalog.blade.php
````php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Catalog</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 font-sans text-slate-100 antialiased">
        <main class="mx-auto flex min-h-screen max-w-3xl items-center px-6 py-12">
            <section class="w-full rounded-3xl border border-slate-800 bg-slate-900 p-8 text-sm text-slate-300 shadow-2xl shadow-slate-950/50">
                Catalog is now served by the Livewire customer catalog route.
            </section>
        </main>
    </body>
</html>
````

## File: resources/views/layouts/app.blade.php
````php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </main>
        </div>
        @livewireScripts
    </body>
</html>
````

## File: resources/views/layouts/guest.blade.php
````php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
````

## File: resources/views/layouts/navigation.blade.php
````php
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard', 'owner.*', 'waiter.*')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="text-right">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="text-xs uppercase tracking-wide text-gray-400">{{ Auth::user()->role }}</div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                <div class="font-medium text-xs uppercase tracking-wide text-gray-400">{{ Auth::user()->role }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
````

## File: resources/views/livewire/customer/catalog.blade.php
````php
<div class="space-y-6">
    <section class="rounded-3xl border border-slate-800 bg-slate-900 p-8 shadow-2xl shadow-slate-950/50">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Catalog</p>
        <h1 class="mt-4 text-3xl font-semibold text-white">{{ $tenantName }} — Table {{ $tableName }}</h1>
        <p class="mt-3 text-sm text-slate-300">Browse active products for this table. Ordering and checkout arrive in a later phase.</p>
        <a href="{{ route('customer.table', ['qr_token' => $qrToken]) }}" class="mt-6 inline-flex rounded-xl border border-slate-700 px-5 py-3 text-sm font-semibold text-slate-100 transition hover:border-amber-400 hover:text-amber-300">
            Back to table
        </a>
    </section>

    <section class="grid gap-4 sm:grid-cols-2">
        @forelse ($products as $product)
            <article class="overflow-hidden rounded-3xl border border-slate-800 bg-slate-900 shadow-xl shadow-slate-950/30">
                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="h-52 w-full object-cover">
                <div class="space-y-3 p-5">
                    <div class="flex items-start justify-between gap-4">
                        <h2 class="text-lg font-semibold text-white">{{ $product->name }}</h2>
                        <p class="text-sm font-semibold text-amber-300">${{ $product->priceFormatted() }}</p>
                    </div>
                    @if ($product->description)
                        <p class="text-sm leading-6 text-slate-300">{{ $product->description }}</p>
                    @endif
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-slate-700 bg-slate-900/60 p-8 text-sm text-slate-400 sm:col-span-2">
                No active products are available for this table yet.
            </div>
        @endforelse
    </section>
</div>
````

## File: resources/views/livewire/owner/categories/form.blade.php
````php
<form wire:submit="save" class="space-y-5">
    <div class="grid gap-5">
        <div>
            <label for="category-name" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">
                Name
            </label>
            <input wire:model.blur="name" id="category-name" type="text"
                placeholder="e.g. Starters, Drinks, Desserts"
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            @error('name')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category-sort-order" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">
                Sort Order
            </label>
            <input wire:model.blur="sortOrder" id="category-sort-order" type="number" min="0"
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            <p class="mt-1.5 text-xs text-slate-400 font-medium">Lower numbers appear first in the catalog.</p>
            @error('sortOrder')
                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <button type="submit"
        class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        {{ $categoryId ? 'Save Changes' : 'Create Category' }}
    </button>
</form>
````

## File: resources/views/livewire/owner/categories/index.blade.php
````php
<div class="space-y-6">
    {{-- ── Header ─────────────────────────────────────────────────────────── --}}
    <section class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-xl border border-indigo-100 shadow-sm inline-block">
                    Owner Catalog
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Product Categories</h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">
                    Organise your menu into named sections. Assign categories to products to group them in the customer catalog.
                </p>
            </div>

            <button wire:click="createCategory" type="button"
                class="shrink-0 group inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <span>New Category</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </section>

    {{-- ── Main grid ───────────────────────────────────────────────────────── --}}
    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(360px,1fr)]">

        {{-- Category table --}}
        <div class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Products</th>
                            <th class="px-6 py-4">Sort</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-transparent">
                        @forelse ($categories as $category)
                            <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-50 to-violet-100 border border-indigo-100 shrink-0">
                                            <svg class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <p class="font-bold text-slate-800">{{ $category->name }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 border border-indigo-100 px-2.5 py-1 text-xs font-bold text-indigo-700">
                                        {{ $category->products_count }} product{{ $category->products_count === 1 ? '' : 's' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle text-xs font-bold text-slate-500 font-mono">{{ $category->sort_order }}</td>
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex flex-wrap justify-end gap-1.5">
                                        <button wire:click="editCategory({{ $category->id }})" type="button"
                                            class="rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">
                                            Edit
                                        </button>
                                        <button wire:click="deleteCategory({{ $category->id }})"
                                            wire:confirm="Delete '{{ $category->name }}'? Products in this category will become uncategorised."
                                            type="button"
                                            class="rounded-xl border border-red-200 bg-red-50/50 px-3.5 py-2 text-xs font-bold text-red-600 hover:bg-red-50 hover:border-red-300 shadow-sm transition-all duration-200">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-800">No Categories Yet</h3>
                                        <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">Create your first category to start organising your menu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Inline form panel --}}
        <div class="space-y-6">
            @if ($showForm)
                <div class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">{{ $editingCategoryId ? 'Edit Category' : 'New Category' }}</h2>
                        <button wire:click="closeForm" type="button"
                            class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">
                            Close
                        </button>
                    </div>

                    <livewire:owner.categories.form
                        :category-id="$editingCategoryId"
                        :key="'category-form-' . $editingCategoryId"
                        @category-saved="handleSaved($event.detail.categoryId)"
                    />
                </div>
            @endif
        </div>

    </section>
</div>
````

## File: resources/views/livewire/waiter/tables/index.blade.php
````php
<div class="space-y-6">
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">Waiter</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">My Tables</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-600">
            Assign yourself to a table to start receiving its requests, or unassign when you're done.
        </p>

        @if (session('status'))
            <div
                class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-6 max-w-md">
            <label class="block">
                <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search table name..."
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-sky-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition">
            </label>
        </div>
    </section>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">
                    <th class="px-6 py-4">Table</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($tables as $table)
                    @php
                        $isAssigned = $table->assignedWaiters->contains('id', $currentUserId);
                    @endphp
                    <tr class="align-middle">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-slate-900">{{ $table->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if ($table->status === \App\Models\Table::STATUS_FREE)
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Free
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Occupied
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if ($isAssigned)
                                <button wire:click="toggleAssignment({{ $table->id }})" type="button"
                                    class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                    Unassign Me
                                </button>
                            @else
                                <button wire:click="toggleAssignment({{ $table->id }})" type="button"
                                    class="rounded-lg border border-sky-300 bg-sky-50 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:bg-sky-100">
                                    Assign to Me
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-sm text-slate-400">
                            No tables found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="border-t border-slate-100 px-6 py-4">
            {{ $tables->links() }}
        </div>
    </section>
</div>
````

## File: resources/views/partials/realtime-config.blade.php
````php
<script>
    window.SUPABASE_URL = @json(config('services.supabase.url'));
    window.SUPABASE_ANON_KEY = @json(config('services.supabase.anon_key'));
    window.REALTIME_ENABLED = {{ config('services.supabase.url') ? 'true' : 'false' }};
    window.REALTIME_ANON_ENABLED = {{ config('services.supabase.realtime_anon_enabled') ? 'true' : 'false' }};
</script>
````

## File: resources/views/profile/edit.blade.php
````php
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
````

## File: resources/views/profile/partials/delete-user-form.blade.php
````php
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
````

## File: resources/views/profile/partials/update-password-form.blade.php
````php
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
````

## File: resources/views/profile/partials/update-profile-information-form.blade.php
````php
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
````

## File: routes/auth.php
````php
<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])->middleware('throttle:register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('throttle:login');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
````

## File: routes/console.php
````php
<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
````

## File: storage/app/.gitignore
````
*
!private/
!public/
!.gitignore
````

## File: storage/app/private/.gitignore
````
*
!.gitignore
````

## File: storage/app/public/.gitignore
````
*
!.gitignore
````

## File: storage/framework/.gitignore
````
compiled.php
config.php
down
events.scanned.php
maintenance.php
routes.php
routes.scanned.php
schedule-*
services.json
````

## File: storage/framework/cache/.gitignore
````
*
!data/
!.gitignore
````

## File: storage/framework/cache/data/.gitignore
````
*
!.gitignore
````

## File: storage/framework/sessions/.gitignore
````
*
!.gitignore
````

## File: storage/framework/testing/.gitignore
````
*
!.gitignore
````

## File: storage/framework/views/.gitignore
````
*
!.gitignore
````

## File: storage/logs/.gitignore
````
*
!.gitignore
````

## File: tailwind.config.js
````javascript
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
````

## File: tests/Feature/Auth/AuthenticationTest.php
````php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->owner()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->owner()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->owner()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
````

## File: tests/Feature/Auth/EmailVerificationTest.php
````php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $user = User::factory()->unverified()->create();

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
````

## File: tests/Feature/Auth/PasswordConfirmationTest.php
````php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
````

## File: tests/Feature/Auth/PasswordResetTest.php
````php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('login'));

            return true;
        });
    }
}
````

## File: tests/Feature/Auth/PasswordUpdateTest.php
````php
<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect('/profile');
    }
}
````

## File: tests/Feature/Auth/RegistrationTest.php
````php
<?php

namespace Tests\Feature\Auth;

use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'business_name' => 'Test Cafe',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertDatabaseHas('tenants', [
            'name' => 'Test Cafe',
            'slug' => 'test-cafe',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => UserRole::Owner->value,
        ]);
    }
}
````

## File: tests/Feature/Authorization/PoliciesTest.php
````php
<?php

namespace Tests\Feature\Authorization;

use App\Livewire\Owner\Requests\Index as OwnerRequestsIndex;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use App\Services\TableSessionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PoliciesTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_of_tenant_a_cannot_accept_request_from_tenant_b(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $tableB = Table::factory()->create(['tenant_id' => $tenantB->id]);
        $sessionB = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_id' => $tableB->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $requestB = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_session_id' => $sessionB->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        Livewire::actingAs($ownerA)
            ->test(OwnerRequestsIndex::class)
            ->call('acceptRequest', $requestB->id)
            ->assertNotFound();
    }

    public function test_waiter_in_same_tenant_can_accept_and_resolve_request(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        Livewire::actingAs($waiter)
            ->test(\App\Livewire\Waiter\Requests\Index::class)
            ->call('acceptRequest', $request->id)
            ->call('resolveRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_RESOLVED,
            'accepted_by' => $waiter->id,
        ]);
    }

    public function test_cannot_accept_request_that_is_already_accepted(): void
    {
        $owner = User::factory()->owner()->create();
        $waiter = User::factory()->waiter($owner->tenant)->create();
        $table = Table::factory()->create(['tenant_id' => $owner->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $owner->id,
            'accepted_at' => now(),
        ]);

        Livewire::actingAs($waiter)
            ->test(\App\Livewire\Waiter\Requests\Index::class)
            ->call('acceptRequest', $request->id)
            ->assertForbidden();
    }

    public function test_only_owner_can_close_table_session_manually(): void
    {
        $tenant = Tenant::factory()->create();
        $owner = User::factory()->owner($tenant)->create();
        $waiter = User::factory()->waiter($tenant)->create();
        $table = Table::factory()->create([
            'tenant_id' => $tenant->id,
            'status' => Table::STATUS_OCCUPIED,
        ]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenant->id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $this->assertTrue($owner->can('close', $session));
        $this->assertFalse($waiter->can('close', $session));

        app(TableSessionService::class)->close($session);

        $this->assertDatabaseHas('table_sessions', [
            'id' => $session->id,
            'status' => TableSession::STATUS_CLOSED,
        ]);
    }
}
````

## File: tests/Feature/Authorization/RoleAccessTest.php
````php
<?php

namespace Tests\Feature\Authorization;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_redirects_users_to_their_role_dashboard(): void
    {
        $tenant = Tenant::factory()->create();

        $owner = User::factory()->owner($tenant)->create();
        $waiter = User::factory()->waiter($tenant)->create();

        $this->actingAs($owner)
            ->get('/dashboard')
            ->assertRedirect(route('owner.dashboard', absolute: false));

        $this->actingAs($waiter)
            ->get('/dashboard')
            ->assertRedirect(route('waiter.dashboard', absolute: false));
    }

    public function test_waiter_cannot_access_owner_dashboard(): void
    {
        $tenant = Tenant::factory()->create();
        $waiter = User::factory()->waiter($tenant)->create();

        $this->actingAs($waiter)
            ->get('/owner/dashboard')
            ->assertForbidden();
    }

    public function test_owner_cannot_access_waiter_dashboard(): void
    {
        $tenant = Tenant::factory()->create();
        $owner = User::factory()->owner($tenant)->create();

        $this->actingAs($owner)
            ->get('/waiter/dashboard')
            ->assertForbidden();
    }
}
````

## File: tests/Feature/Customer/CallWaiterTest.php
````php
<?php

namespace Tests\Feature\Customer;

use App\Livewire\Customer\TablePage;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CallWaiterTest extends TestCase
{
    use RefreshDatabase;

    public function test_call_waiter_creates_pending_request_and_shows_status_view(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->assertSeeText('Waiting for a waiter');

        $this->assertDatabaseHas('requests', [
            'tenant_id' => $table->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);
    }

    public function test_customer_can_cancel_request_and_return_to_action_view(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->call('cancelRequest')
            ->assertSeeText('Call Waiter');

        $this->assertDatabaseHas('requests', [
            'table_session_id' => $session->id,
            'status' => ServiceRequest::STATUS_CANCELLED,
        ]);
    }

    public function test_customer_cannot_create_second_pending_request_for_same_session(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->call('callWaiter');

        $this->assertDatabaseCount('requests', 1);
        $this->assertDatabaseHas('requests', [
            'table_session_id' => $session->id,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);
    }
}
````

## File: tests/Feature/Customer/CatalogTest.php
````php
<?php

namespace Tests\Feature\Customer;

use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_lists_only_active_products_in_sort_order(): void
    {
        $tenant = Tenant::factory()->create(['name' => 'Cafe One']);
        $table = Table::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Main',
        ]);

        Product::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Mocha',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Product::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Americano',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Product::factory()->inactive()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Hidden',
            'sort_order' => 0,
        ]);

        $this->get('/t/'.$table->qr_token.'/catalog')
            ->assertOk()
            ->assertSeeTextInOrder(['Americano', 'Mocha'])
            ->assertDontSeeText('Hidden');
    }

    public function test_inactive_products_are_hidden(): void
    {
        $table = Table::factory()->create();

        Product::factory()->inactive()->create([
            'tenant_id' => $table->tenant_id,
            'name' => 'Invisible Tea',
        ]);

        $this->get('/t/'.$table->qr_token.'/catalog')
            ->assertOk()
            ->assertDontSeeText('Invisible Tea');
    }

    public function test_cross_tenant_products_never_appear(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $tableA = Table::factory()->create(['tenant_id' => $tenantA->id, 'name' => 'A']);

        Product::factory()->create([
            'tenant_id' => $tenantA->id,
            'name' => 'Shown',
        ]);
        Product::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Hidden Elsewhere',
        ]);

        $this->get('/t/'.$tableA->qr_token.'/catalog')
            ->assertOk()
            ->assertSeeText('Shown')
            ->assertDontSeeText('Hidden Elsewhere');
    }

    public function test_invalid_token_returns_404(): void
    {
        $this->get('/t/not-a-real-token/catalog')->assertNotFound();
    }
}
````

## File: tests/Feature/DashboardAccessTest.php
````php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_hit_owner_dashboard(): void
    {
        $owner = User::factory()->owner()->create();

        $response = $this->actingAs($owner)->get('/owner/dashboard');

        $response
            ->assertOk()
            ->assertSeeText('Owner Dashboard')
            ->assertSeeText($owner->tenant->name);
    }

    public function test_waiter_cannot_access_owner_dashboard(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/dashboard')
            ->assertForbidden();
    }

    public function test_owner_cannot_access_waiter_dashboard(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/waiter/dashboard')
            ->assertForbidden();
    }
}
````

## File: tests/Feature/Owner/ProductImageTest.php
````php
<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Products\Form;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_upload_image_is_stored_and_product_uses_upload_source(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Croissant')
            ->set('price', '2.00')
            ->set('imageSource', Product::IMAGE_SOURCE_UPLOAD)
            ->set('upload', UploadedFile::fake()->image('croissant.png', 512, 512))
            ->call('save')
            ->assertHasNoErrors();

        $product = Product::firstOrFail();

        $this->assertSame(Product::IMAGE_SOURCE_UPLOAD, $product->image_source);
        $this->assertStringStartsWith('products/'.$owner->tenant_id.'/', $product->image_path);
        Storage::disk('public')->assertExists($product->image_path);
    }

    public function test_replacing_upload_with_library_deletes_previous_upload(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'image_source' => Product::IMAGE_SOURCE_UPLOAD,
            'image_path' => 'products/'.$owner->tenant_id.'/old.png',
        ]);
        Storage::disk('public')->put($product->image_path, 'old-image');

        Livewire::actingAs($owner)
            ->test(Form::class, ['productId' => $product->id])
            ->set('imageSource', Product::IMAGE_SOURCE_LIBRARY)
            ->set('selectedLibraryImage', 'library/drink-2.jpg')
            ->call('save')
            ->assertHasNoErrors();

        $product->refresh();

        $this->assertSame(Product::IMAGE_SOURCE_LIBRARY, $product->image_source);
        $this->assertSame('library/drink-2.jpg', $product->image_path);
        Storage::disk('public')->assertMissing('products/'.$owner->tenant_id.'/old.png');
    }

    public function test_replacing_upload_with_none_deletes_previous_upload(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'image_source' => Product::IMAGE_SOURCE_UPLOAD,
            'image_path' => 'products/'.$owner->tenant_id.'/old.png',
        ]);
        Storage::disk('public')->put($product->image_path, 'old-image');

        Livewire::actingAs($owner)
            ->test(Form::class, ['productId' => $product->id])
            ->set('imageSource', Product::IMAGE_SOURCE_NONE)
            ->call('save')
            ->assertHasNoErrors();

        $product->refresh();

        $this->assertSame(Product::IMAGE_SOURCE_NONE, $product->image_source);
        $this->assertNull($product->image_path);
        Storage::disk('public')->assertMissing('products/'.$owner->tenant_id.'/old.png');
    }

    public function test_upload_larger_than_four_mb_or_unsupported_mime_is_rejected(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();
        $largeFile = UploadedFile::fake()->create('large.png', 5001, 'image/png');

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Big File')
            ->set('price', '5.00')
            ->set('imageSource', Product::IMAGE_SOURCE_UPLOAD)
            ->set('upload', $largeFile)
            ->call('save')
            ->assertHasErrors(['upload']);

        $badMime = UploadedFile::fake()->create('menu.pdf', 100, 'application/pdf');

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Wrong Type')
            ->set('price', '5.00')
            ->set('imageSource', Product::IMAGE_SOURCE_UPLOAD)
            ->set('upload', $badMime)
            ->call('save')
            ->assertHasErrors(['upload']);
    }

    public function test_library_key_must_exist(): void
    {
        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Invalid Library')
            ->set('price', '4.00')
            ->set('imageSource', Product::IMAGE_SOURCE_LIBRARY)
            ->set('selectedLibraryImage', 'library/not-real.jpg')
            ->call('save')
            ->assertHasErrors(['selectedLibraryImage']);
    }
}
````

## File: tests/Feature/Owner/ProductsTest.php
````php
<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Products\Form;
use App\Livewire\Owner\Products\Index;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_creates_product_with_decimal_price_stored_as_cents(): void
    {
        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Cappuccino')
            ->set('price', '12.50')
            ->set('description', 'Foamy coffee')
            ->set('sortOrder', 3)
            ->set('isActive', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('products', [
            'tenant_id' => $owner->tenant_id,
            'name' => 'Cappuccino',
            'price_cents' => 1250,
        ]);
    }

    public function test_duplicate_name_in_same_tenant_fails_validation(): void
    {
        $owner = User::factory()->owner()->create();
        Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Latte',
        ]);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Latte')
            ->set('price', '4.50')
            ->call('save')
            ->assertHasErrors(['name' => 'unique']);
    }

    public function test_owner_cannot_see_edit_or_delete_another_tenants_products(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $productA = Product::factory()->create(['tenant_id' => $tenantA->id, 'name' => 'Alpha']);
        $productB = Product::factory()->create(['tenant_id' => $tenantB->id, 'name' => 'Bravo']);

        $this->actingAs($ownerA)
            ->get('/owner/products')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo');

        Livewire::actingAs($ownerA)
            ->test(Index::class)
            ->call('deleteProduct', $productB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(Form::class, ['productId' => $productB->id])
            ->assertNotFound();

        $this->assertDatabaseHas('products', ['id' => $productA->id]);
        $this->assertDatabaseHas('products', ['id' => $productB->id]);
    }

    public function test_soft_delete_works_and_deleted_product_is_not_in_index(): void
    {
        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'To Delete',
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteProduct', $product->id);

        $this->assertSoftDeleted('products', ['id' => $product->id]);

        $this->actingAs($owner)
            ->get('/owner/products')
            ->assertDontSeeText('To Delete');
    }

    public function test_is_active_toggle_works(): void
    {
        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'is_active' => true,
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('toggleActive', $product->id);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_active' => false,
        ]);
    }

    public function test_sort_order_is_respected_in_index_list(): void
    {
        $owner = User::factory()->owner()->create();
        Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Second',
            'sort_order' => 2,
        ]);
        Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'First',
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($owner)->get('/owner/products');

        $response->assertOk();
        $response->assertSeeTextInOrder(['First', 'Second']);
    }

    public function test_waiter_cannot_access_owner_products(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/products')
            ->assertForbidden();
    }
}
````

## File: tests/Feature/Owner/RequestsManagementTest.php
````php
<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Requests\Index;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RequestsManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_sees_only_own_tenant_requests(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();

        $tableA = Table::factory()->create(['tenant_id' => $tenantA->id, 'name' => 'Alpha']);
        $tableB = Table::factory()->create(['tenant_id' => $tenantB->id, 'name' => 'Bravo']);

        $sessionA = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_id' => $tableA->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $sessionB = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_id' => $tableB->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_session_id' => $sessionA->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_session_id' => $sessionB->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $this->actingAs($ownerA)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo');
    }

    public function test_owner_can_accept_request(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create(['tenant_id' => $owner->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('acceptRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $owner->id,
        ]);
    }

    public function test_owner_can_resolve_request(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create(['tenant_id' => $owner->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $owner->id,
            'accepted_at' => now(),
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('resolveRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_RESOLVED,
        ]);

        $this->assertNotNull($request->fresh()->resolved_at);
    }

    public function test_waiter_cannot_access_owner_requests_page(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/requests')
            ->assertForbidden();
    }
}
````

## File: tests/Feature/Owner/StaffManagementTest.php
````php
<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Staff\Form;
use App\Livewire\Owner\Staff\Index;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StaffManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_creates_waiter_with_tenant_role_and_verified_email(): void
    {
        $owner = User::factory()->owner()->create([
            'password' => 'Password123',
        ]);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Ali')
            ->set('email', 'ali@test.com')
            ->set('password', 'Password123')
            ->set('password_confirmation', 'Password123')
            ->call('save')
            ->assertHasNoErrors();

        $waiter = User::where('email', 'ali@test.com')->firstOrFail();

        $this->assertSame($owner->tenant_id, $waiter->tenant_id);
        $this->assertTrue($waiter->isWaiter());
        $this->assertNotNull($waiter->email_verified_at);

        auth()->logout();

        $response = $this->post('/login', [
            'email' => 'ali@test.com',
            'password' => 'Password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->followRedirects($response)->assertSeeText('Waiter');
    }

    public function test_staff_form_validates_missing_fields_weak_password_and_duplicate_email(): void
    {
        $owner = User::factory()->owner()->create();
        User::factory()->waiter($owner->tenant)->create([
            'email' => 'ali@test.com',
        ]);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->call('save')
            ->assertHasErrors(['name', 'email', 'password', 'password_confirmation']);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Ali')
            ->set('email', 'ali@test.com')
            ->set('password', 'short')
            ->set('password_confirmation', 'short')
            ->call('save')
            ->assertHasErrors(['email' => 'unique', 'password']);
    }

    public function test_owner_sees_only_own_tenant_waiters_in_staff_list(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $owner = User::factory()->owner($tenantA)->create();

        User::factory()->waiter($tenantA)->create([
            'name' => 'Ali Tenant A',
            'email' => 'a@test.com',
        ]);
        User::factory()->waiter($tenantB)->create([
            'name' => 'Bassem Tenant B',
            'email' => 'b@test.com',
        ]);

        $this->actingAs($owner)
            ->get('/owner/staff')
            ->assertOk()
            ->assertSeeText('Ali Tenant A')
            ->assertDontSeeText('Bassem Tenant B');
    }

    public function test_owner_cannot_delete_themselves(): void
    {
        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteWaiter', $owner->id)
            ->assertForbidden();

        $this->assertDatabaseHas('users', [
            'id' => $owner->id,
            'deleted_at' => null,
        ]);
    }

    public function test_owner_cannot_delete_waiter_from_another_tenant(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $owner = User::factory()->owner($tenantA)->create();
        $waiter = User::factory()->waiter($tenantB)->create();

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteWaiter', $waiter->id)
            ->assertNotFound();

        $this->assertDatabaseHas('users', [
            'id' => $waiter->id,
            'deleted_at' => null,
        ]);
    }

    public function test_owner_soft_deletes_waiter_and_waiter_cannot_log_in_afterwards(): void
    {
        $owner = User::factory()->owner()->create();
        $waiter = User::factory()->waiter($owner->tenant)->create([
            'email' => 'ali@test.com',
            'password' => 'Password123',
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteWaiter', $waiter->id);

        $this->assertSoftDeleted('users', ['id' => $waiter->id]);

        auth()->logout();

        $this->post('/login', [
            'email' => 'ali@test.com',
            'password' => 'Password123',
        ])->assertSessionHasErrors('email');
    }

    public function test_waiter_cannot_access_owner_staff_page(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/staff')
            ->assertForbidden();
    }
}
````

## File: tests/Feature/Owner/TableQrDownloadTest.php
````php
<?php

namespace Tests\Feature\Owner;

use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TableQrDownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_download_qr_png(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
        ]);

        $response = $this->actingAs($owner)->get(route('owner.tables.qr.download', $table));

        $response->assertOk();
        $response->assertHeader('content-type', 'image/png');
        $this->assertGreaterThan(100, strlen($response->getContent()));
    }

    public function test_cross_tenant_owner_cannot_download_other_tenant_qr(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $tableB = Table::factory()->create([
            'tenant_id' => $tenantB->id,
        ]);

        $this->actingAs($ownerA)
            ->get(route('owner.tables.qr.download', $tableB))
            ->assertNotFound();
    }
}
````

## File: tests/Feature/Owner/TablesTest.php
````php
<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Tables\Form;
use App\Livewire\Owner\Tables\Index;
use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TablesTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_create_a_table_with_generated_unique_qr_token(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)->get('/owner/tables')->assertOk();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Table 5')
            ->call('save')
            ->assertHasNoErrors();

        $table = Table::first();

        $this->assertNotNull($table);
        $this->assertSame('Table 5', $table->name);
        $this->assertSame(32, strlen($table->qr_token));
        $this->assertDatabaseCount('tables', 1);

        Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Table 6',
        ]);

        $this->assertDatabaseCount('tables', 2);
        $this->assertSame(2, Table::withoutGlobalScopes()->pluck('qr_token')->unique()->count());
    }

    public function test_duplicate_name_in_same_tenant_fails_validation(): void
    {
        $owner = User::factory()->owner()->create();
        Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Table 1',
        ]);

        $this->actingAs($owner)->get('/owner/tables')->assertOk();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Table 1')
            ->call('save')
            ->assertHasErrors(['name' => 'unique']);
    }

    public function test_duplicate_name_across_tenants_is_allowed(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $ownerB = User::factory()->owner($tenantB)->create();

        Table::factory()->create([
            'tenant_id' => $tenantA->id,
            'name' => 'Patio',
        ]);

        $this->actingAs($ownerB)->get('/owner/tables')->assertOk();

        Livewire::actingAs($ownerB)
            ->test(Form::class)
            ->set('name', 'Patio')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('tables', [
            'tenant_id' => $tenantB->id,
            'name' => 'Patio',
        ]);
    }

    public function test_owner_can_soft_delete_a_table_and_deleted_table_is_not_in_index(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'To Delete',
        ]);

        $this->actingAs($owner)->get('/owner/tables')->assertSeeText('To Delete');

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteTable', $table->id);

        $this->assertSoftDeleted('tables', ['id' => $table->id]);

        $this->actingAs($owner)->get('/owner/tables')
            ->assertOk()
            ->assertDontSeeText('To Delete');
    }

    public function test_owner_cannot_see_another_tenants_tables(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();

        Table::factory()->create([
            'tenant_id' => $tenantA->id,
            'name' => 'Alpha',
        ]);

        Table::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Bravo',
        ]);

        $this->actingAs($ownerA)->get('/owner/tables')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo');
    }

    public function test_owner_cannot_edit_or_delete_another_tenants_table(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $tableB = Table::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Private Table',
        ]);

        $this->actingAs($ownerA)
            ->get(route('owner.tables.qr.download', $tableB))
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(Index::class)
            ->call('deleteTable', $tableB->id)
            ->assertNotFound();
    }

    public function test_waiter_cannot_access_owner_tables(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/tables')
            ->assertForbidden();
    }
}
````

## File: tests/Feature/Production/ConfigSanityTest.php
````php
<?php

namespace Tests\Feature\Production;

use Tests\TestCase;

class ConfigSanityTest extends TestCase
{
    public function test_env_production_example_exists_and_disables_debug(): void
    {
        $contents = file_get_contents(base_path('.env.production.example'));

        $this->assertNotFalse($contents);
        $this->assertStringContainsString('APP_ENV=production', $contents);
        $this->assertStringContainsString('APP_DEBUG=false', $contents);
        $this->assertStringContainsString('SUPABASE_REALTIME_ANON_ENABLED=false', $contents);
        $this->assertStringContainsString('TRUSTED_PROXIES=*', $contents);
    }

    public function test_supabase_realtime_anon_is_disabled_by_default(): void
    {
        $this->assertFalse((bool) config('services.supabase.realtime_anon_enabled'));
    }

    public function test_app_debug_resolves_false_for_production_even_if_env_requests_true(): void
    {
        $appConfig = $this->evaluateAppConfig([
            'APP_ENV' => 'production',
            'APP_DEBUG' => 'true',
        ]);

        $this->assertFalse($appConfig['debug']);
    }

    /**
     * @param  array<string, string>  $environment
     * @return array<string, mixed>
     */
    private function evaluateAppConfig(array $environment): array
    {
        $original = [];

        foreach ($environment as $key => $value) {
            $original[$key] = getenv($key);
            putenv($key.'='.$value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }

        try {
            return require base_path('config/app.php');
        } finally {
            foreach ($environment as $key => $value) {
                if ($original[$key] === false) {
                    putenv($key);
                    unset($_ENV[$key], $_SERVER[$key]);

                    continue;
                }

                putenv($key.'='.$original[$key]);
                $_ENV[$key] = $original[$key];
                $_SERVER[$key] = $original[$key];
            }
        }
    }
}
````

## File: tests/Feature/ProfileTest.php
````php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull(User::find($user->id));
        $this->assertNotNull(User::withTrashed()->find($user->id));
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
````

## File: tests/Feature/Realtime/RealtimeAnonDisabledTest.php
````php
<?php

namespace Tests\Feature\Realtime;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RealtimeAnonDisabledTest extends TestCase
{
    use RefreshDatabase;

    public function test_realtime_anon_disabled_marker_is_rendered_when_flag_is_false(): void
    {
        config([
            'services.supabase.url' => 'https://example.supabase.co',
            'services.supabase.anon_key' => 'anon-key',
            'services.supabase.realtime_anon_enabled' => false,
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSee('window.REALTIME_ANON_ENABLED = false;', false)
            ->assertSee('wire:poll.3s', false);
    }
}
````

## File: tests/Feature/Realtime/RealtimeConfigTest.php
````php
<?php

namespace Tests\Feature\Realtime;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RealtimeConfigTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_page_marks_realtime_enabled_when_supabase_url_is_present(): void
    {
        config([
            'services.supabase.url' => 'https://example.supabase.co',
            'services.supabase.anon_key' => 'anon-key',
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSee('window.REALTIME_ENABLED = true;', false);
    }

    public function test_owner_page_falls_back_to_polling_when_supabase_url_is_missing(): void
    {
        config([
            'services.supabase.url' => null,
            'services.supabase.anon_key' => null,
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSee('window.REALTIME_ENABLED = false;', false)
            ->assertSee('wire:poll.3s', false);
    }

    public function test_realtime_partial_does_not_render_service_role_key(): void
    {
        config([
            'services.supabase.url' => 'https://example.supabase.co',
            'services.supabase.anon_key' => 'anon-key',
            'services.supabase.service_role' => 'super-secret-role-key',
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertDontSee('super-secret-role-key', false);
    }
}
````

## File: tests/Feature/Security/RateLimitTest.php
````php
<?php

namespace Tests\Feature\Security;

use App\Livewire\Customer\TablePage;
use App\Livewire\Waiter\Requests\Index as WaiterRequestsIndex;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class RateLimitTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_six_failed_logins_from_same_ip_hit_429_on_sixth_attempt(): void
    {
        User::factory()->owner()->create([
            'email' => 'owner@test.com',
            'password' => 'Password123',
        ]);

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post('/login', [
                'email' => 'owner@test.com',
                'password' => 'wrong-password',
            ])->assertStatus(302);
        }

        $this->post('/login', [
            'email' => 'owner@test.com',
            'password' => 'wrong-password',
        ])->assertStatus(429);
    }

    public function test_four_register_requests_in_a_minute_hit_429_on_fourth_attempt(): void
    {
        for ($attempt = 1; $attempt <= 3; $attempt++) {
            $this->post('/register', [
                'business_name' => 'Cafe '.$attempt,
                'name' => 'Owner '.$attempt,
                'email' => 'owner'.$attempt.'@test.com',
                'password' => 'Password123',
                'password_confirmation' => 'Password123',
            ])->assertStatus(302);

            auth()->logout();
        }

        $this->post('/register', [
            'business_name' => 'Cafe 4',
            'name' => 'Owner 4',
            'email' => 'owner4@test.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ])->assertStatus(429);
    }

    public function test_customer_call_waiter_spam_hits_429_after_threshold(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        $key = 'customer-actions|127.0.0.1|'.$session->session_token;

        RateLimiter::clear($key);
        RateLimiter::increment($key, 60, 30);

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->assertStatus(429);
    }

    public function test_staff_accept_spam_hits_429_after_threshold(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $blockedRequest = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $key = 'staff-actions|'.$waiter->id;

        RateLimiter::clear($key);
        RateLimiter::increment($key, 60, 60);

        Livewire::actingAs($waiter)
            ->test(WaiterRequestsIndex::class)
            ->call('acceptRequest', $blockedRequest->id)
            ->assertStatus(429);
    }
}
````

## File: tests/Feature/TableLifecycleTest.php
````php
<?php

namespace Tests\Feature;

use App\Livewire\Customer\TablePage;
use App\Models\Table;
use App\Models\TableSession;
use App\Services\TableSessionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TableLifecycleTest extends TestCase
{
    use RefreshDatabase;

    public function test_mark_free_closes_active_session_and_sets_table_free(): void
    {
        $table = Table::factory()->create(['status' => Table::STATUS_OCCUPIED]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $table->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $table->markFree();

        $this->assertDatabaseHas('tables', [
            'id' => $table->id,
            'status' => Table::STATUS_FREE,
        ]);
        $this->assertDatabaseHas('table_sessions', [
            'id' => $session->id,
            'status' => TableSession::STATUS_CLOSED,
        ]);
        $this->assertNotNull($session->fresh()->ended_at);
    }

    public function test_closing_session_via_service_frees_table(): void
    {
        $table = Table::factory()->create(['status' => Table::STATUS_OCCUPIED]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $table->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        app(TableSessionService::class)->close($session);

        $this->assertDatabaseHas('tables', [
            'id' => $table->id,
            'status' => Table::STATUS_FREE,
        ]);
        $this->assertDatabaseHas('table_sessions', [
            'id' => $session->id,
            'status' => TableSession::STATUS_CLOSED,
        ]);
    }

    public function test_new_customer_can_start_fresh_session_after_table_is_freed(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token)->assertOk();

        $firstSession = TableSession::withoutGlobalScopes()->firstOrFail();

        $table->fresh()->markFree();

        $this->get('/t/'.$table->qr_token)
            ->assertOk()
            ->assertCookie(TablePage::SESSION_COOKIE);

        $this->assertDatabaseCount('table_sessions', 2);

        $secondSession = TableSession::withoutGlobalScopes()->latest('id')->firstOrFail();

        $this->assertNotSame($firstSession->id, $secondSession->id);
        $this->assertSame(TableSession::STATUS_CLOSED, $firstSession->fresh()->status);
        $this->assertSame(TableSession::STATUS_ACTIVE, $secondSession->status);
    }
}
````

## File: tests/Feature/Tenancy/CrossTenantHardeningTest.php
````php
<?php

namespace Tests\Feature\Tenancy;

use App\Livewire\Owner\Products\Index as OwnerProductsIndex;
use App\Livewire\Owner\Staff\Index as StaffIndex;
use App\Livewire\Owner\Tables\Index as OwnerTablesIndex;
use App\Models\Product;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CrossTenantHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_of_tenant_a_cannot_access_tenant_b_models(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();

        $tableB = Table::factory()->create(['tenant_id' => $tenantB->id]);
        $productB = Product::factory()->create(['tenant_id' => $tenantB->id]);
        $waiterB = User::factory()->waiter($tenantB)->create();
        $sessionB = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_id' => $tableB->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $requestB = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_session_id' => $sessionB->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $this->actingAs($ownerA)
            ->get(route('owner.tables.qr.download', $tableB))
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(OwnerTablesIndex::class)
            ->call('deleteTable', $tableB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(OwnerProductsIndex::class)
            ->call('deleteProduct', $productB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(StaffIndex::class)
            ->call('deleteWaiter', $waiterB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(\App\Livewire\Owner\Requests\Index::class)
            ->call('acceptRequest', $requestB->id)
            ->assertNotFound();
    }
}
````

## File: tests/Feature/Tenancy/TenantRegistrationTest.php
````php
<?php

namespace Tests\Feature\Tenancy;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_registration_creates_tenant_and_owner_role(): void
    {
        $response = $this->post('/register', [
            'business_name' => 'Northwind Cafe',
            'name' => 'Karim Owner',
            'email' => 'owner@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticated();

        $user = User::query()->with('tenant')->first();

        $this->assertNotNull($user);
        $this->assertTrue($user->isOwner());
        $this->assertSame('Northwind Cafe', $user->tenant?->name);
        $this->assertSame('northwind-cafe', $user->tenant?->slug);
    }
}
````

## File: tests/Feature/TenancyScopeTest.php
````php
<?php

namespace Tests\Feature;

use App\Models\Concerns\BelongsToTenant;
use App\Models\Tenant;
use App\Models\User;
use App\Support\CurrentTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TenancyScopeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('tenant_scope_test_records', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('tenant_scope_test_records');

        parent::tearDown();
    }

    public function test_tenant_scope_returns_only_current_tenant_records(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();

        $ownerA = User::factory()->owner()->create(['tenant_id' => $tenantA->id]);
        User::factory()->owner()->create(['tenant_id' => $tenantB->id]);

        TestTenantRecord::create([
            'tenant_id' => $tenantA->id,
            'name' => 'A only',
        ]);

        TestTenantRecord::create([
            'tenant_id' => $tenantB->id,
            'name' => 'B only',
        ]);

        $this->actingAs($ownerA)->get('/owner/dashboard')->assertOk();

        app(CurrentTenant::class)->set($tenantA);

        $visibleRecords = TestTenantRecord::query()->pluck('name')->all();

        $this->assertSame(['A only'], $visibleRecords);
    }
}

class TestTenantRecord extends Model
{
    use BelongsToTenant;

    protected $table = 'tenant_scope_test_records';

    protected $fillable = [
        'tenant_id',
        'name',
    ];
}
````

## File: tests/Feature/Waiter/WaiterRequestsTest.php
````php
<?php

namespace Tests\Feature\Waiter;

use App\Livewire\Waiter\Requests\Index;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WaiterRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_waiter_sees_pending_and_accepted_requests_for_own_tenant_only(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $waiter = User::factory()->waiter($tenantA)->create();

        $tableA = Table::factory()->create(['tenant_id' => $tenantA->id, 'name' => 'Alpha']);
        $tableB = Table::factory()->create(['tenant_id' => $tenantB->id, 'name' => 'Bravo']);

        $sessionA = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_id' => $tableA->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $sessionB = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_id' => $tableB->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_session_id' => $sessionA->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_session_id' => $sessionA->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $waiter->id,
            'accepted_at' => now(),
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_session_id' => $sessionB->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $this->actingAs($waiter)
            ->get('/waiter/dashboard')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo')
            ->assertSeeText('Pending')
            ->assertSeeText('Accepted');
    }

    public function test_waiter_can_accept_request(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        Livewire::actingAs($waiter)
            ->test(Index::class)
            ->call('acceptRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $waiter->id,
        ]);
    }

    public function test_waiter_can_resolve_request(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $waiter->id,
            'accepted_at' => now(),
        ]);

        Livewire::actingAs($waiter)
            ->test(Index::class)
            ->call('resolveRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_RESOLVED,
        ]);

        $this->assertNotNull($request->fresh()->resolved_at);
    }

    public function test_owner_cannot_access_waiter_dashboard(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/waiter/dashboard')
            ->assertForbidden();
    }

    public function test_anonymous_user_is_redirected_to_login_for_waiter_routes(): void
    {
        $this->get('/waiter/dashboard')
            ->assertRedirect('/login');
    }
}
````

## File: tests/TestCase.php
````php
<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //
}
````

## File: tests/Unit/ExampleTest.php
````php
<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
````

## File: vite.config.js
````javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
````

## File: app/Http/Controllers/Waiter/TableAssignmentController.php
````php
<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TableAssignmentController extends Controller
{
    /**
     * POST /waiter/tables/assign-via-qr
     * Body: { qr_token: string }  (or full table URL — we extract the token)
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'qr_token' => ['required', 'string'],
        ]);

        $qrToken = $this->extractToken($request->string('qr_token')->toString());

        $table = Table::query()
            ->where('qr_token', $qrToken)
            ->whereNull('deleted_at')
            ->first();

        if ($table === null) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'This QR code does not match any table for your restaurant.',
            ], 404);
        }

        $user = Auth::user();

        return DB::transaction(function () use ($table, $user) {
            $alreadyAssigned = $table->assignedWaiters()
                ->withoutGlobalScopes()
                ->where('users.id', $user->getKey())
                ->lockForUpdate()
                ->exists();

            if ($alreadyAssigned) {
                return response()->json([
                    'status' => 'already_assigned',
                    'table' => $table->name,
                    'message' => "You're already assigned to {$table->name}.",
                ]);
            }

            // Assign to this waiter, regardless of any other existing assignments.
            $table->assignedWaiters()->syncWithoutDetaching([$user->getKey()]);

            return response()->json([
                'status' => 'assigned',
                'table' => $table->name,
                'message' => "{$table->name} has been assigned to you.",
            ]);
        });
    }

    /**
     * Accept either a raw qr_token or a full customer table URL and
     * extract the token segment from the path.
     */
    private function extractToken(string $value): string
    {
        if (!str_contains($value, '/')) {
            return $value;
        }

        $path = trim((string) parse_url($value, PHP_URL_PATH), '/');
        $segments = explode('/', $path);

        // Expect .../t/{qr_token} or .../t/{qr_token}/catalog
        $index = array_search('t', $segments, true);

        if ($index !== false && isset($segments[$index + 1])) {
            return $segments[$index + 1];
        }

        return $value;
    }
}
````

## File: app/Livewire/Customer/Catalog.php
````php
<?php

namespace App\Livewire\Customer;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Table;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.customer')]
class Catalog extends Component
{
    // ── Immutable context (safe to expose) ──────────────────────
    public string $qrToken;

    public string $tenantName;

    public string $tableName;

    // ── Search / filter state (wire-bindable) ────────────────────
    #[Url(as: 'q', keep: false)]
    public string $search = '';

    #[Url(as: 'cat', keep: false)]
    public ?int $categoryId = null;

    // ── Private context (never serialised to the browser) ───────
    protected int $tenantId;

    public function mount(string $qr_token): void
    {
        $table = Table::withoutGlobalScopes()
            ->where('qr_token', $qr_token)
            ->whereNull('deleted_at')
            ->with('tenant')
            ->firstOrFail();

        $this->qrToken    = $qr_token;
        $this->tenantId   = $table->tenant_id;
        $this->tenantName = $table->tenant->name;
        $this->tableName  = $table->name;
    }

    /**
     * All categories that have at least one active product for this tenant.
     * Memoised per request cycle via #[Computed].
     */
    #[Computed]
    public function categories(): Collection
    {
        return ProductCategory::withoutGlobalScopes()
            ->where('tenant_id', $this->tenantId)
            ->whereNull('deleted_at')
            ->whereHas('products', fn ($q) => $q
                ->withoutGlobalScopes()
                ->where('tenant_id', $this->tenantId)
                ->where('is_active', true)
                ->whereNull('deleted_at')
            )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    /**
     * Active products grouped by category name.
     * Products with no category fall under a synthetic "Other" bucket.
     * Memoised per request cycle via #[Computed].
     */
    #[Computed]
    public function productsByCategory(): Collection
    {
        $query = Product::withoutGlobalScopes()
            ->where('tenant_id', $this->tenantId)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->with('category')
            ->when(
                $this->categoryId !== null,
                fn ($q) => $q->where('category_id', $this->categoryId)
            )
            ->when(
                $this->search !== '',
                fn ($q) => $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->orderBy('sort_order')
            ->orderBy('name');

        return $query->get()->groupBy(
            fn (Product $p) => $p->category?->name ?? 'Other'
        );
    }

    public function render()
    {
        return view('livewire.customer.catalog');
    }
}
````

## File: app/Livewire/Owner/Products/Index.php
````php
<?php

namespace App\Livewire\Owner\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.owner')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    #[Url(as: 'activity')]
    public string $activity = '';

    public ?int $editingProductId = null;

    public bool $showForm = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingActivity(): void
    {
        $this->resetPage();
    }

    public function createProduct(): void
    {
        $this->authorize('create', Product::class);
        $this->editingProductId = null;
        $this->showForm = true;
    }

    public function editProduct(int $productId): void
    {
        $this->editingProductId = $productId;
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->editingProductId = null;
        $this->showForm = false;
    }

    public function handleSaved(int $productId): void
    {
        $this->editingProductId = $productId;
        $this->showForm = false;
    }

    public function toggleActive(int $productId): void
    {
        $product = Product::query()->find($productId);
        abort_if($product === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $product);

        $product->forceFill([
            'is_active' => !$product->is_active,
        ])->save();
    }

    public function deleteProduct(int $productId): void
    {
        $product = Product::query()->find($productId);
        abort_if($product === null, Response::HTTP_NOT_FOUND);
        $this->authorize('delete', $product);
        $product->delete();

        if ($this->editingProductId === $productId) {
            $this->closeForm();
        }
    }

    public function render()
    {
        $products = Product::query()
            // Only load the category relation — it's used in the table rows.
            // Avoid loading all library/category data that belongs to the form.
            ->with('category:id,name')
            ->when($this->search !== '', fn(Builder $query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->activity === 'active', fn(Builder $query) => $query->where('is_active', true))
            ->when($this->activity === 'inactive', fn(Builder $query) => $query->where('is_active', false))
            ->paginate(10);

        return view('livewire.owner.products.index', [
            'products' => $products,
        ]);
    }
}
````

## File: app/Livewire/Owner/Staff/Form.php
````php
<?php

namespace App\Livewire\Owner\Staff;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Form extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->authorize('create', User::class);
    }

    public function save(): void
    {
        $this->authorize('create', User::class);

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->where(fn ($query) => $query->where('tenant_id', auth()->user()->tenant_id)->whereNull('deleted_at')),
            ],
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required', 'string'],
        ]);

        try {
            User::create([
                'tenant_id' => auth()->user()->tenant_id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => UserRole::Waiter->value,
                'email_verified_at' => now(),
            ]);
        } catch (UniqueConstraintViolationException) {
            $this->addError('email', 'A user with this email already exists.');

            return;
        }

        $this->reset(['name', 'email', 'password', 'password_confirmation']);

        $this->dispatch('waiter-saved');
    }

    public function render()
    {
        return view('livewire.owner.staff.form');
    }
}
````

## File: app/Livewire/Owner/Staff/Index.php
````php
<?php

namespace App\Livewire\Owner\Staff;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.owner')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    public bool $showForm = false;

    public function mount(): void
    {
        $this->authorize('viewAny', User::class);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function createWaiter(): void
    {
        $this->authorize('create', User::class);
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->showForm = false;
    }

    public function handleSaved(): void
    {
        $this->showForm = false;
        $this->resetPage();
    }

    public function deleteWaiter(int $userId): void
    {
        $staff = User::query()
            ->where('tenant_id', auth()->user()->tenant_id)
            ->find($userId);

        abort_if($staff === null, Response::HTTP_NOT_FOUND);

        $this->authorize('delete', $staff);
        $staff->delete();
    }

    public function render()
    {
        $waiters = User::query()
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('role', UserRole::Waiter->value)
            ->with([
                // Eager-load assigned tables so we can list them in the view.
                'assignedTables' => fn($q) => $q->withoutGlobalScopes()->select('tables.id', 'tables.name'),
            ])
            ->when($this->search !== '', function (Builder $query): void {
                $query->where(function (Builder $nested): void {
                    $nested
                        ->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest('id')
            ->paginate(10);

        return view('livewire.owner.staff.index', [
            'waiters' => $waiters,
        ]);
    }
}
````

## File: app/Livewire/Owner/Tables/Form.php
````php
<?php

namespace App\Livewire\Owner\Tables;

use App\Models\Table;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;

class Form extends Component
{
    public ?int $tableId = null;

    public string $name = '';

    public string $status = Table::STATUS_FREE;

    public function mount(?int $tableId = null): void
    {
        $this->tableId = $tableId;

        if ($tableId === null) {
            $this->authorize('create', Table::class);
            return;
        }

        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $this->name = $table->name;
        $this->status = $table->status;
    }

    public function save(): void
    {
        if ($this->tableId === null) {
            $this->authorize('create', Table::class);
        }

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tables', 'name')
                    ->where(fn ($query) => $query->where('tenant_id', auth()->user()->tenant_id)->whereNull('deleted_at'))
                    ->ignore($this->tableId),
            ],
        ]);

        try {
            if ($this->tableId === null) {
                $table = Table::query()->create([
                    'name' => $validated['name'],
                    'status' => Table::STATUS_FREE,
                ]);
            } else {
                $table = Table::query()->find($this->tableId);
                abort_if($table === null, Response::HTTP_NOT_FOUND);
                $this->authorize('update', $table);
                $table->update([
                    'name' => $validated['name'],
                ]);
            }
        } catch (UniqueConstraintViolationException) {
            $this->addError('name', 'A table with this name already exists for your restaurant.');

            return;
        }

        $this->dispatch('table-saved', tableId: $table->id);
    }

    public function render()
    {
        return view('livewire.owner.tables.form');
    }
}
````

## File: app/Livewire/Owner/Tables/Index.php
````php
<?php

namespace App\Livewire\Owner\Tables;

use App\Enums\UserRole;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\User;
use App\Services\TableSessionService;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.owner')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $status = '';

    public ?int $editingTableId = null;

    public bool $showForm = false;

    public bool $showQrPreview = false;

    // ── Waiter assignment state ───────────────────────────────────────────────

    /** tableId => selected waiter user_id to add (string for select binding) */
    public array $waiterSelectValues = [];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function createTable(): void
    {
        $this->editingTableId = null;
        $this->showQrPreview = false;
        $this->showForm = true;
    }

    public function editTable(int $tableId): void
    {
        $this->editingTableId = $tableId;
        $this->showQrPreview = false;
        $this->showForm = true;
    }

    public function previewQr(int $tableId): void
    {
        $this->editingTableId = $tableId;
        $this->showForm = false;
        $this->showQrPreview = true;
    }

    public function closePanels(): void
    {
        $this->showForm = false;
        $this->showQrPreview = false;
        $this->editingTableId = null;
    }

    public function markFree(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $session = TableSession::query()
            ->where('table_id', $table->getKey())
            ->where('status', TableSession::STATUS_ACTIVE)
            ->first();

        if ($session !== null) {
            $this->authorize('close', $session);
            app(TableSessionService::class)->close($session);

            return;
        }

        $table->markFree();
    }

    public function deleteTable(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('delete', $table);

        $table->delete();

        if ($this->editingTableId === $tableId) {
            $this->closePanels();
        }
    }

    public function handleSaved(int $tableId): void
    {
        $this->editingTableId = $tableId;
        $this->showForm = false;
        $this->showQrPreview = true;
    }

    // ── Waiter assignment ─────────────────────────────────────────────────────

    /**
     * Assign the selected waiter to a table.
     * Idempotent — pivot uses a composite primary key so duplicates are ignored.
     */
    public function assignWaiter(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $waiterId = (int) ($this->waiterSelectValues[$tableId] ?? 0);

        if ($waiterId === 0) {
            return;
        }

        // Verify the waiter belongs to the same tenant.
        $waiter = User::query()
            ->where('id', $waiterId)
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('role', UserRole::Waiter->value)
            ->first();

        if ($waiter === null) {
            return;
        }

        // syncWithoutDetaching prevents duplicates without removing existing ones.
        $table->assignedWaiters()->syncWithoutDetaching([$waiter->getKey()]);

        // Reset the select for this table.
        $this->waiterSelectValues[$tableId] = '';
    }

    /**
     * Remove a waiter assignment from a table.
     */
    public function removeWaiter(int $tableId, int $waiterId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $table->assignedWaiters()->detach($waiterId);
    }

    public function render()
    {
        $tables = Table::query()
            ->with([
                'assignedWaiters:id,name',
            ])
            ->when($this->search !== '', fn(Builder $query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->status !== '', fn(Builder $query) => $query->where('status', $this->status))
            ->latest()
            ->paginate(10);

        // All waiters for this tenant — used to populate assignment dropdowns.
        $waiters = User::query()
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('role', UserRole::Waiter->value)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('livewire.owner.tables.index', [
            'tables' => $tables,
            'waiters' => $waiters,
            'statusOptions' => [
                Table::STATUS_FREE => 'Free',
                Table::STATUS_OCCUPIED => 'Occupied',
            ],
        ]);
    }
}
````

## File: app/Livewire/Waiter/Requests/Index.php
````php
<?php

namespace App\Livewire\Waiter\Requests;

use App\Models\ServiceRequest;
use App\Support\ComponentRateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.waiter')]
class Index extends Component
{
    #[On('refresh')]
    public function refreshRequests(): void
    {
    }

    public function acceptRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('accept', $request);
        $request->accept(auth()->user());
    }

    public function resolveRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('resolve', $request);
        $request->resolve();
    }

    public function render()
    {
        $user = auth()->user();

        // Check whether this waiter has any assigned tables at all.
        $assignedTableIds = $user->assignedTables()
            ->withoutGlobalScopes()
            ->pluck('tables.id');

        $hasAssignedTables = $assignedTableIds->isNotEmpty();

        $requests = $hasAssignedTables
            ? ServiceRequest::query()
                ->with(['tableSession.table', 'acceptedBy'])
                ->whereHas(
                    'tableSession',
                    fn($q) => $q->whereIn('table_id', $assignedTableIds)
                )
                ->whereIn('status', [
                    ServiceRequest::STATUS_PENDING,
                    ServiceRequest::STATUS_ACCEPTED,
                ])
                ->oldest('created_at')
                ->get()
            : collect();

        return view('livewire.waiter.requests.index', [
            'requests' => $requests,
            'hasAssignedTables' => $hasAssignedTables,
        ]);
    }
}
````

## File: app/Models/TableSession.php
````php
<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Database\Factories\TableSessionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TableSession extends Model
{
    /** @use HasFactory<TableSessionFactory> */
    use BelongsToTenant, HasFactory;

    public const STATUS_ACTIVE = 'active';

    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'tenant_id',
        'table_id',
        'session_token',
        'status',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $session): void {
            if ($session->session_token !== null) {
                return;
            }

            $session->session_token = Str::random(40);
        });
    }

    protected static function newFactory(): TableSessionFactory
    {
        return TableSessionFactory::new();
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'table_session_id');
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function close(): void
    {
        if (! $this->isActive()) {
            return;
        }

        $this->forceFill([
            'status' => self::STATUS_CLOSED,
            'ended_at' => now(),
        ])->save();

        // Cancel all unresolved requests for this session.
        $this->requests()
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->update(['status' => ServiceRequest::STATUS_CANCELLED]);

        $this->table()->update(['status' => Table::STATUS_FREE]);
    }
}
````

## File: app/Policies/ServiceRequestPolicy.php
````php
<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->tenant_id !== null;
    }

    public function view(User $user, ServiceRequest $request): bool
    {
        return $user->tenant_id !== null && $user->tenant_id === $request->tenant_id;
    }

    public function accept(User $user, ServiceRequest $request): bool
    {
        if (!in_array($user->role?->value, [User::ROLE_OWNER, User::ROLE_WAITER], true)) {
            return false;
        }

        if ($user->tenant_id === null || $user->tenant_id !== $request->tenant_id) {
            return false;
        }

        if ($request->status !== ServiceRequest::STATUS_PENDING) {
            return false;
        }

        // Owners can accept any request for their tenant.
        if ($user->isOwner()) {
            return true;
        }

        // Waiters may only accept requests for tables they are assigned to.
        return $this->waiterIsAssignedToRequest($user, $request);
    }

    public function resolve(User $user, ServiceRequest $request): bool
    {
        if (!in_array($user->role?->value, [User::ROLE_OWNER, User::ROLE_WAITER], true)) {
            return false;
        }

        if ($user->tenant_id === null || $user->tenant_id !== $request->tenant_id) {
            return false;
        }

        if ($request->status !== ServiceRequest::STATUS_ACCEPTED) {
            return false;
        }

        // Owners can resolve any request for their tenant.
        if ($user->isOwner()) {
            return true;
        }

        // Waiters may only resolve requests for tables they are assigned to.
        return $this->waiterIsAssignedToRequest($user, $request);
    }

    /**
     * Check whether the given waiter is assigned to the table that raised the request.
     */
    private function waiterIsAssignedToRequest(User $user, ServiceRequest $request): bool
    {
        // Load the session → table relationship if not already loaded.
        $session = $request->relationLoaded('tableSession')
            ? $request->tableSession
            : $request->tableSession()->withoutGlobalScopes()->first();

        if ($session === null) {
            return false;
        }

        $tableId = $session->table_id;

        return $user->assignedTables()
            ->withoutGlobalScopes()
            ->where('tables.id', $tableId)
            ->exists();
    }
}
````

## File: app/Providers/AppServiceProvider.php
````php
<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\User;
use App\Policies\ProductCategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ServiceRequestPolicy;
use App\Policies\TablePolicy;
use App\Policies\TableSessionPolicy;
use App\Policies\UserPolicy;
use App\Support\CurrentTenant;
use Illuminate\Support\Facades\Gate;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CurrentTenant::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Table::class, TablePolicy::class);
        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(ProductCategory::class, ProductCategoryPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(ServiceRequest::class, ServiceRequestPolicy::class);
        Gate::policy(TableSession::class, TableSessionPolicy::class);

        RateLimiter::for('login', fn (Request $request) => Limit::perMinute(5)->by((string) $request->ip()));
        RateLimiter::for('register', fn (Request $request) => Limit::perMinute(3)->by((string) $request->ip()));
        RateLimiter::for('customer-actions', function (Request $request) {
            $sessionToken = (string) ($request->cookie('st_session_token') ?? $request->input('session_token') ?? 'guest');

            return Limit::perMinute(30)->by($request->ip().'|'.$sessionToken);
        });
        RateLimiter::for('staff-actions', fn (Request $request) => Limit::perMinute(60)->by((string) optional($request->user())->getAuthIdentifier()));
    }
}
````

## File: app/Services/ProductImageService.php
````php
<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Tenant;
use App\Support\LibraryImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductImageService
{
    public function validateUpload(UploadedFile $file): void
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($file->getMimeType(), $allowedMimeTypes, true)) {
            throw ValidationException::withMessages([
                'upload' => 'The upload must be a JPG, PNG, or WEBP image.',
            ]);
        }

        if ($file->getSize() > 4 * 1024 * 1024) {
            throw ValidationException::withMessages([
                'upload' => 'The upload must not be larger than 4 MB.',
            ]);
        }

        $dimensions = @getimagesize($file->getRealPath());

        if ($dimensions === false || $dimensions[0] < 256 || $dimensions[1] < 256) {
            throw ValidationException::withMessages([
                'upload' => 'The upload must be at least 256x256 pixels.',
            ]);
        }
    }

    public function storeUpload(Tenant $tenant, UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');

        return $file->storeAs(
            'products/' . $tenant->getKey(),
            Str::uuid()->toString() . '.' . $extension,
            config('filesystems.product_disk')
        );
    }

    public function deleteUpload(string $path): void
    {
        Storage::disk(config('filesystems.product_disk'))->delete($path);
    }

    public function applyToProduct(Product $product, string $source, ?string $key, ?UploadedFile $upload): void
    {
        $previousUploadPath = $product->image_source === Product::IMAGE_SOURCE_UPLOAD
            ? $product->image_path
            : null;

        if ($source === Product::IMAGE_SOURCE_UPLOAD) {
            if (!$upload instanceof UploadedFile) {
                throw ValidationException::withMessages([
                    'upload' => 'Please choose an image to upload.',
                ]);
            }

            $this->validateUpload($upload);

            $path = $this->storeUpload($product->tenant, $upload);

            $product->forceFill([
                'image_source' => Product::IMAGE_SOURCE_UPLOAD,
                'image_path' => $path,
            ]);

            if ($previousUploadPath !== null && $previousUploadPath !== $path) {
                $this->deleteUpload($previousUploadPath);
            }

            return;
        }

        if ($previousUploadPath !== null) {
            $this->deleteUpload($previousUploadPath);
        }

        if ($source === Product::IMAGE_SOURCE_LIBRARY) {
            // Validate that the submitted key exists in the configured library.
            // LibraryImage::exists() checks config('image_library') so it
            // automatically works with any key format (local paths, photo IDs…).
            if (!$key || !LibraryImage::exists($key)) {
                throw ValidationException::withMessages([
                    'selectedLibraryImage' => 'Please choose a valid library image.',
                ]);
            }

            $product->forceFill([
                'image_source' => Product::IMAGE_SOURCE_LIBRARY,
                'image_path' => $key,
            ]);

            return;
        }

        $product->forceFill([
            'image_source' => Product::IMAGE_SOURCE_NONE,
            'image_path' => null,
        ]);
    }
}
````

## File: app/Services/QrCodeService.php
````php
<?php

namespace App\Services;

use App\Models\Table;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class QrCodeService
{
    public function pngFor(Table $table, int $size = 512, int $margin = 2): string
    {
        $writer = new Writer(new GDLibRenderer($size, $margin, 'png'));
        $qrPng = $writer->writeString($table->getPublicUrl());

        return $this->appendLabel($qrPng, 'Table N° : ' . $table->name);
    }

    public function dataUrlFor(Table $table, int $size = 512, int $margin = 2): string
    {
        return 'data:image/png;base64,' . base64_encode($this->pngFor($table, $size, $margin));
    }

    /**
     * Stamp a centred label strip beneath the QR code image.
     *
     * GD's imagestring() uses ISO-8859-1, so we transcode the UTF-8 label
     * (the degree sign ° is 0xB0 in Latin-1) before drawing.
     */
    private function appendLabel(string $pngData, string $label): string
    {
        $qr = imagecreatefromstring($pngData);

        if ($qr === false) {
            return $pngData;
        }

        $qrW = imagesx($qr);
        $qrH = imagesy($qr);

        // Built-in GD font 5 → 9 px wide × 15 px tall per character
        $font = 5;
        $charW = imagefontwidth($font);
        $charH = imagefontheight($font);
        $padY = (int) round($qrH * 0.05);   // 5 % of QR height as top/bottom padding

        // Transcode UTF-8 → ISO-8859-1 so the degree sign renders correctly
        $encoded = function_exists('iconv')
            ? (string) iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $label)
            : $label;

        $textW = strlen($encoded) * $charW;
        $stripH = $charH + $padY * 2;

        $out = imagecreatetruecolor($qrW, $qrH + $stripH);

        if ($out === false) {
            imagedestroy($qr);

            return $pngData;
        }

        $white = imagecolorallocate($out, 255, 255, 255);
        $black = imagecolorallocate($out, 0, 0, 0);

        // White canvas, QR on top
        imagefill($out, 0, 0, $white);
        imagecopy($out, $qr, 0, 0, 0, 0, $qrW, $qrH);
        imagedestroy($qr);

        // Horizontally centred label
        $tx = max(0, (int) (($qrW - $textW) / 2));
        $ty = $qrH + $padY;
        imagestring($out, $font, $tx, $ty, $encoded, $black);

        ob_start();
        imagepng($out);
        $result = (string) ob_get_clean();
        imagedestroy($out);

        return $result;
    }
}
````

## File: app/Services/ServiceRequestService.php
````php
<?php

namespace App\Services;

use App\Models\ServiceRequest;
use App\Models\TableSession;
use Illuminate\Support\Facades\DB;

class ServiceRequestService
{
    /**
     * Atomically create a new service request or return the existing open one.
     *
     * Uses SELECT … FOR UPDATE on the session row so that concurrent "call waiter"
     * taps (double-tap, two browsers, etc.) are serialized.  Without this lock the
     * old code could pass the idempotency check in parallel and create duplicate
     * requests for the same table.
     *
     * @return array{request: ServiceRequest, created: bool, requests_ahead: int}
     */
    public function createOrReturnExisting(TableSession $session): array
    {
        return DB::transaction(function () use ($session): array {

            // Re-acquire the session inside the transaction with a row-level lock.
            // Any concurrent call blocks here until the first one commits.
            $locked = TableSession::withoutGlobalScopes()
                ->whereKey($session->getKey())
                ->where('status', TableSession::STATUS_ACTIVE)
                ->lockForUpdate()
                ->first();

            if ($locked === null) {
                // Session became inactive between the initial check and this point.
                abort(403, 'Table session is no longer active.');
            }

            // Idempotency: return any existing open request for this session.
            $existing = ServiceRequest::withoutGlobalScopes()
                ->where('table_session_id', $locked->getKey())
                ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                ->oldest('created_at')
                ->first();

            if ($existing !== null) {
                return [
                    'request' => $existing,
                    'created' => false,
                    'requests_ahead' => $this->countAhead($existing),
                ];
            }

            // Mark table occupied (status update, not a new lock needed).
            $locked->table()->withoutGlobalScopes()->first()?->markOccupied();

            // Resolve any stale open requests for this table across ALL sessions
            // (e.g. a previous session that never explicitly cancelled).
            ServiceRequest::withoutGlobalScopes()
                ->whereHas(
                    'tableSession',
                    fn($q) => $q->where('table_id', $locked->table_id)
                )
                ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                ->update(['status' => ServiceRequest::STATUS_RESOLVED, 'resolved_at' => now()]);

            $request = ServiceRequest::withoutGlobalScopes()->create([
                'tenant_id' => $locked->tenant_id,
                'table_session_id' => $locked->getKey(),
                'type' => ServiceRequest::TYPE_CALL_WAITER,
                'status' => ServiceRequest::STATUS_PENDING,
            ]);

            return [
                'request' => $request,
                'created' => true,
                'requests_ahead' => 0,
            ];
        });
    }

    /**
     * Atomically cancel a request and, when no other active requests remain for
     * the same table, mark that table free (but keep the session open).
     *
     * Previously the model's cancel() had no transaction: between the
     * status update and the "any other active requests?" check, a new request
     * could slip in, causing the table to be wrongly freed.
     */
    public function cancel(ServiceRequest $serviceRequest): void
    {
        DB::transaction(function () use ($serviceRequest): void {

            $locked = ServiceRequest::withoutGlobalScopes()
                ->whereKey($serviceRequest->getKey())
                ->lockForUpdate()
                ->first();

            if ($locked === null) {
                return;
            }

            if (
                !in_array($locked->status, [
                    ServiceRequest::STATUS_PENDING,
                    ServiceRequest::STATUS_ACCEPTED,
                ], true)
            ) {
                return;
            }

            $locked->forceFill(['status' => ServiceRequest::STATUS_CANCELLED])->save();

            // Sync the caller's model instance so it reflects the new status.
            $serviceRequest->status = ServiceRequest::STATUS_CANCELLED;

            $session = $locked->tableSession()->withoutGlobalScopes()->first();

            if ($session === null) {
                return;
            }

            $hasOtherActive = ServiceRequest::withoutGlobalScopes()
                ->whereHas('tableSession', fn($q) => $q->where('table_id', $session->table_id))
                ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                ->exists();

            if (!$hasOtherActive) {
                $session->table()->withoutGlobalScopes()->first()?->markFreeKeepSession();
            }
        });
    }

    /**
     * Count how many active requests were created before the given one.
     * Used to show the customer their queue position.
     */
    public function countAhead(ServiceRequest $serviceRequest): int
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('tenant_id', $serviceRequest->tenant_id)
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->where('created_at', '<', $serviceRequest->created_at)
            ->count();
    }

}
````

## File: app/Support/CurrentTenant.php
````php
<?php

namespace App\Support;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class CurrentTenant
{
    protected ?Tenant $tenant = null;

    public function set(?Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function tenant(): ?Tenant
    {
        if ($this->tenant === null) {
            $this->resolveFromAuth();
        }

        return $this->tenant;
    }

    public function id(): ?int
    {
        if ($this->tenant !== null) {
            return $this->tenant->getKey();
        }

        $user = Auth::user();

        if ($user !== null && method_exists($user, 'tenant')) {
            return $this->resolveFromAuth()?->getKey();
        }

        return null;
    }

    public function clear(): void
    {
        $this->tenant = null;
    }

    public function resolveFromAuth(): ?Tenant
    {
        $user = Auth::user();

        if (! $user || ! method_exists($user, 'tenant')) {
            $this->clear();

            return null;
        }

        $tenant = $user->tenant;

        $this->set($tenant);

        return $tenant;
    }
}
````

## File: bootstrap/app.php
````php
<?php

use App\Http\Middleware\EnsureRole;
use App\Http\Middleware\IdentifyTenant;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $trustedProxies = env('TRUSTED_PROXIES');

        if ($trustedProxies) {
            $middleware->trustProxies(
                at: $trustedProxies === '*'
                ? '*'
                : array_map('trim', explode(',', $trustedProxies))
            );
        }

        $middleware->alias([
            'role' => EnsureRole::class,
            'tenant' => IdentifyTenant::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Redirect to login (not a 419 error page) when the CSRF token
        // has expired — this is the "Page Expired" scenario that occurs
        // when a user submits the logout form after their session has
        // already timed out or been invalidated on another tab.
        $exceptions->render(function (TokenMismatchException $e, $request) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Your session expired. Please log in again.']);
        });
    })->create();
````

## File: config/app.php
````php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_ENV', 'production') === 'production'
        ? false
        : (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => value(function (): ?string {
        $key = env('APP_KEY');

        if (! is_string($key)) {
            return $key;
        }

        return trim(strtok($key, '#') ?: '');
    }),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
````

## File: config/filesystems.php
````php
<?php

$supabaseS3CaBundle = env('SUPABASE_S3_CA_BUNDLE');
$supabaseS3Endpoint = env('SUPABASE_S3_ENDPOINT');

if (is_string($supabaseS3Endpoint) && preg_match('#^https://([a-z0-9-]+)\.supabase\.co/storage/v1/s3/?$#i', $supabaseS3Endpoint, $matches) === 1) {
    $supabaseS3Endpoint = 'https://'.$matches[1].'.storage.supabase.co/storage/v1/s3';
}

if (! $supabaseS3CaBundle) {
    foreach ([
        'C:\\Program Files\\Git\\mingw64\\ssl\\certs\\ca-bundle.crt',
        'C:\\Program Files\\Git\\usr\\ssl\\certs\\ca-bundle.crt',
        'C:\\Program Files\\Git\\mingw64\\bin\\curl-ca-bundle.crt',
        'C:\\xampp\\apache\\bin\\curl-ca-bundle.crt',
    ] as $candidate) {
        if (is_file($candidate)) {
            $supabaseS3CaBundle = $candidate;
            break;
        }
    }
}

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    'product_disk' => env('SUPABASE_BUCKET') && env('SUPABASE_S3_ENDPOINT') && env('SUPABASE_S3_KEY') && env('SUPABASE_S3_SECRET')
        ? 'supabase_storage'
        : 'public',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

        'supabase_storage' => [
            'driver' => 's3',
            'key' => env('SUPABASE_S3_KEY'),
            'secret' => env('SUPABASE_S3_SECRET'),
            'region' => env('SUPABASE_REGION', config('services.supabase.region', 'us-east-1')),
            'bucket' => env('SUPABASE_BUCKET'),
            'endpoint' => $supabaseS3Endpoint,
            'url' => env('SUPABASE_URL') && env('SUPABASE_BUCKET')
                ? rtrim(env('SUPABASE_URL'), '/').'/storage/v1/object/public/'.env('SUPABASE_BUCKET')
                : null,
            'use_path_style_endpoint' => true,
            'http' => [
                'verify' => $supabaseS3CaBundle ?: true,
            ],
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
````

## File: database/migrations/2026_05_31_000004_create_table_sessions_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_sessions', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('table_id');
            $table->string('session_token', 40)->unique();
            $table->string('status')->default('active');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            $table->index('tenant_id', 'table_sessions_tenant_id_idx');
            $table->index('table_id', 'table_sessions_table_id_idx');
            $table->index(['table_id', 'status']);
            $table->foreign('tenant_id', 'table_sessions_tenant_id_foreign')
                ->references('id')
                ->on('tenants')
                ->cascadeOnDelete();
            $table->foreign('table_id', 'table_sessions_table_id_foreign')
                ->references('id')
                ->on('tables')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_sessions');
    }
};
````

## File: database/migrations/2026_05_31_000005_create_requests_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('table_session_id');
            $table->string('type')->default('call_waiter');
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('accepted_by')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->index('tenant_id', 'requests_tenant_id_idx');
            $table->index('table_session_id', 'requests_table_session_id_idx');
            $table->index(['tenant_id', 'status']);
            $table->foreign('tenant_id', 'requests_tenant_id_foreign')
                ->references('id')
                ->on('tenants')
                ->cascadeOnDelete();
            $table->foreign('table_session_id', 'requests_table_session_id_foreign')
                ->references('id')
                ->on('table_sessions')
                ->cascadeOnDelete();
            $table->foreign('accepted_by', 'requests_accepted_by_foreign')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
````

## File: database/migrations/2026_05_31_000006_create_products_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price_cents');
            $table->string('image_source')->default('none');
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('tenant_id', 'products_tenant_id_idx');
            $table->index(['tenant_id', 'is_active', 'sort_order']);
            $table->unique(['tenant_id', 'name']);
            $table->foreign('tenant_id', 'products_tenant_id_foreign')
                ->references('id')
                ->on('tenants')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
````

## File: database/migrations/2026_06_07_000002_add_category_id_to_products_table.php
````php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
````

## File: database/seeders/DatabaseSeeder.php
````php
<?php

namespace Database\Seeders;

use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder; // ← add this


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class); // ← add this line

        $tenantA = Tenant::factory()->create([
            'name' => 'Smoke Cafe A',
            'slug' => 'smoke-cafe-a',
        ]);

        $ownerA = User::factory()->owner($tenantA)->create([
            'name' => 'Owner A',
            'email' => 'owner-a@example.com',
        ]);

        User::factory()->waiter($tenantA)->create([
            'name' => 'Waiter A',
            'email' => 'waiter-a@example.com',
        ]);

        Table::factory()->count(2)->create([
            'tenant_id' => $tenantA->id,
        ]);

        $tenantB = Tenant::factory()->create([
            'name' => 'Smoke Cafe B',
            'slug' => 'smoke-cafe-b',
        ]);

        User::factory()->owner($tenantB)->create([
            'name' => 'Owner B',
            'email' => 'owner-b@example.com',
        ]);

        Table::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Table B1',
            'status' => Table::STATUS_FREE,
        ]);


    }
}
````

## File: docs/LOCAL_SUPABASE_SETUP.md
````markdown
# Local Supabase setup

## Verified local configuration

- Database host: `aws-0-eu-west-1.pooler.supabase.com`
- Database port: `5432`
- Database name: `postgres`
- Database user: `postgres.eishomgozxkyefnwdnna`
- SSL mode: `require`
- Supabase project ref: `eishomgozxkyefnwdnna`
- Storage bucket: `product-images`
- S3 endpoint for Laravel disk config: `https://eishomgozxkyefnwdnna.storage.supabase.co/storage/v1/s3`
- Public object URL host: `eishomgozxkyefnwdnna.supabase.co`
- S3 region: `us-east-1`

## Verified storage smoke

The local S3 adapter issue is resolved.

- Composer install completed successfully with the missing `aws/aws-sdk-php` package installed.
- `League\Flysystem\AwsS3V3\PortableVisibilityConverter` now resolves successfully.
- The local Windows PHP runtime needed a CA bundle for cURL-backed S3 calls. `config/filesystems.php` now auto-detects a common Git for Windows CA bundle path when `SUPABASE_S3_CA_BUNDLE` is not set.
- Supabase S3 writes also required:
  - the storage hostname form `https://{project-ref}.storage.supabase.co/storage/v1/s3`
  - an allowed image MIME type for the `product-images` bucket

Verified result:

- PUT: success
- HEAD/existence check: success
- Public GET: HTTP `200`
- DELETE: success
- Public URL host: `eishomgozxkyefnwdnna.supabase.co`

## RLS verification method

RLS had already been applied before this pass:

- `56` statements applied
- `24` policies present
- `6` tables with RLS enabled

Verification method used for this pass:

- App-level tenant isolation checks remain covered by the passing feature suite, especially:
  - cross-tenant owner/table/product tests
  - waiter/owner route boundary tests
  - tenant scope and authorization policy tests
- Attempted live smoke verification for cross-tenant access used:
  - owner B against owner A QR download route
  - owner B against owner A owner tables Livewire listing

## 12-step local smoke status

### Verified directly

1. Visit `/`
   - Result: pass
   - Evidence: `curl.exe -I http://127.0.0.1:8000/` returned `302` redirect to `/login`

2. Storage-backed public image path
   - Result: pass
   - Evidence: storage smoke PUT + public GET `200` + DELETE succeeded

### Blocked during scripted end-to-end run

The remaining browser-style checklist was not fully completed in this pass because the scripted registration/login flow hit Laravel CSRF/session behavior when driven outside a browser, and the fallback attempt to reuse Laravel's PHPUnit HTTP harness from a standalone PHP script is not supported cleanly by PHPUnit's runtime registry.

Exact failing command:

- `php storage/app/local-supabase-smoke.php`

Observed failing output:

- registration attempt returned HTTP `419 Page Expired`
- fallback harness run ended with:
  - `PHP Fatal error: Uncaught TypeError: PHPUnit\TextUI\Configuration\Registry::get(): Return value must be of type PHPUnit\TextUI\Configuration\Configuration, null returned`

What was tried:

1. Raw cURL flow with cookie jar + `_token`
2. Added `X-XSRF-TOKEN` header from cookie to mimic browser behavior
3. Reworked the script to use Laravel/Livewire-native actions where possible
4. Reworked auth-protected steps toward Laravel's HTTP testing harness
5. Stopped after confirming PHPUnit's standalone harness path is not reliable outside `php artisan test`

Current checklist summary:

- Step 1 redirect: pass
- Step 2 register tenant: blocked by scripted CSRF/session handling
- Steps 3-12: not claimed; require either manual browser execution or a dedicated test-case-based smoke implementation under the test runner

## Test suite

Latest verification:

- `php artisan test`
- Result: `100 passed`

## Notes

- `config/database.php` already honors `DB_SSLMODE`, so no code change was required there.
- The direct database host was not used; the working connection remained the session pooler on port `5432`.
- The Supabase bucket remains public and suitable for uploaded product images.
- `config/app.php` now trims inline `#` comments from `APP_KEY` values so local `.env` files with annotated keys do not break HTTP boot.
- The local repo still needs either:
  - a manual browser walk through the remaining smoke checklist, or
  - a proper PHPUnit/Laravel test-case-backed smoke script executed under the test runner

## Current verdict

Local Supabase database and storage wiring are working, storage public-read is verified, and the automated test suite is green.

Local deployment readiness is blocked only on completing the full browser-style 12-step smoke in a supported execution path.
````

## File: public/index.php
````php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());
````

## File: resources/js/app.js
````javascript
import './bootstrap';

import {
    onRequestChange,
    onSessionChange,
    shouldRefreshWaiterList,
    unsubscribe,
} from './realtime';


window.AppRealtime = {
    onRequestChange,
    onSessionChange,
    unsubscribe,
};
window.AppRealtimeFilters = {
    shouldRefreshWaiterList,
};
````

## File: resources/views/livewire/owner/dashboard-requests.blade.php
````php
<div x-data="{
        handle: null,
        init() {
            if (window.AppRealtime && typeof window.AppRealtime.onRequestChange === 'function') {
                this.handle = window.AppRealtime.onRequestChange(
                    { tenantId: {{ auth()->user()->tenant_id }} },
                    () => window.dispatchEvent(new CustomEvent('owner-requests-refresh')),
                );
            }
        },
        destroy() {
            if (this.handle && window.AppRealtime && typeof window.AppRealtime.unsubscribe === 'function') {
                window.AppRealtime.unsubscribe(this.handle);
            }
        },
    }" x-on:owner-requests-refresh.window="$wire.dispatch('refresh')" @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif class="space-y-6">

    <div
        class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 backdrop-blur-xl shadow-xl shadow-slate-200/50">
        {{-- Header Section --}}
        <div class="flex items-center justify-between pb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <span class="relative flex h-3.5 w-3.5">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-amber-500"></span>
                </span>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">Live Table Requests</h2>
                    <p class="text-xs font-semibold text-slate-500 mt-0.5">Real-time floor service queue</p>
                </div>
            </div>
            <a href="{{ route('owner.requests.index') }}"
                class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors bg-indigo-50 hover:bg-indigo-100/80 px-3.5 py-2 rounded-xl border border-indigo-100/50 shadow-sm">
                <span>View Full Queue</span>
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        {{-- Table/List Section --}}
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full text-left border-collapse">
                <thead>
                    <tr
                        class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100">
                        <th scope="col" class="pb-3 pr-4">Table & Session</th>
                        <th scope="col" class="pb-3 px-4">Status</th>
                        <th scope="col" class="pb-3 px-4">Wait Time</th>
                        <th scope="col" class="pb-3 pl-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($requests as $request)
                        <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                            {{-- Table & Session Info --}}
                            <td class="py-4 pr-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 border border-slate-200 text-slate-600 group-hover/row:bg-indigo-50 group-hover/row:border-indigo-100 group-hover/row:text-indigo-600 transition-colors">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $request->tableSession->table->name }}</p>
                                        <p class="mt-0.5 flex items-center gap-1 text-[10px] text-slate-400 font-mono"
                                            title="Session {{ $request->tableSession->id }}">
                                            {{ str($request->tableSession->session_token)->limit(8) }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Status Badge --}}
                            <td class="py-4 px-4 align-middle">
                                <div class="flex items-center">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm"
                                            title="Accepted by {{ $request->acceptedBy?->name ?? 'Staff' }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Accepted
                                        </span>
                                    @endif
                                </div>
                            </td>

                            {{-- Wait Time --}}
                            <td class="py-4 px-4 align-middle" x-data="{ 
                                        elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($request->created_at, true) }}')) || 0,
                                        timer: null,
                                        init() { 
                                            this.timer = setInterval(() => this.elapsed++, 1000); 
                                        },
                                        destroy() { 
                                            clearInterval(this.timer); 
                                        },
                                        formatTime(rawSeconds) {
                                            const total = Math.floor(rawSeconds);
                                            if (total < 60) return `${total}s`;
                                            const m = Math.floor(total / 60);
                                            const s = total % 60;
                                            return `${m}m ${s.toString().padStart(2, '0')}s`;
                                        }
                                    }">
                                <div
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-50 px-2.5 py-1 border border-slate-100 font-mono text-xs font-semibold text-slate-600">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span x-text="formatTime(elapsed)"></span>
                                </div>
                            </td>

                            {{-- Action Buttons --}}
                            <td class="py-4 pl-4 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <button wire:click="acceptRequest({{ $request->id }})" type="button"
                                            class="inline-flex items-center gap-1.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                            <span>Accept</span>
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    @elseif ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                        <button wire:click="resolveRequest({{ $request->id }})" type="button"
                                            class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/10 hover:shadow-emerald-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span>Resolve</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800">No Active Requests</h3>
                                    <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">
                                        All clean! When customers call for assistance at their tables, they will show up
                                        here.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
````

## File: resources/views/livewire/owner/staff/form.blade.php
````php
<form wire:submit="save" class="space-y-5">
    <div>
        <label for="waiter-name" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Name</label>
        <input wire:model.blur="name" id="waiter-name" type="text" placeholder="e.g. John Doe" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('name')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-email" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Email</label>
        <input wire:model.blur="email" id="waiter-email" type="email" placeholder="e.g. john@example.com" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('email')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-password" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Password</label>
        <input wire:model.blur="password" id="waiter-password" type="password" placeholder="••••••••" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('password')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="waiter-password-confirmation" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Confirm Password</label>
        <input wire:model.blur="password_confirmation" id="waiter-password-confirmation" type="password" placeholder="••••••••" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-xs text-slate-500 font-semibold leading-relaxed shadow-inner">
        New waiter accounts are marked email-verified immediately because the owner provisions the login directly.
    </div>

    <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        Create Waiter
    </button>
</form>
````

## File: resources/views/livewire/owner/tables/form.blade.php
````php
<form wire:submit="save" class="space-y-5">
    <div>
        <label for="table-name" class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Name</label>
        <input wire:model.blur="name" id="table-name" type="text" placeholder="e.g. Table 5" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
        @error('name')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <p class="mb-2 text-xs font-black uppercase tracking-[0.2em] text-slate-500">Status</p>
        <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600 font-bold shadow-sm">
            @if ($status === \App\Models\Table::STATUS_FREE)
                <span class="inline-flex items-center gap-1.5 text-emerald-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Free
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 text-amber-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    Occupied
                </span>
            @endif
        </div>
    </div>

    <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        {{ $tableId ? 'Save Changes' : 'Create Table' }}
    </button>
</form>
````

## File: resources/views/livewire/owner/tables/qr-preview.blade.php
````php
<div class="space-y-5">
    <div class="overflow-hidden rounded-2xl bg-white p-4 border border-slate-200 shadow-sm max-w-[200px] mx-auto">
        <img src="{{ $qrDataUrl }}" alt="QR for {{ $table->name }}" class="mx-auto block h-auto w-full">
    </div>

    <div class="space-y-3">
        <h3 class="text-lg font-black text-slate-900">{{ $table->name }}</h3>
        <p class="text-xs text-slate-500 break-all font-mono bg-slate-50 border border-slate-100 p-2.5 rounded-xl shadow-inner select-all block" title="Click to select all">{{ $table->getPublicUrl() }}</p>
    </div>

    <a href="{{ route('owner.tables.qr.download', $table) }}" class="inline-flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        <span>Download PNG</span>
    </a>
</div>
````

## File: tests/Feature/Customer/CustomerSessionTest.php
````php
<?php

namespace Tests\Feature\Customer;

use App\Livewire\Customer\TablePage;
use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_free_table_route_creates_session_sets_cookie_and_does_not_mark_table_occupied(): void
    {
        $table = Table::factory()->create([
            'name' => 'Deck 7',
        ]);

        $response = $this->get('/t/'.$table->qr_token);

        $response->assertOk()
            ->assertSeeText('Call Waiter')
            ->assertCookie(TablePage::SESSION_COOKIE);

        $session = TableSession::withoutGlobalScopes()->first();

        $this->assertNotNull($session);
        $this->assertSame($table->id, $session->table_id);
        $this->assertSame(TableSession::STATUS_ACTIVE, $session->status);
        $this->assertDatabaseHas('tables', [
            'id' => $table->id,
            'status' => Table::STATUS_FREE,
        ]);
    }

    public function test_same_device_rescan_resumes_existing_session(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token)->assertOk();

        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        $this->withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->get('/t/'.$table->qr_token)
            ->assertOk()
            ->assertSeeText('Call Waiter');

        $this->assertDatabaseCount('table_sessions', 1);
        $this->assertSame($session->id, TableSession::withoutGlobalScopes()->firstOrFail()->id);
    }

    public function test_different_device_on_occupied_table_is_blocked(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token)->assertOk();

        $table->markOccupied();

        $this->get('/t/'.$table->qr_token)
            ->assertOk()
            ->assertSeeText('currently in use')
            ->assertDontSeeText('Call Waiter');

        $this->assertDatabaseCount('table_sessions', 1);
    }

    public function test_soft_deleted_table_returns_404(): void
    {
        $table = Table::factory()->create();
        $table->delete();

        $this->get('/t/'.$table->qr_token)->assertNotFound();
    }
}
````

## File: tests/Feature/ExampleTest.php
````php
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Smart Table')
            ->assertSee('Get started')
            ->assertSee('Features')
            ->assertSee('How it works');
    }
}
````

## File: .env.production.example
````
APP_NAME="Smart Table"
APP_ENV=production
APP_KEY=base64:IMsJKTUvowmAOp1prdpQl63fvf2GviCl60TRDqZ7C2I=
APP_DEBUG=false
APP_URL=https://smartable.space

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=daily
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=warning

# --- Database: Supabase Postgres (session pooler, eu-west-1) ---
DB_CONNECTION=pgsql
DB_HOST=aws-0-eu-west-1.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.eishomgozxkyefnwdnna
DB_PASSWORD=Jaja1990@Jaja
DB_SCHEMA=public
DB_SSLMODE=require

# --- Sessions / cache / queue ---
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=true
SESSION_PATH=/
SESSION_DOMAIN=.smartable.space
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

CACHE_STORE=database
QUEUE_CONNECTION=database
BROADCAST_CONNECTION=log

# --- Filesystem: push uploads to Supabase Storage ---
FILESYSTEM_DISK=supabase_storage

# --- Mail (placeholder; swap to real SMTP — Hostinger gives you SMTP creds in hPanel → Emails) ---
MAIL_MAILER=log
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="no-reply@smartable.space"
MAIL_FROM_NAME="${APP_NAME}"

# --- Supabase ---
SUPABASE_URL=https://eishomgozxkyefnwdnna.supabase.co
SUPABASE_PROJECT_REF=eishomgozxkyefnwdnna
SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVpc2hvbWdvenhreWVmbndkbm5hIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODAyNDUxOTMsImV4cCI6MjA5NTgyMTE5M30.kWG1ybv9iewlQT9fhpf1Rf7PnScF3s39u6ZZGPF9K44
SUPABASE_SERVICE_ROLE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVpc2hvbWdvenhreWVmbndkbm5hIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc4MDI0NTE5MywiZXhwIjoyMDk1ODIxMTkzfQ.8J-50nvoDkmrt6x3rraxF2ZL2l4rVsCJjB8Tec5CVmQ
SUPABASE_REALTIME_ANON_ENABLED=false
SUPABASE_BUCKET=product-images
SUPABASE_S3_ENDPOINT=https://eishomgozxkyefnwdnna.storage.supabase.co/storage/v1/s3
SUPABASE_REGION=us-east-1
SUPABASE_S3_KEY=e54f91ee47931a612ff4b59dd8f2326d
SUPABASE_S3_SECRET=a9e7346edab8af934ca33b3d23be54914b330565620886007a0b40f7a70a4e22

# --- AWS block (unused; Supabase handles storage) ---
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
TRUSTED_PROXIES=*
````

## File: .gitignore
````
*.log
.DS_Store
Thumbs.db
.phpactor.json
.phpunit.result.cache
/.fleet
/.idea
/.nova
/.phpunit.cache
/.vscode
/.zed
/auth.json
/node_modules
/public/hot
/public/storage
/storage/*.key
/storage/pail
/vendor
Homestead.json
Homestead.yaml
npm-debug.log*
yarn-debug.log*
yarn-error.log*
dist/
build/
*.tmp
*.temp
.cache/
.env
.env.backup
.env.production
.env.*
!.env.example
!.env.production.example
storage/app/products/*
smoke-*.html
````

## File: app/Models/ServiceRequest.php
````php
<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Database\Factories\ServiceRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    /** @use HasFactory<ServiceRequestFactory> */
    use BelongsToTenant, HasFactory;

    public const TYPE_CALL_WAITER = 'call_waiter';

    public const STATUS_PENDING = 'pending';

    public const STATUS_ACCEPTED = 'accepted';

    public const STATUS_RESOLVED = 'resolved';

    public const STATUS_CANCELLED = 'cancelled';

    protected $table = 'requests';

    protected $fillable = [
        'tenant_id',
        'table_session_id',
        'type',
        'status',
        'accepted_by',
        'accepted_at',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'accepted_at' => 'datetime',
            'resolved_at' => 'datetime',
        ];
    }

    protected static function newFactory(): ServiceRequestFactory
    {
        return ServiceRequestFactory::new();
    }

    public function tableSession(): BelongsTo
    {
        return $this->belongsTo(TableSession::class, 'table_session_id');
    }

    public function acceptedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function accept(User $user): void
    {
        if ($this->status !== self::STATUS_PENDING) {
            return;
        }

        $this->forceFill([
            'status' => self::STATUS_ACCEPTED,
            'accepted_by' => $user->getKey(),
            'accepted_at' => now(),
        ])->save();
    }

    public function resolve(): void
    {
        if ($this->status !== self::STATUS_ACCEPTED) {
            return;
        }

        $this->forceFill([
            'status' => self::STATUS_RESOLVED,
            'resolved_at' => now(),
        ])->save();

        $session = TableSession::withoutGlobalScopes()->find($this->table_session_id);

        if ($session === null) {
            return;
        }

        $hasOtherActiveRequests = self::withoutGlobalScopes()
            ->whereHas('tableSession', fn($q) => $q->where('table_id', $session->table_id))
            ->whereIn('status', [self::STATUS_PENDING, self::STATUS_ACCEPTED])
            ->exists();

        if (!$hasOtherActiveRequests) {
            Table::withoutGlobalScopes()->find($session->table_id)?->markFreeKeepSession();
        }
    }

    public function cancel(): void
    {
        if (!in_array($this->status, [self::STATUS_PENDING, self::STATUS_ACCEPTED], true)) {
            return;
        }

        $this->forceFill([
            'status' => self::STATUS_CANCELLED,
        ])->save();

        // If no other active requests remain for this table, mark it free.
        $session = $this->tableSession()->withoutGlobalScopes()->first();

        if ($session === null) {
            return;
        }

        $hasOtherActiveRequests = self::withoutGlobalScopes()
            ->whereHas('tableSession', fn($q) => $q->where('table_id', $session->table_id))
            ->whereIn('status', [self::STATUS_PENDING, self::STATUS_ACCEPTED])
            ->exists();

        if (!$hasOtherActiveRequests) {
            $session->table()->withoutGlobalScopes()->first()?->markFreeKeepSession();
        }
    }
}
````

## File: app/Models/Table.php
````php
<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Database\Factories\TableFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Table extends Model
{
    /** @use HasFactory<TableFactory> */
    use BelongsToTenant, HasFactory, SoftDeletes;

    public const STATUS_FREE = 'free';

    public const STATUS_OCCUPIED = 'occupied';

    protected $fillable = [
        'name',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $table): void {
            if ($table->qr_token !== null) {
                return;
            }

            $table->qr_token = static::generateUniqueQrToken();
        });
    }

    protected static function newFactory(): TableFactory
    {
        return TableFactory::new();
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(TableSession::class);
    }

    public function activeSession(): HasOne
    {
        return $this->hasOne(TableSession::class)->where('status', TableSession::STATUS_ACTIVE);
    }

    /**
     * Waiters assigned to this table.
     */
    public function assignedWaiters(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'table_waiter', 'table_id', 'user_id')
            ->withTimestamps();
    }

    public function getPublicUrl(): string
    {
        return route('customer.table', ['qr_token' => $this->qr_token]);
    }

    public function markOccupied(): void
    {
        if ($this->status === self::STATUS_OCCUPIED) {
            return;
        }

        $this->forceFill(['status' => self::STATUS_OCCUPIED])->save();
    }

    public function markFree(): void
    {
        $activeSession = $this->sessions()
            ->where('status', TableSession::STATUS_ACTIVE)
            ->first();

        if ($activeSession !== null) {
            $activeSession->forceFill([
                'status' => TableSession::STATUS_CLOSED,
                'ended_at' => now(),
            ])->save();
        }

        if ($this->status !== self::STATUS_FREE) {
            $this->forceFill(['status' => self::STATUS_FREE])->save();
        }
    }

    /**
     * Reset the table status to free without closing the active session.
     * Used when a customer cancels their request but is still seated.
     */
    public function markFreeKeepSession(): void
    {
        if ($this->status !== self::STATUS_FREE) {
            $this->forceFill(['status' => self::STATUS_FREE])->save();
        }
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Builder
    {
        return parent::resolveRouteBindingQuery($query, $value, $field)->whereNull($this->getQualifiedDeletedAtColumn());
    }

    protected static function generateUniqueQrToken(): string
    {
        do {
            $token = Str::random(32);
        } while (static::withoutGlobalScopes()->withTrashed()->where('qr_token', $token)->exists());

        return $token;
    }
}
````

## File: app/Models/User.php
````php
<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    public const ROLE_OWNER = 'owner';

    public const ROLE_WAITER = 'waiter';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
        'role',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Tables this waiter is assigned to.
     */
    public function assignedTables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class, 'table_waiter', 'user_id', 'table_id')
            ->withTimestamps();
    }

    public function isOwner(): bool
    {
        return $this->role?->value === self::ROLE_OWNER;
    }

    public function isWaiter(): bool
    {
        return $this->role?->value === self::ROLE_WAITER;
    }

    public function dashboardRouteName(): string
    {
        return $this->isWaiter() ? 'waiter.dashboard' : 'owner.dashboard';
    }
}
````

## File: composer.json
````json
{
    "$schema": "https://getcomposer.org/schema.json",
    "name": "laravel/laravel",
    "type": "project",
    "description": "The skeleton application for the Laravel framework.",
    "keywords": ["laravel", "framework"],
    "license": "MIT",
    "require": {
        "php": "^8.2",
        "bacon/bacon-qr-code": "3.0",
        "laravel/framework": "^12.0",
        "laravel/tinker": "^2.10.1",
        "league/flysystem-aws-s3-v3": "3.0",
        "livewire/livewire": "3.6.4"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "laravel/boost": "^2.4",
        "laravel/breeze": "^2.4",
        "laravel/pail": "^1.2.2",
        "laravel/pint": "^1.24",
        "laravel/sail": "^1.41",
        "mockery/mockery": "^1.6",
        "nunomaduro/collision": "^8.6",
        "phpunit/phpunit": "^11.5.50"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "setup": [
            "composer install",
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\"",
            "@php artisan key:generate",
            "@php artisan migrate --force",
            "npm install",
            "npm run build"
        ],
        "dev": [
            "Composer\\Config::disableProcessTimeout",
            "npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others"
        ],
        "test": [
            "@php artisan config:clear --ansi",
            "@php artisan test"
        ],
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi",
            "@php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\"",
            "@php artisan migrate --graceful --ansi"
        ],
        "pre-package-uninstall": [
            "Illuminate\\Foundation\\ComposerScripts::prePackageUninstall"
        ]
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true,
            "php-http/discovery": true
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
````

## File: public/.htaccess
````
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Handle X-XSRF-Token Header
    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
````

## File: resources/views/layouts/customer.blade.php
````php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.realtime-config')

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="min-h-screen bg-gradient-to-tr from-slate-50 via-indigo-50/20 to-amber-50/30 font-sans text-slate-800 antialiased">
    <div class="absolute -right-10 -top-10 h-72 w-72 rounded-full bg-amber-200/20 blur-[80px] pointer-events-none">
    </div>
    <div class="absolute -left-10 bottom-20 h-72 w-72 rounded-full bg-indigo-200/20 blur-[80px] pointer-events-none">
    </div>

    <main class="mx-auto min-h-screen max-w-3xl px-6 py-10 relative z-10">
        {{ $slot }}
    </main>
</body>

</html>
````

## File: resources/views/livewire/owner/staff/index.blade.php
````php
<div class="space-y-6">
    <section
        class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span
                    class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-xl border border-indigo-100 shadow-sm inline-block">
                    Owner Staff
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Staff</h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">Create tenant-scoped waiter
                    accounts and revoke access with soft deletion when staff leave. Assign tables from the Tables page.
                </p>
            </div>

            <button wire:click="createWaiter" type="button"
                class="shrink-0 group inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <span>Create Waiter</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>

        <div class="mt-6 max-w-xl">
            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search waiter name or email..."
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
        <div
            class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Assigned Tables</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-transparent">
                        @forelse ($waiters as $waiter)
                            <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                                <td class="px-6 py-4 align-middle">
                                    <p class="font-bold text-slate-800">{{ $waiter->name }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle text-sm text-slate-600 font-medium">{{ $waiter->email }}
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($waiter->assignedTables->isNotEmpty())
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($waiter->assignedTables as $table)
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-slate-100 border border-slate-200 px-2.5 py-0.5 text-[10px] font-bold text-slate-600">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-400"></span>
                                                    {{ $table->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-[11px] text-slate-400 italic">None yet — assign from Tables</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($waiter->email_verified_at)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Provisioned
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle text-right">
                                    <div class="flex justify-end">
                                        <button wire:click="deleteWaiter({{ $waiter->id }})" type="button"
                                            class="rounded-xl border border-red-200 bg-red-50/50 px-3.5 py-2 text-xs font-bold text-red-600 hover:bg-red-50 hover:border-red-300 shadow-sm transition-all duration-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-800">No Waiters Found</h3>
                                        <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">Try adjusting your
                                            search query or creating a new waiter account.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 px-6 py-4">
                {{ $waiters->links() }}
            </div>
        </div>

        <div class="space-y-6">
            @if ($showForm)
                <div
                    class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">Create Waiter</h2>
                        <button wire:click="closeForm" type="button"
                            class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">Close</button>
                    </div>

                    <livewire:owner.staff.form :key="'staff-form-' . ($showForm ? 'open' : 'closed')"
                        @waiter-saved="handleSaved" />
                </div>
            @endif

            {{-- Help callout --}}
            @if (!$showForm)
                <div class="rounded-[2rem] border border-indigo-100 bg-indigo-50/60 p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-indigo-800">Assigning Tables</p>
                            <p class="mt-1 text-xs text-indigo-700 leading-relaxed">
                                Table assignments are managed from the
                                <a href="{{ route('owner.tables.index') }}"
                                    class="underline font-bold hover:text-indigo-900">Tables page</a>.
                                Each table row has a dropdown to add waiters. Waiters only see requests for their assigned
                                tables.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
````

## File: resources/views/livewire/owner/tables/index.blade.php
````php
<div class="space-y-6">
    <section class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-xl border border-indigo-100 shadow-sm inline-block">
                    Owner Tables
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Tables</h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">Create tenant-scoped tables, preview their QR codes, manage availability, and assign waiters.</p>
            </div>

            <button wire:click="createTable" type="button" class="shrink-0 group inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <span>Create Table</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search table name..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Status</span>
                <select wire:model.live="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
                    <option value="">All statuses</option>
                    @foreach ($statusOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
        <div class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                            <th class="px-6 py-4">Name & Waiters</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Public URL</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($tables as $table)
                            <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                                {{-- Name + assigned waiters + assignment control --}}
                                <td class="px-6 py-4 align-top min-w-[220px]">
                                    <p class="font-bold text-slate-800">{{ $table->name }}</p>
                                    <p class="mt-0.5 text-[10px] text-slate-400 font-mono">{{ $table->qr_token }}</p>

                                    {{-- Assigned waiters --}}
                                    @if ($table->assignedWaiters->isNotEmpty())
                                        <div class="mt-2 flex flex-wrap gap-1.5">
                                            @foreach ($table->assignedWaiters as $waiter)
                                                <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 border border-indigo-100 pl-2 pr-1 py-0.5 text-[10px] font-bold text-indigo-700">
                                                    {{ $waiter->name }}
                                                    <button
                                                        wire:click="removeWaiter({{ $table->id }}, {{ $waiter->id }})"
                                                        wire:confirm="Remove {{ $waiter->name }} from {{ $table->name }}?"
                                                        type="button"
                                                        class="flex h-4 w-4 items-center justify-center rounded-full hover:bg-indigo-200 transition-colors"
                                                        title="Remove assignment"
                                                    >
                                                        <svg class="h-2.5 w-2.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                                                        </svg>
                                                    </button>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="mt-1.5 text-[10px] text-slate-400 italic">No waiters assigned</p>
                                    @endif

                                    {{-- Assign waiter control --}}
                                    @if ($waiters->isNotEmpty())
                                        <div class="mt-2 flex gap-1.5">
                                            <select
                                                wire:model="waiterSelectValues.{{ $table->id }}"
                                                class="min-w-0 flex-1 rounded-lg border border-slate-200 bg-white px-2 py-1 text-xs text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 transition"
                                            >
                                                <option value="">Add waiter…</option>
                                                @foreach ($waiters as $waiter)
                                                    @unless ($table->assignedWaiters->contains('id', $waiter->id))
                                                        <option value="{{ $waiter->id }}">{{ $waiter->name }}</option>
                                                    @endunless
                                                @endforeach
                                            </select>
                                            <button
                                                wire:click="assignWaiter({{ $table->id }})"
                                                type="button"
                                                class="shrink-0 rounded-lg border border-indigo-200 bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700 hover:bg-indigo-100 hover:border-indigo-300 transition-all"
                                            >
                                                Assign
                                            </button>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-top">
                                    @if ($table->status === \App\Models\Table::STATUS_FREE)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Free
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Occupied
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-top text-sm">
                                    <a href="{{ $table->getPublicUrl() }}" target="_blank" class="break-all text-indigo-600 hover:text-indigo-700 font-semibold hover:underline">{{ $table->getPublicUrl() }}</a>
                                </td>

                                <td class="px-6 py-4 align-top">
                                    <div class="flex flex-wrap justify-end gap-1.5">
                                        <button wire:click="previewQr({{ $table->id }})" type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">QR</button>
                                        <a href="{{ route('owner.tables.qr.download', $table) }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">Download QR</a>
                                        <button wire:click="editTable({{ $table->id }})" type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">Edit</button>
                                        @if ($table->status !== \App\Models\Table::STATUS_FREE)
                                            <button wire:click="markFree({{ $table->id }})" type="button" class="rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 hover:bg-emerald-100 hover:border-emerald-300 shadow-sm transition-all duration-200">Mark Free</button>
                                        @endif
                                        <button wire:click="deleteTable({{ $table->id }})" type="button" class="rounded-xl border border-red-200 bg-red-50/50 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 hover:border-red-300 shadow-sm transition-all duration-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-800">No Tables Found</h3>
                                        <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">Try adjusting your search query or creating a new table.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 px-6 py-4">
                {{ $tables->links() }}
            </div>
        </div>

        <div class="space-y-6">
            @if ($showForm)
                <div class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">{{ $editingTableId ? 'Edit Table' : 'Create Table' }}</h2>
                        <button wire:click="closePanels" type="button" class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">Close</button>
                    </div>

                    <livewire:owner.tables.form :table-id="$editingTableId" :key="'table-form-'.$editingTableId" @table-saved="handleSaved($event.detail.tableId)" />
                </div>
            @endif

            @if ($showQrPreview && $editingTableId)
                <div class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">QR Preview</h2>
                        <button wire:click="closePanels" type="button" class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">Close</button>
                    </div>

                    <livewire:owner.tables.qr-preview :table-id="$editingTableId" :key="'table-qr-'.$editingTableId" />
                </div>
            @endif
        </div>
    </section>
</div>
````

## File: resources/views/welcome.blade.php
````php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Smart Table</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 font-sans text-slate-900 antialiased">
        @php($navLinks = [
            ['label' => 'Features', 'href' => '#features'],
            ['label' => 'How it works', 'href' => '#how-it-works'],
            ['label' => 'Pricing', 'href' => '#pricing'],
            ['label' => 'FAQ', 'href' => '#faq'],
        ])

        <div class="relative overflow-x-hidden">
            <div class="absolute inset-x-0 top-0 -z-10 h-[36rem] bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.14),_transparent_55%)]"></div>
            <div class="absolute right-0 top-24 -z-10 h-72 w-72 rounded-full bg-sky-200/40 blur-3xl"></div>

            <header
                x-data="{ mobileOpen: false, scrolled: false }"
                x-init="scrolled = window.scrollY > 12; window.addEventListener('scroll', () => scrolled = window.scrollY > 12)"
                class="sticky top-0 z-50"
            >
                <nav
                    class="border-b transition duration-300"
                    :class="scrolled ? 'border-slate-200/80 bg-white/90 backdrop-blur-xl shadow-sm' : 'border-transparent bg-white/70 backdrop-blur-md'"
                    aria-label="Primary"
                >
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex h-18 items-center justify-between gap-4">
                            <a href="/" class="flex items-center gap-3" aria-label="Smart Table home">
                                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20">
                                    <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                        <rect x="4.5" y="5.5" width="15" height="4" rx="1.5"></rect>
                                        <path d="M7.5 9.5v9m9-9v9M5.5 18.5h13"></path>
                                        <path d="M9 3.5v2m6-2v2"></path>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-lg font-semibold tracking-tight text-slate-950">Smart Table</p>
                                    <p class="text-xs font-medium text-slate-500">Restaurant service, simplified</p>
                                </div>
                            </a>

                            <div class="hidden items-center gap-8 lg:flex">
                                @foreach ($navLinks as $link)
                                    <a href="{{ $link['href'] }}" class="text-sm font-medium text-slate-600 transition hover:text-slate-950">
                                        {{ $link['label'] }}
                                    </a>
                                @endforeach
                            </div>

                            <div class="hidden items-center gap-3 lg:flex">
                                @auth
                                    <a href="{{ route(auth()->user()->dashboardRouteName()) }}" class="text-sm font-semibold text-slate-700 transition hover:text-indigo-600">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="rounded-full px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-white hover:text-slate-950">
                                        Login
                                    </a>
                                    <a href="{{ route('register') }}" class="rounded-full bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700">
                                        Get started
                                    </a>
                                @endauth
                            </div>

                            <button
                                type="button"
                                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:text-slate-950 lg:hidden"
                                @click="mobileOpen = !mobileOpen"
                                :aria-expanded="mobileOpen.toString()"
                                aria-controls="mobile-menu"
                                aria-label="Toggle navigation menu"
                            >
                                <svg x-show="!mobileOpen" x-transition.opacity class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M4 7h16M4 12h16M4 17h16"></path>
                                </svg>
                                <svg x-show="mobileOpen" x-transition.opacity class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M6 6l12 12M18 6L6 18"></path>
                                </svg>
                            </button>
                        </div>

                        <div
                            id="mobile-menu"
                            x-show="mobileOpen"
                            x-transition.opacity.scale.origin.top
                            class="pb-4 lg:hidden"
                            @click.outside="mobileOpen = false"
                        >
                            <div class="space-y-2 rounded-3xl border border-slate-200 bg-white p-4 shadow-xl shadow-slate-200/60">
                                @foreach ($navLinks as $link)
                                    <a href="{{ $link['href'] }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100" @click="mobileOpen = false">
                                        {{ $link['label'] }}
                                    </a>
                                @endforeach

                                <div class="border-t border-slate-200 pt-2">
                                    @auth
                                        <a href="{{ route(auth()->user()->dashboardRouteName()) }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="block rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                                            Login
                                        </a>
                                        <a href="{{ route('register') }}" class="mt-2 block rounded-2xl bg-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-indigo-700">
                                            Get started
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <main>
                <section class="relative">
                    <div class="container mx-auto px-4 pb-20 pt-12 sm:px-6 lg:px-8 lg:pb-24 lg:pt-20">
                        <div class="grid items-center gap-14 lg:grid-cols-[1.1fr_0.9fr]">
                            <div class="max-w-2xl">
                                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-4 py-2 text-sm font-medium text-indigo-700 shadow-sm">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    Live table requests and menu browsing for cafés and restaurants
                                </div>
                                <h1 class="mt-6 text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl lg:text-6xl">
                                    Turn every table into a smart waiter
                                </h1>
                                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                                    Smart Table lets guests scan a QR code, open a table session, browse the menu in real time, and call staff instantly. Your team gets a live dashboard built for fast service across every location.
                                </p>
                                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-700">
                                        Get started free
                                    </a>
                                    <a href="#how-it-works" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-950">
                                        See how it works
                                    </a>
                                </div>
                                <dl class="mt-10 grid gap-4 text-sm text-slate-600 sm:grid-cols-3">
                                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                        <dt class="font-semibold text-slate-950">Multi-tenant</dt>
                                        <dd class="mt-1">Separate restaurants and staff with secure tenancy.</dd>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                        <dt class="font-semibold text-slate-950">Real-time</dt>
                                        <dd class="mt-1">Live updates for waiter calls with polling fallback.</dd>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                        <dt class="font-semibold text-slate-950">No app needed</dt>
                                        <dd class="mt-1">Guests scan once and use any phone browser.</dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="relative mx-auto w-full max-w-xl">
                                <div class="absolute -left-6 top-10 hidden h-32 w-32 rounded-full bg-indigo-200/60 blur-3xl sm:block"></div>
                                <div class="absolute -right-4 bottom-0 h-40 w-40 rounded-full bg-sky-200/50 blur-3xl"></div>

                                <div class="relative rounded-[2rem] border border-slate-200/80 bg-white p-5 shadow-2xl shadow-slate-200/70">
                                    <div class="rounded-[1.75rem] bg-slate-950 p-3">
                                        <div class="mx-auto flex h-[34rem] max-w-[20rem] flex-col rounded-[1.6rem] border border-white/10 bg-slate-900 p-4 text-white shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                                            <div class="mx-auto mb-4 h-1.5 w-20 rounded-full bg-white/15"></div>
                                            <div class="rounded-3xl bg-gradient-to-br from-indigo-500 via-sky-500 to-cyan-400 p-5">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <p class="text-xs uppercase tracking-[0.28em] text-white/70">Table 07</p>
                                                        <p class="mt-2 text-2xl font-semibold">Welcome back</p>
                                                    </div>
                                                    <div class="rounded-2xl bg-white/15 p-3 backdrop-blur">
                                                        <svg viewBox="0 0 24 24" class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                            <path d="M7 7h4v4H7zM13 7h4v4h-4zM7 13h4v4H7z"></path>
                                                            <path d="M13 13h1m3 0h-1m-3 4h4"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="mt-6 rounded-3xl bg-white/15 p-4 backdrop-blur">
                                                    <p class="text-sm text-white/80">Scan complete · session active</p>
                                                    <p class="mt-2 text-lg font-semibold">Need something?</p>
                                                    <button type="button" class="mt-4 flex w-full items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-indigo-700 shadow-sm">
                                                        Call waiter
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="mt-4 grid grid-cols-2 gap-3">
                                                <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                                                    <p class="text-xs uppercase tracking-[0.24em] text-white/50">Menu</p>
                                                    <p class="mt-3 text-sm font-semibold">Today’s specials</p>
                                                    <p class="mt-2 text-xs leading-5 text-slate-300">Live catalog with images, categories, and prices.</p>
                                                </div>
                                                <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                                                    <p class="text-xs uppercase tracking-[0.24em] text-white/50">Status</p>
                                                    <p class="mt-3 text-sm font-semibold">2 min response</p>
                                                    <div class="mt-3 flex items-center gap-2 text-xs text-emerald-300">
                                                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                                                        Staff dashboard online
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 rounded-3xl border border-white/10 bg-white/5 p-4">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p class="text-sm font-semibold">Live dashboard sync</p>
                                                        <p class="mt-1 text-xs text-slate-300">Requests stream instantly to your team.</p>
                                                    </div>
                                                    <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-400/10 text-emerald-300">
                                                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                            <path d="M5 12a7 7 0 0 1 14 0"></path>
                                                            <path d="M8.5 12a3.5 3.5 0 0 1 7 0"></path>
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pointer-events-none absolute -right-5 top-12 hidden rounded-3xl border border-slate-200 bg-white p-4 shadow-xl lg:block">
                                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Staff alert</p>
                                        <p class="mt-2 text-sm font-semibold text-slate-900">Table 07 called waiter</p>
                                        <p class="mt-1 text-xs text-slate-500">Received instantly on the dashboard.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="border-y border-slate-200 bg-white/80">
                    <div class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
                        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                            @foreach ([
                                ['title' => 'No app to install', 'copy' => 'Customers scan a QR code and use the browser they already have.'],
                                ['title' => 'Real-time table calls', 'copy' => 'Waiter requests appear live with a resilient polling fallback.'],
                                ['title' => 'Multi-tenant ready', 'copy' => 'Built for multiple venues with staff roles and isolated data.'],
                                ['title' => 'Works on any device', 'copy' => 'Phones, tablets, and desktop dashboards stay in sync.'],
                            ] as $prop)
                                <div class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                                    <span class="mt-1 flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                        <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                            <path d="M12 3v18M3 12h18"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <h2 class="font-semibold text-slate-950">{{ $prop['title'] }}</h2>
                                        <p class="mt-1 text-sm leading-6 text-slate-600">{{ $prop['copy'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="features" class="py-20 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-2xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Features</p>
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Everything your dining room needs to stay responsive</h2>
                            <p class="mt-4 text-lg text-slate-600">Smart Table is designed around the features already powering your café or restaurant workflow.</p>
                        </div>

                        <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ([
                                ['title' => 'QR per table', 'copy' => 'Generate unique QR codes for every table so guests always land in the right place.', 'icon' => 'qr'],
                                ['title' => 'Customer sessions', 'copy' => 'Open table sessions tied to the guest visit for a smooth self-service experience.', 'icon' => 'session'],
                                ['title' => 'Call waiter', 'copy' => 'Let customers request staff assistance instantly with one tap from the table page.', 'icon' => 'bell'],
                                ['title' => 'Live dashboard', 'copy' => 'Staff receive live requests immediately, with polling fallback when needed.', 'icon' => 'pulse'],
                                ['title' => 'Product catalog', 'copy' => 'Publish menus with categories, pricing, and an image library your team can manage.', 'icon' => 'catalog'],
                                ['title' => 'Secure tenancy', 'copy' => 'Owner and staff roles stay scoped to their restaurant with RLS-backed isolation.', 'icon' => 'shield'],
                            ] as $feature)
                                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/60">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                        @if ($feature['icon'] === 'qr')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z"></path><path d="M14 14h2m4 0h-2m-4 4h6"></path></svg>
                                        @elseif ($feature['icon'] === 'session')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 6v6l4 2"></path><circle cx="12" cy="12" r="8"></circle></svg>
                                        @elseif ($feature['icon'] === 'bell')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M15 17H5l1.4-1.4A2 2 0 0 0 7 14.2V11a5 5 0 1 1 10 0v3.2a2 2 0 0 0 .6 1.4L19 17h-4"></path><path d="M10 19a2 2 0 0 0 4 0"></path></svg>
                                        @elseif ($feature['icon'] === 'pulse')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 12h4l2-5 4 10 2-5h6"></path></svg>
                                        @elseif ($feature['icon'] === 'catalog')
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 6.5A2.5 2.5 0 0 1 7.5 4H19v16H7.5A2.5 2.5 0 0 0 5 22z"></path><path d="M5 6.5V20"></path></svg>
                                        @else
                                            <svg viewBox="0 0 24 24" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3l7 4v5c0 5-3 8-7 9-4-1-7-4-7-9V7z"></path><path d="M9.5 12l1.8 1.8 3.7-3.8"></path></svg>
                                        @endif
                                    </span>
                                    <h3 class="mt-5 text-xl font-semibold text-slate-950">{{ $feature['title'] }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $feature['copy'] }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                <section id="how-it-works" class="bg-white py-20 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-2xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">How it works</p>
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">From printed QR to live request in three simple steps</h2>
                        </div>

                        <div class="mt-12 grid gap-6 lg:grid-cols-3">
                            @foreach ([
                                ['step' => '01', 'title' => 'Print QR codes for each table', 'copy' => 'Set up a unique QR code per table so every guest starts in the right session.'],
                                ['step' => '02', 'title' => 'Customer scans and interacts', 'copy' => 'Guests browse the menu in real time or call the waiter from their phone.'],
                                ['step' => '03', 'title' => 'Staff sees live dashboard requests', 'copy' => 'Your team receives incoming calls instantly inside the authenticated dashboard.'],
                            ] as $item)
                                <div class="relative rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-sm font-semibold text-white">{{ $item['step'] }}</div>
                                    <h3 class="mt-6 text-xl font-semibold text-slate-950">{{ $item['title'] }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['copy'] }}</p>
                                    @if (! $loop->last)
                                        <div class="mt-6 hidden h-px bg-gradient-to-r from-indigo-200 via-slate-200 to-transparent lg:block"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

               
                <section id="pricing" class="py-24 bg-gray-900 text-white sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <h2 class="text-base font-semibold leading-7 text-indigo-400">Pricing</h2>
            <p class="mt-2 text-4xl font-bold tracking-tight text-white sm:text-5xl">Simple, transparent pricing</p>
            <p class="mt-6 text-lg leading-8 text-gray-300">Choose the plan that fits your restaurant or cafe workflow. Start for free, upgrade when you are ready.</p>
        </div>

        <div class="isolate mx-auto mt-16 grid max-w-md grid-cols-1 gap-y-8 sm:mt-20 lg:mx-auto lg:max-w-none lg:grid-cols-3 lg:gap-x-8 xl:gap-x-12">
            
            <div class="rounded-3xl p-8 ring-1 ring-gray-700 xl:p-10 bg-gray-800 flex flex-col justify-between">
                <div>
                    <h3 id="tier-trial" class="text-lg font-semibold leading-8 text-white">7-Day Trial</h3>
                    <p class="mt-4 text-sm leading-6 text-gray-300">Test drive the complete Smart Table experience.</p>
                    <p class="mt-6 flex items-baseline gap-x-1">
                        <span class="text-4xl font-bold tracking-tight text-white">$0</span>
                        <span class="text-sm font-semibold leading-6 text-gray-300">/ 1 week</span>
                    </p>
                    <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300">
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Full platform access</li>
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Unlimited QR menus</li>
                    </ul>
                </div>
                <a href="/register?plan=trial" aria-describedby="tier-trial" class="mt-8 block rounded-md bg-white/10 px-3 py-2 text-center text-sm font-semibold leading-6 text-white hover:bg-white/20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Start Free Trial</a>
            </div>

            <div class="rounded-3xl p-8 ring-1 ring-gray-700 xl:p-10 bg-gray-800 flex flex-col justify-between">
                <div>
                    <h3 id="tier-monthly" class="text-lg font-semibold leading-8 text-white">Monthly</h3>
                    <p class="mt-4 text-sm leading-6 text-gray-300">Perfect for growing cafes needing flexibility.</p>
                    <p class="mt-6 flex items-baseline gap-x-1">
                        <span class="text-4xl font-bold tracking-tight text-white">$28</span>
                        <span class="text-sm font-semibold leading-6 text-gray-300">/ month</span>
                    </p>
                    <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300">
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Waiter accounts</li>
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Tenant-scoped dashboards</li>
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Standard support</li>
                    </ul>
                </div>
                <a href="/register?plan=monthly" aria-describedby="tier-monthly" class="mt-8 block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold leading-6 text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Subscribe Monthly</a>
            </div>

            <div class="rounded-3xl p-8 ring-2 ring-indigo-500 xl:p-10 bg-gray-900 flex flex-col justify-between relative">
                <div class="absolute -top-4 right-8 rounded-full bg-indigo-500 px-3 py-1 text-xs font-semibold leading-5 text-white">Best Value</div>
                <div>
                    <h3 id="tier-annual" class="text-lg font-semibold leading-8 text-white">Annual</h3>
                    <p class="mt-4 text-sm leading-6 text-gray-300">Maximize your ROI with a discounted yearly rate.</p>
                    <p class="mt-6 flex items-baseline gap-x-1">
                        <span class="text-4xl font-bold tracking-tight text-white">$200</span>
                        <span class="text-sm font-semibold leading-6 text-gray-300">/ year</span>
                    </p>
                    <p class="mt-1 text-sm font-medium text-indigo-400">That's just ~$16 per month</p>
                    <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300">
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> All Monthly features</li>
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Priority support</li>
                        <li class="flex gap-x-3"><svg class="h-6 w-5 flex-none text-indigo-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg> Save $100 annually</li>
                    </ul>
                </div>
                <a href="/register?plan=annual" aria-describedby="tier-annual" class="mt-8 block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold leading-6 text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Subscribe Annually</a>
            </div>
        </div>

        <div class="mt-16 flex justify-center items-center space-x-6 text-gray-400">
            <span class="text-sm font-medium">Secure payments via:</span>
            <svg class="h-6 w-auto" fill="currentColor" viewBox="0 0 60 25"><path d="M59.64 14.28h-8.06c.19 1.93 1.6 3.17 3.51 3.17 1.64 0 2.65-.6 3.25-1.73l3.92 1.68c-1.63 2.8-4.54 3.96-7.3 3.96-4.9 0-7.7-3.32-7.7-8.24 0-5.12 3.1-8.39 7.48-8.39 4.8 0 7.23 3.48 7.23 8.16 0 .5-.05 1.01-.1 1.39zm-4.33-2.88c-.1-1.68-1.25-2.9-2.93-2.9-1.68 0-2.8 1.15-3.03 2.9h5.96zM42.27 4.97V.08h-4.32v21.05h4.32v-3.07c1.1 1.68 2.83 2.98 5.1 2.98 3.92 0 6.94-3.1 6.94-7.9 0-4.75-3.02-7.8-6.94-7.8-2.26 0-4 1.3-5.1 2.98V4.97zm.43 8.16c0-2.73 1.73-4.46 3.94-4.46 2.2 0 3.94 1.73 3.94 4.46s-1.73 4.56-3.94 4.56c-2.2 0-3.94-1.83-3.94-4.56zm-15.65-7.8c-1.54 0-2.83.67-3.56 1.73V5.35h-4.32V21h4.32v-9.65c0-2.16 1.34-3.55 3.12-3.55 1.73 0 2.83 1.05 2.83 3.02V21h4.32v-9.6c0-3.94-2.1-5.66-4.9-5.66H27.05zm-14.7 0c-4.76 0-7.55 3.3-7.55 8.25s2.74 8.26 7.55 8.26c2.4 0 4.2-1.02 5.3-2.65V21h4.32V5.4h-4.32v1.54c-1.1-1.63-2.9-2.6-5.3-2.6zm3.95 8.25c0 2.8-1.78 4.6-4 4.6-2.2 0-4-1.8-4-4.6s1.8-4.6 4-4.6c2.2 0 4 1.8 4 4.6zM2.87 21h4.32V5.35H2.87V21zM2.83.1h4.4v4.4h-4.4z"/></svg>
            <span class="text-gray-500">|</span>
            <span class="inline-flex items-center gap-x-1.5 rounded-md bg-gray-800 px-2 py-1 text-sm font-medium text-gray-300 ring-1 ring-inset ring-gray-700">
                <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0a12 12 0 100 24 12 12 0 000-24zm0 18.5a6.5 6.5 0 110-13 6.5 6.5 0 010 13zm3-7h-2.5v2.5h-1V11.5H9v-1h2.5v-2.5h1v2.5H15v1z"/></svg>
                USDT (OKX)
            </span>
        </div>
    </div>
</section>

                <section id="faq" class="bg-white py-20 sm:py-24">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">FAQ</p>
                                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Questions restaurant teams usually ask first</h2>
                                <p class="mt-4 text-lg text-slate-600">Everything below is tailored to the current Smart Table product and infrastructure.</p>
                            </div>

                            <div class="space-y-4">
                                @foreach ([
                                    ['q' => 'Do customers need an app?', 'a' => 'No. Guests simply scan the QR code and use Smart Table directly in their mobile browser.'],
                                    ['q' => 'Does it work offline?', 'a' => 'Customers need connectivity to load the session and send requests. When the connection is weak, the staff side still benefits from polling fallback for resilience.'],
                                    ['q' => 'How is data isolated between restaurants?', 'a' => 'Each restaurant is treated as its own tenant, with staff roles scoped to that tenant and data protected through RLS-backed isolation.'],
                                    ['q' => 'Can I customize the menu?', 'a' => 'Yes. Owners can manage the product catalog, categories, pricing, and image library from the dashboard.'],
                                    ['q' => 'What languages are supported?', 'a' => 'The current landing page and default copy are in English. The product can be extended with localized content as your rollout grows.'],
                                ] as $faq)
                                    <div x-data="{ open: false }" class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                        <button
                                            type="button"
                                            class="flex w-full items-center justify-between gap-4 text-left"
                                            @click="open = !open"
                                            :aria-expanded="open.toString()"
                                        >
                                            <span class="text-base font-semibold text-slate-950">{{ $faq['q'] }}</span>
                                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-slate-500">
                                                <svg class="h-5 w-5 transition duration-200" :class="open ? 'rotate-45' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                                    <path d="M12 5v14M5 12h14"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <div x-show="open" x-transition.opacity.duration.200ms class="pt-4 text-sm leading-6 text-slate-600">
                                            {{ $faq['a'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-20">
                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="rounded-[2rem] bg-slate-950 px-8 py-12 text-white shadow-2xl shadow-slate-300/20 sm:px-10 lg:flex lg:items-center lg:justify-between">
                            <div class="max-w-2xl">
                                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-300">Start now</p>
                                <h2 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">Give every table a faster way to reach your staff</h2>
                                <p class="mt-4 text-base leading-7 text-slate-300">Launch Smart Table for your café or restaurant and keep service moving with live customer requests and menu access.</p>
                            </div>
                            <div class="mt-8 lg:mt-0">
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:bg-indigo-400">
                                    Get started
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-slate-200 bg-white">
                <div class="container mx-auto flex flex-col gap-8 px-4 py-10 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-900 text-white">
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <rect x="4.5" y="5.5" width="15" height="4" rx="1.5"></rect>
                                    <path d="M7.5 9.5v9m9-9v9M5.5 18.5h13"></path>
                                </svg>
                            </span>
                            <div>
                                <p class="text-base font-semibold text-slate-950">Smart Table</p>
                                <p class="text-sm text-slate-500">Live table service for modern restaurants.</p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-slate-500">© 2026 Smart Table</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-sm font-medium text-slate-600">
                        <a href="{{ route('login') }}" class="transition hover:text-slate-950">Login</a>
                        <a href="{{ route('register') }}" class="transition hover:text-slate-950">Register</a>
                        <a href="#" class="transition hover:text-slate-950">Privacy</a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
````

## File: app/Http/Controllers/Auth/AuthenticatedSessionController.php
````php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     *
     * Order matters here:
     * 1. Log the user out of the guard first (clears auth state).
     * 2. Invalidate the session (destroys session data, issues new session ID).
     * 3. Regenerate the CSRF token (so the new session has a valid token).
     * 4. Redirect to the welcome page.
     *
     * Doing step 2 before step 1 caused a race condition where the redirect
     * would hit routes that check auth before the guard had fully cleared,
     * producing the loop. Regenerating the token after invalidation ensures
     * the next request (the GET to welcome) carries a fresh, valid token.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
````

## File: app/Models/Product.php
````php
<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use App\Support\LibraryImage;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use BelongsToTenant, HasFactory, SoftDeletes;

    public const IMAGE_SOURCE_NONE = 'none';
    public const IMAGE_SOURCE_UPLOAD = 'upload';
    public const IMAGE_SOURCE_LIBRARY = 'library';

    protected $fillable = [
        'tenant_id',
        'category_id',
        'name',
        'description',
        'price_cents',
        'image_source',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::addGlobalScope('product_order', function (Builder $builder): void {
            $builder->orderBy('sort_order')->orderBy('name');
        });
    }

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function priceFormatted(): string
    {
        return number_format($this->price_cents / 100, 2, '.', '');
    }

    public function imageUrl(): string
    {
        return match ($this->image_source) {
            self::IMAGE_SOURCE_UPLOAD => $this->image_path
            ? Storage::disk(config('filesystems.product_disk'))->url($this->image_path)
            : asset('img/library/_placeholder.png'),

                // Library keys are now Unsplash photo IDs; LibraryImage::url()
                // also handles legacy local paths transparently.
            self::IMAGE_SOURCE_LIBRARY => LibraryImage::url($this->image_path),

            default => asset('img/library/_placeholder.png'),
        };
    }
}
````

## File: resources/views/livewire/owner/products/index.blade.php
````php
<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/50">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600">Owner catalog</p>
                <h1 class="mt-2 text-2xl font-bold text-slate-900">Products</h1>
                <p class="mt-1 max-w-2xl text-sm text-slate-500">Manage your browse-only menu catalog with active states, sort order, uploads, and built-in image picks.</p>
            </div>

            <button wire:click="createProduct" type="button"
                class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                Create product
            </button>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="e.g. Cappuccino"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">Filter</span>
                <select wire:model.live="activity"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
                    <option value="">All products</option>
                    <option value="active">Active only</option>
                    <option value="inactive">Inactive only</option>
                </select>
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(360px,1fr)] items-start">
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Sort</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($products as $product)
                            <tr class="align-top hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex gap-4">
                                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}"
                                            class="h-14 w-14 rounded-xl border border-slate-100 object-cover shadow-sm">
                                        <div>
                                            <p class="font-bold text-slate-900">{{ $product->name }}</p>
                                            <p class="mt-1 line-clamp-2 text-xs text-slate-500">
                                                {{ $product->description ?: 'No description yet.' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($product->category)
                                        <span class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-600 ring-1 ring-inset ring-slate-500/10">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">${{ $product->priceFormatted() }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $product->sort_order }}</td>
                                <td class="px-6 py-4">
                                    <button wire:click="toggleActive({{ $product->id }})" type="button"
                                        class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold transition {{ $product->is_active ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20 hover:bg-emerald-100' : 'bg-slate-100 text-slate-600 ring-1 ring-inset ring-slate-500/10 hover:bg-slate-200' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <button wire:click="editProduct({{ $product->id }})" type="button"
                                            class="rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">Edit</button>
                                        <button wire:click="deleteProduct({{ $product->id }})" type="button"
                                            class="rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-rose-600 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-rose-50 hover:ring-rose-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-sm font-medium text-slate-900">No products found</p>
                                    <p class="mt-1 text-sm text-slate-500">Try adjusting your search or filter criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

        <div class="sticky top-24 space-y-6">
            @if ($showForm)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between border-b border-slate-100 pb-4">
                        <h2 class="text-lg font-bold text-slate-900">
                            {{ $editingProductId ? 'Edit product' : 'Create product' }}</h2>
                        <button wire:click="closeForm" type="button"
                            class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/></svg>
                        </button>
                    </div>

                    <livewire:owner.products.form :product-id="$editingProductId" :key="'product-form-' . $editingProductId"
                        @product-saved="handleSaved($event.detail.productId)" />
                </div>
            @endif
        </div>
    </section>
</div>
````

## File: resources/views/waiter/dashboard.blade.php
````php
@extends('layouts.waiter')

@section('content')
    <section class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">Smart Table</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Waiter Dashboard</h1>
        <p class="mt-3 max-w-2xl text-sm text-slate-600">Waiter access is isolated by tenant and limited to waiter-only
            routes.</p>

        <div class="mt-6">
            <button type="button" x-data @click="$dispatch('open-modal', 'scan-to-assign')"
                class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-sky-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 14h2m4 0h-2m-4 4h6" />
                </svg>
                <span>Scan to Assign</span>
            </button>
        </div>
    </section>
    @yield('requests')

    <x-modal name="scan-to-assign" :show="false" maxWidth="md" focusable>
        <div class="p-6" x-data="scanToAssign()" x-init="init()"
            x-on:open-modal.window="$event.detail === 'scan-to-assign' && start()"
            x-on:close-modal.window="$event.detail === 'scan-to-assign' && stop()">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Scan Table QR Code</h2>
                <button type="button" @click="$dispatch('close')" class="text-slate-400 hover:text-slate-600">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <p class="mt-2 text-sm text-slate-500">Point your camera at the table's QR code.</p>

            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-slate-950 aspect-square relative">
                <video x-ref="video" class="h-full w-full object-cover" playsinline muted></video>
                <canvas x-ref="canvas" class="hidden"></canvas>

                <div x-show="!cameraReady && !error"
                    class="absolute inset-0 flex items-center justify-center text-sm text-slate-300">
                    Starting camera…
                </div>
            </div>

            <div x-show="error"
                class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700"
                x-text="error"></div>

            <div x-show="loading"
                class="mt-4 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-600">
                Processing…
            </div>

            <div x-show="result" class="mt-4 rounded-xl border px-4 py-3 text-sm font-medium" :class="result?.status === 'already_assigned'
                                ? 'border-amber-200 bg-amber-50 text-amber-700'
                                : 'border-emerald-200 bg-emerald-50 text-emerald-700'" x-text="result?.message">
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" @click="$dispatch('close')"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Close
                </button>
                <button type="button" x-show="result || error" @click="reset(); start()"
                    class="rounded-xl border border-sky-300 bg-sky-50 px-4 py-2 text-sm font-semibold text-sky-700 hover:bg-sky-100">
                    Scan Again
                </button>
            </div>
        </div>
    </x-modal>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsQR/1.4.0/jsQR.min.js"></script>


    <script>
        function scanToAssign() {
            return {
                stream: null,
                cameraReady: false,
                loading: false,
                error: null,
                result: null,
                _rafId: null,

                init() {
                    // nothing on init — camera starts when modal opens
                },

                async start() {
                    this.reset();

                    if (!navigator.mediaDevices?.getUserMedia) {
                        this.error = 'Camera access is not supported on this device.';
                        return;
                    }

                    try {
                        this.stream = await navigator.mediaDevices.getUserMedia({
                            video: { facingMode: 'environment' },
                        });
                        this.$refs.video.srcObject = this.stream;
                        await this.$refs.video.play();
                        this.cameraReady = true;
                        this._scanLoop();
                    } catch (e) {
                        this.error = 'Unable to access the camera. Please grant camera permission.';
                    }
                },

                stop() {
                    if (this._rafId) {
                        cancelAnimationFrame(this._rafId);
                        this._rafId = null;
                    }
                    if (this.stream) {
                        this.stream.getTracks().forEach(track => track.stop());
                        this.stream = null;
                    }
                    this.cameraReady = false;
                },

                reset() {
                    this.error = null;
                    this.result = null;
                    this.loading = false;
                },

                _scanLoop() {
                    if (!this.cameraReady || this.result) {
                        return;
                    }

                    const video = this.$refs.video;
                    const canvas = this.$refs.canvas;

                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;

                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                        const code = window.jsQR
                            ? window.jsQR(imageData.data, imageData.width, imageData.height)
                            : null;

                        if (code && code.data) {
                            this._handleCode(code.data);
                            return;
                        }
                    }

                    this._rafId = requestAnimationFrame(() => this._scanLoop());
                },

                async _handleCode(rawValue) {
                    this.stop();
                    this.loading = true;

                    try {
                        const res = await fetch('{{ route('waiter.tables.assign-via-qr') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            },
                            body: JSON.stringify({ qr_token: rawValue }),
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            this.error = data.message ?? 'Something went wrong. Please try again.';
                            return;
                        }

                        this.result = data;
                    } catch (e) {
                        this.error = 'Network error. Please try again.';
                    } finally {
                        this.loading = false;
                    }
                },
            };
        }
    </script>
@endpush
````

## File: app/Services/TableSessionService.php
````php
<?php

namespace App\Services;

use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Support\Facades\DB;

class TableSessionService
{
    public function resolveOrStart(Table $table, ?string $sessionTokenFromCookie): array
    {
        return DB::transaction(function () use ($table, $sessionTokenFromCookie): array {
            $lockedTable = Table::withoutGlobalScopes()
                ->whereKey($table->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $activeSession = TableSession::withoutGlobalScopes()
                ->where('table_id', $lockedTable->getKey())
                ->where('status', TableSession::STATUS_ACTIVE)
                ->lockForUpdate()
                ->first();

            if ($activeSession !== null) {
                // If it is the same customer (matching cookie), always resume the session,
                // regardless of whether the table is currently free or occupied.
                $matches = $sessionTokenFromCookie !== null
                    && hash_equals($activeSession->session_token, $sessionTokenFromCookie);

                if ($matches) {
                    return [
                        'session' => $activeSession,
                        'isNew'   => false,
                        'blocked' => false,
                    ];
                }

                // If the cookie does not match:
                if ($lockedTable->status === Table::STATUS_FREE) {
                    // Since the table is free, the active session is orphaned/stale
                    // (e.g. previous customer scanned but never called a waiter and left).
                    // Close it silently so we can start a new one.
                    $activeSession->forceFill([
                        'status'   => TableSession::STATUS_CLOSED,
                        'ended_at' => now(),
                    ])->save();
                } else {
                    // Table is genuinely occupied by another device. Block the new device.
                    return [
                        'session' => $activeSession,
                        'isNew'   => false,
                        'blocked' => true,
                    ];
                }
            }

            $session = TableSession::withoutGlobalScopes()->create([
                'tenant_id' => $lockedTable->tenant_id,
                'table_id' => $lockedTable->getKey(),
                'status' => TableSession::STATUS_ACTIVE,
                'started_at' => now(),
            ]);

            return [
                'session' => $session,
                'isNew' => true,
                'blocked' => false,
            ];
        });
    }

    public function close(TableSession $session): TableSession
    {
        return DB::transaction(function () use ($session): TableSession {
            $lockedSession = TableSession::withoutGlobalScopes()
                ->whereKey($session->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $lockedTable = Table::withoutGlobalScopes()
                ->whereKey($lockedSession->table_id)
                ->lockForUpdate()
                ->first();

            if ($lockedSession->isActive()) {
                $lockedSession->forceFill([
                    'status' => TableSession::STATUS_CLOSED,
                    'ended_at' => now(),
                ])->save();

                // Cancel all unresolved requests for the closed session.
                ServiceRequest::withoutGlobalScopes()
                    ->where('table_session_id', $lockedSession->getKey())
                    ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                    ->update(['status' => ServiceRequest::STATUS_CANCELLED]);
            }

            if ($lockedTable !== null) {
                $lockedTable->forceFill([
                    'status' => Table::STATUS_FREE,
                ])->save();
            }

            return $lockedSession->fresh();
        });
    }
}
````

## File: config/image_library.php
````php
<?php
return [
    // ── Breakfast & Pastries ─────────────────────────────────────────────────
    ['key' => '1533089189872-0f8e2b990f42', 'label' => 'Breakfast Plate'],
    ['key' => '1610635967007-34ebbd66f64d', 'label' => 'Ftour avec omlette'],
    ['key' => '1555507036-ab1f4038808a', 'label' => 'Croissant'],

    // New Breakfast Items
    ['key' => '1504674900247-0877df9cc836', 'label' => 'Moroccan Breakfast'],
    ['key' => '1482049016688-2d3e1b311543', 'label' => 'Pancakes'],
    ['key' => '1525351484163-7529414344d8', 'label' => 'Waffles'],
    ['key' => '1525351326368-efbb5cb6814d', 'label' => 'French Toast'],
    ['key' => '1528735602780-2552fd46c7af', 'label' => 'Omelette'],
    ['key' => '1513442542250-854d436a73f2', 'label' => 'Eggs & Toast'],

    // ── Mains ────────────────────────────────────────────────────────────────
    ['key' => '1568901346375-23c9450c58cd', 'label' => 'Burger'],
    ['key' => '1512621776951-a57141f2eefd', 'label' => 'Fresh Salad'],
    ['key' => '1565299624946-b28f40a0ae38', 'label' => 'Pizza'],
    ['key' => '1528137871618-79d2761e3fd5', 'label' => 'Sandwich'],

    // New Mains
    ['key' => '1520072959219-c595dc870360', 'label' => 'Club Sandwich'],
    ['key' => '1506354666786-959d6d497f1a', 'label' => 'Chicken Burger'],
    ['key' => '1550547660-d9450f859349', 'label' => 'Pasta'],
    ['key' => '1515003197210-e0cd71810b5f', 'label' => 'Caesar Salad'],
    ['key' => '1482049016688-2d3e1b311543', 'label' => 'Chicken Wrap'],

    // ── Desserts ─────────────────────────────────────────────────────────────
    ['key' => '1551024709-8f23befc3ead', 'label' => 'Dessert'],
    ['key' => '1563805042-7684c019e5b2', 'label' => 'Cake Slice'],

    // New Desserts
    ['key' => '1488477181946-6428a0291777', 'label' => 'Chocolate Cake'],
    ['key' => '1464306076886-da185f6a9d05', 'label' => 'Cheesecake'],
    ['key' => '1519864600265-abb23847ef2c', 'label' => 'Brownie'],
    ['key' => '1509440159596-0249088772ff', 'label' => 'Cookies'],
    ['key' => '1519676867240-f03562e64548', 'label' => 'Ice Cream'],

    // ── Hot Drinks ───────────────────────────────────────────────────────────
    ['key' => '1510707577719-ae7c14805e3a', 'label' => 'Espresso'],
    ['key' => '1485808191679-5f86510681a2', 'label' => 'Cappuccino'],
    ['key' => '1544787219-7f47ccb76574', 'label' => 'Tea'],

    // New Hot Drinks
    ['key' => '1495474472287-4d71bcdd2085', 'label' => 'Latte'],
    ['key' => '1517701604599-bb29b565090c', 'label' => 'Mocha'],
    ['key' => '1494314671902-399b18174975', 'label' => 'Americano'],
    ['key' => '1511920170033-f8396924c348', 'label' => 'Hot Chocolate'],
    ['key' => '1521017432531-fbd92d768814', 'label' => 'Mint Tea'],

    // ── Cold Drinks ──────────────────────────────────────────────────────────
    ['key' => '1461023058943-07fcbe16d735', 'label' => 'Iced Coffee'],
    ['key' => '1437418747212-8d9709afab22', 'label' => 'Lemonade'],
    ['key' => '1553361371-9b22f78e8b1d', 'label' => 'Smoothie'],
    ['key' => '1556679908-b2e53e38cef7', 'label' => 'Ice Tea'],

    // New Cold Drinks
    ['key' => '1622597467836-f3285f2131b8', 'label' => 'Orange Juice'],
    ['key' => '1502741338009-cac2772e18bc', 'label' => 'Strawberry Smoothie'],
    ['key' => '1497534446932-c925b458314e', 'label' => 'Mango Juice'],
    ['key' => '1513558161293-cdaf765ed2fd', 'label' => 'Milkshake'],
    ['key' => '1509042239860-f550ce710b93', 'label' => 'Fruit Cocktail'],
];
````

## File: resources/views/layouts/waiter.blade.php
````php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.realtime-config')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased">
    <div class="min-h-screen">
        <header class="border-b border-slate-200 bg-white/95">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-8">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-sky-600">Waiter</p>
                        <p class="mt-1 text-lg font-semibold">{{ auth()->user()->tenant?->name }}</p>
                    </div>

                    <nav class="flex items-center gap-3 text-sm">
                        <a href="{{ route('waiter.dashboard') }}"
                            class="rounded-lg px-3 py-2 font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Dashboard</a>
                        <a href="{{ route('waiter.requests.index') }}"
                            class="rounded-lg px-3 py-2 font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Requests</a>
                        <a href="{{ route('waiter.tables.index') }}"
                            class="rounded-lg px-3 py-2 font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Tables</a>

                    </nav>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-sky-500 hover:text-sky-700">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 py-10">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>
    </div>
    @stack('scripts') {{-- add this line --}}

    @livewireScripts
</body>

</html>
````

## File: app/Livewire/Owner/Products/Form.php
````php
<?php

namespace App\Livewire\Owner\Products;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductImageService;
use App\Support\LibraryImage;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?int $productId = null;

    public string $name = '';

    public string $description = '';

    public string $price = '';

    public bool $isActive = true;

    public int $sortOrder = 0;

    public string $imageSource = Product::IMAGE_SOURCE_NONE;

    public ?TemporaryUploadedFile $upload = null;

    public ?string $selectedLibraryImage = null;

    public ?int $categoryId = null;

    public function mount(?int $productId = null): void
    {
        $this->productId = $productId;

        if ($productId === null) {
            $this->authorize('create', Product::class);
            return;
        }

        $product = Product::query()->find($productId);
        abort_if($product === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $product);

        $this->name = $product->name;
        $this->description = (string) $product->description;
        $this->price = $product->priceFormatted();
        $this->isActive = $product->is_active;
        $this->sortOrder = $product->sort_order;
        $this->imageSource = $product->image_source;
        $this->categoryId = $product->category_id;

        $this->selectedLibraryImage = $product->image_source === Product::IMAGE_SOURCE_LIBRARY
            ? $product->image_path
            : null;
    }

    // ── Computed (memoised per request, never re-queried on the same tick) ────

    #[Computed]
    public function categories(): \Illuminate\Support\Collection
    {
        return Category::all();
    }

    #[Computed]
    public function libraryImages(): array
    {
        return array_map(
            fn(array $entry) => array_merge($entry, ['url' => LibraryImage::url($entry['key'])]),
            LibraryImage::all(),
        );
    }

    #[Computed]
    public function previewUrl(): string
    {
        if ($this->imageSource === Product::IMAGE_SOURCE_UPLOAD && $this->upload !== null) {
            if (str_starts_with((string) $this->upload->getMimeType(), 'image/')) {
                return $this->upload->temporaryUrl();
            }
            return asset('img/library/_placeholder.png');
        }

        if ($this->imageSource === Product::IMAGE_SOURCE_LIBRARY && $this->selectedLibraryImage !== null) {
            return LibraryImage::url($this->selectedLibraryImage);
        }

        if ($this->productId !== null) {
            $product = Product::query()->find($this->productId);
            if ($product !== null) {
                return $product->imageUrl();
            }
        }

        return asset('img/library/_placeholder.png');
    }

    // ── Lifecycle hooks ───────────────────────────────────────────────────────

    public function updatedImageSource(string $value): void
    {
        if ($value !== Product::IMAGE_SOURCE_UPLOAD) {
            $this->upload = null;
        }

        if ($value !== Product::IMAGE_SOURCE_LIBRARY) {
            $this->selectedLibraryImage = null;
        }

        // Bust the computed cache so previewUrl re-evaluates
        unset($this->previewUrl);
    }

    public function updatedUpload(): void
    {
        unset($this->previewUrl);
    }

    public function updatedSelectedLibraryImage(): void
    {
        unset($this->previewUrl);
    }

    // ── Actions ───────────────────────────────────────────────────────────────

    public function save(ProductImageService $productImageService): void
    {
        if ($this->productId === null) {
            $this->authorize('create', Product::class);
        }

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')
                    ->where(fn($query) => $query
                        ->where('tenant_id', auth()->user()->tenant_id)
                        ->whereNull('deleted_at'))
                    ->ignore($this->productId),
            ],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'isActive' => ['required', 'boolean'],
            'sortOrder' => ['required', 'integer', 'min:0', 'max:9999'],
            'categoryId' => ['nullable', 'integer', 'exists:categories,id'],
            'imageSource' => [
                'required',
                Rule::in([
                    Product::IMAGE_SOURCE_NONE,
                    Product::IMAGE_SOURCE_UPLOAD,
                    Product::IMAGE_SOURCE_LIBRARY,
                ]),
            ],
            'selectedLibraryImage' => ['nullable', 'string'],
        ], [
            'price.regex' => 'Price must be a valid amount like 12.50.',
            'categoryId.exists' => 'Please select a valid category.',
        ]);

        $product = $this->productId === null
            ? new Product(['tenant_id' => auth()->user()->tenant_id])
            : Product::query()->find($this->productId);

        abort_if($product === null, Response::HTTP_NOT_FOUND);

        $product->setRelation('tenant', auth()->user()->tenant);

        if ($this->productId !== null) {
            $this->authorize('update', $product);
        }

        $product->forceFill([
            'name' => $validated['name'],
            'description' => $validated['description'] ?: null,
            'price_cents' => (int) round(((float) $validated['price']) * 100),
            'is_active' => $validated['isActive'],
            'sort_order' => $validated['sortOrder'],
            'category_id' => $validated['categoryId'] ?: null,
        ]);

        $productImageService->applyToProduct(
            $product,
            $validated['imageSource'],
            $validated['selectedLibraryImage'],
            $this->upload
        );

        try {
            $product->save();
        } catch (UniqueConstraintViolationException) {
            $this->addError('name', 'A product with this name already exists for your restaurant.');
            return;
        }

        $this->dispatch('product-saved', productId: $product->id);
    }

    public function render()
    {
        return view('livewire.owner.products.form');
    }
}
````

## File: resources/views/layouts/owner.blade.php
````php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.realtime-config')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="min-h-screen bg-gradient-to-tr from-slate-50 via-indigo-50/20 to-emerald-50/30 font-sans text-slate-800 antialiased">
    <div class="min-h-screen relative overflow-hidden">

        <header class="border-b border-slate-200/80 bg-white/70 backdrop-blur-md sticky top-0 z-50">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                <div class="flex items-center gap-8">

                    <div>
                        <p
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md border border-indigo-100">
                            Owner Dashboard
                        </p>
                        <p class="mt-1 text-lg font-black text-slate-900">
                            {{ app(\App\Support\CurrentTenant::class)->tenant()?->name }}
                        </p>
                    </div>

                    @php
                        $navLinks = [
                            ['label' => 'Dashboard', 'route' => 'owner.dashboard', 'match' => 'owner.dashboard'],
                            ['label' => 'Tables', 'route' => 'owner.tables.index', 'match' => 'owner.tables.*'],
                            ['label' => 'Products', 'route' => 'owner.products.index', 'match' => 'owner.products.*'],
                            ['label' => 'Categories', 'route' => 'owner.categories.index', 'match' => 'owner.categories.*'],
                            ['label' => 'Staff', 'route' => 'owner.staff.index', 'match' => 'owner.staff.*'],
                            ['label' => 'Requests', 'route' => 'owner.requests.index', 'match' => 'owner.requests.*'],
                        ];
                    @endphp

                    <nav class="hidden md:flex items-center gap-1 font-semibold text-sm">
                        @foreach ($navLinks as $link)
                                            <a href="{{ route($link['route']) }}" class="rounded-xl px-3 py-2 transition
                                                          {{ request()->routeIs($link['match'])
                            ? 'text-indigo-600 bg-indigo-50/60 border border-indigo-100/40'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                                {{ $link['label'] }}
                                            </a>
                        @endforeach
                    </nav>

                </div>

                <div class="flex items-center gap-3">
                    {{-- Mobile nav --}}
                    <div x-data="{ open: false }" class="relative md:hidden">
                        <button @click="open = !open" type="button"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm">
                            Menu
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition
                            class="absolute right-0 mt-2 w-44 rounded-2xl border border-slate-200 bg-white py-2 shadow-xl">
                            @foreach ($navLinks as $link)
                                                    <a href="{{ route($link['route']) }}" class="block px-4 py-2 text-sm font-semibold transition
                                                                  {{ request()->routeIs($link['match'])
                                ? 'text-indigo-600 bg-indigo-50'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                                        {{ $link['label'] }}
                                                    </a>
                            @endforeach
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600 shadow-sm shadow-slate-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 py-10 relative z-10">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </main>

    </div>

    @livewireScripts
</body>

</html>
````

## File: resources/views/livewire/owner/requests/index.blade.php
````php
<div x-data="{
        handle: null,
        init() {
            if (window.AppRealtime && typeof window.AppRealtime.onRequestChange === 'function') {
                this.handle = window.AppRealtime.onRequestChange(
                    { tenantId: {{ auth()->user()->tenant_id }} },
                    () => window.dispatchEvent(new CustomEvent('owner-requests-refresh')),
                );
            }
        },
        destroy() {
            if (this.handle && window.AppRealtime && typeof window.AppRealtime.unsubscribe === 'function') {
                window.AppRealtime.unsubscribe(this.handle);
            }
        },
    }" x-on:owner-requests-refresh.window="$wire.dispatch('refresh')" @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else wire:poll.3s @endif class="space-y-6">
    <section
        class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-8 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-amber-200/20 blur-3xl"></div>
        <div class="relative">
            <div class="flex items-center gap-3">
                <span class="relative flex h-3.5 w-3.5">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-amber-500"></span>
                </span>
                <span
                    class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700 bg-amber-50 px-2.5 py-1.5 rounded-xl border border-amber-100 shadow-sm inline-block">
                    Owner Requests
                </span>
            </div>
            <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Active Service Requests</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">
                Requests update live with Supabase Realtime when configured. Livewire polling is kept as a fallback to
                ensure you never miss a request.
            </p>
        </div>
    </section>

    <section
        class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead>
                    <tr
                        class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                        <th scope="col" class="px-6 py-5">Table & Session</th>
                        <th scope="col" class="px-6 py-5">Status</th>
                        <th scope="col" class="px-6 py-5">Wait Time</th>
                        <th scope="col" class="px-6 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($requests as $request)
                        <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                            <td class="px-6 py-5 align-middle">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 border border-slate-200 text-slate-600 group-hover/row:bg-indigo-50 group-hover/row:border-indigo-100 group-hover/row:text-indigo-600 transition-colors">
                                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $request->tableSession->table->name }}</p>
                                        <p class="mt-0.5 flex items-center gap-1 text-[10px] text-slate-400 font-mono"
                                            title="Session {{ $request->tableSession->id }}">
                                            <svg class="h-3 w-3 text-slate-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                            </svg>
                                            {{ str($request->tableSession->session_token)->limit(12) }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 align-middle">
                                <div class="flex items-center">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm"
                                            title="Accepted by {{ $request->acceptedBy?->name ?? 'Staff' }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Accepted
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-5 align-middle" x-data="{ 
                                        elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($request->created_at, true) }}')) || 0,
                                        timer: null,
                                        init() { 
                                            this.timer = setInterval(() => this.elapsed++, 1000); 
                                        },
                                        destroy() { 
                                            clearInterval(this.timer); 
                                        },
                                        formatTime(rawSeconds) {
                                            const total = Math.floor(rawSeconds);
                                            if (total < 60) return `${total}s`;
                                            const m = Math.floor(total / 60);
                                            const s = total % 60;
                                            return `${m}m ${s.toString().padStart(2, '0')}s`;
                                        }
                                    }">
                                <div
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-50 px-2.5 py-1 border border-slate-100 font-mono text-xs font-semibold text-slate-600">
                                    <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span x-text="formatTime(elapsed)"></span>
                                </div>
                            </td>

                            <td class="px-6 py-5 align-middle text-right">
                                <div class="flex justify-end gap-2">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <button wire:click="acceptRequest({{ $request->id }})" type="button"
                                            class="inline-flex items-center gap-1.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                            <span>Accept</span>
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    @elseif ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                        <button wire:click="resolveRequest({{ $request->id }})" type="button"
                                            class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/10 hover:shadow-emerald-600/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span>Resolve</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800">No Active Requests</h3>
                                    <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">You're all caught up!
                                        New requests will appear here instantly.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
````

## File: resources/views/owner/dashboard.blade.php
````php
@extends('layouts.owner')

@section('content')
    <div class="relative space-y-10">

        {{-- ── Decorative ambient blobs ──────────────────────────────────────────── --}}
        <div
            class="pointer-events-none absolute -right-16 -top-16 h-[28rem] w-[28rem] rounded-full bg-indigo-200/25 blur-[100px]">
        </div>
        <div
            class="pointer-events-none absolute -bottom-16 -left-16 h-[22rem] w-[22rem] rounded-full bg-emerald-200/25 blur-[90px]">
        </div>
        <div
            class="pointer-events-none absolute left-1/3 top-1/2 h-[18rem] w-[18rem] rounded-full bg-amber-200/20 blur-[90px]">
        </div>


        {{-- ── Stat Cards ──────────────────────────────────────────────────────────── --}}
        <section class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Active Alerts --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-amber-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Active Alerts</span>
                    <div
                        class="rounded-xl bg-amber-50 p-3 text-amber-500 border border-amber-100 shadow-inner group-hover:bg-amber-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline gap-2">
                    <span class="text-4xl font-black tracking-tight text-slate-800">{{ $pendingCount }}</span>
                    @if ($pendingCount > 0)
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700">
                            Live
                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-400">
                            All clear
                        </span>
                    @endif
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">Waiting floor requests queue</p>
            </div>

            {{-- Avg Response --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Avg Response</span>
                    <div
                        class="rounded-xl bg-indigo-50 p-3 text-indigo-500 border border-indigo-100 shadow-inner group-hover:bg-indigo-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-black tracking-tight text-slate-800">
                        {{ $avgResponseForHumans ?? '—' }}
                    </span>
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">
                    {{ $avgResponseForHumans ? "Today's average response" : 'No accepted requests today' }}
                </p>
            </div>

            {{-- Active Sessions --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Active Tables</span>
                    <div
                        class="rounded-xl bg-emerald-50 p-3 text-emerald-500 border border-emerald-100 shadow-inner group-hover:bg-emerald-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h1.5M22.5 8.25L18 18.75a2.25 2.25 0 01-2.244 1.25H8.244a2.25 2.25 0 01-2.244-1.25L1.5 8.25m15-4.5H18a2.25 2.25 0 012.25 2.25M6 12l1.5-2.25m15 0l-1.5 2.25m-15 0h12" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-black tracking-tight text-slate-800">
                        {{ $activeSessionsCount }}
                        {{ $activeSessionsCount === 1 ? 'Session' : 'Sessions' }}
                    </span>
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">Live connections verified</p>
            </div>

            {{-- Completion Rate --}}
            <div
                class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white/60 p-6 backdrop-blur-md shadow-lg shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-violet-100/50">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">Completion Rate</span>
                    <div
                        class="rounded-xl bg-violet-50 p-3 text-violet-500 border border-violet-100 shadow-inner group-hover:bg-violet-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-4xl font-black tracking-tight text-slate-800">{{ $completionRate }}%</span>
                </div>
                <p class="mt-2 text-xs font-semibold text-slate-500">Calculated over past 24 hours</p>
            </div>

        </section>

        {{-- ── Live Table Requests ──────────────────────────────────────────────────── --}}
        <livewire:owner.dashboard-requests />

        {{-- ── Quick Nav Cards ──────────────────────────────────────────────────────── --}}
        <section class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <a href="{{ route('owner.requests.index') }}"
                class="group relative overflow-hidden rounded-2xl border border-white/70 bg-white/50 p-7 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:bg-white hover:shadow-xl hover:shadow-indigo-100/40">
                <div class="flex items-start justify-between">
                    <div class="space-y-3">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                            Manage Requests
                        </h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                            Accept, track, and monitor response intervals for all floor calls in real-time.
                        </p>
                    </div>
                    <div
                        class="text-slate-300 group-hover:text-indigo-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-indigo-50">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('owner.tables.index') }}"
                class="group relative overflow-hidden rounded-2xl border border-white/70 bg-white/50 p-7 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:bg-white hover:shadow-xl hover:shadow-emerald-100/40">
                <div class="flex items-start justify-between">
                    <div class="space-y-3">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">
                            Table Setup
                        </h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                            Generate QR tokens, manage layout names, and block or unblock sessions instantly.
                        </p>
                    </div>
                    <div
                        class="text-slate-300 group-hover:text-emerald-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-emerald-50">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </div>
            </a>

            <a href="{{ route('owner.staff.index') }}"
                class="group relative overflow-hidden rounded-2xl border border-white/70 bg-white/50 p-7 shadow-md transition-all duration-300 hover:-translate-y-1 hover:border-amber-200 hover:bg-white hover:shadow-xl hover:shadow-amber-100/40">
                <div class="flex items-start justify-between">
                    <div class="space-y-3">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                            Staff &amp; Accounts
                        </h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                            Assign service agents, configure operational parameters and system authorization roles.
                        </p>
                    </div>
                    <div
                        class="text-slate-300 group-hover:text-amber-500 transition-all group-hover:translate-x-1 shrink-0 bg-slate-50 p-2 rounded-full group-hover:bg-amber-50">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </div>
            </a>

        </section>

    </div>
@endsection
````

## File: resources/views/livewire/owner/products/form.blade.php
````php
<form wire:submit="save" class="space-y-6" x-data="{
          imageSource: @entangle('imageSource'),
          get isUpload()  { return this.imageSource === '{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}' },
          get isLibrary() { return this.imageSource === '{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}' },
      }">

    <div class="grid gap-5">
        <div>
            <label for="product-name"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Name</label>
            <input wire:model.blur="name" id="product-name" type="text"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
            @error('name')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-category"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Category</label>
            <select wire:model="categoryId" id="product-category"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
                <option value="">— No category —</option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('categoryId')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-price"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Price</label>
            <div class="relative">
                <input wire:model.blur="price" id="product-price" type="text" inputmode="decimal" placeholder="12.50 DH"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-8 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
            </div>
            @error('price')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="product-description"
                class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Description</label>
            <textarea wire:model.blur="description" id="product-description" rows="3"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition"></textarea>
            @error('description')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="sort-order"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Sort order</label>
                <input wire:model.blur="sortOrder" id="sort-order" type="number" min="0"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition">
                @error('sortOrder')
                    <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            {{--
            No wire:model.live here — the checkbox state is purely local until save().
            A server round-trip to toggle a boolean that only matters on submit is wasted latency.
            --}}
            <label
                class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 transition hover:bg-slate-100">
                <input wire:model="isActive" type="checkbox"
                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                <span class="text-sm font-semibold text-slate-700">Active product</span>
            </label>
        </div>
    </div>

    <div class="space-y-4 rounded-2xl border border-slate-100 bg-slate-50 p-5 shadow-inner">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Image Source</p>
            <div class="mt-2 grid gap-2 sm:grid-cols-3">
                {{--
                Use x-model (Alpine) on the radio group so switching panels is instant —
                no server round-trip needed. @entangle keeps Livewire in sync so the
                value is still available when the form submits.
                --}}
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_NONE }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>None</span>
                </label>
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_UPLOAD }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>Upload</span>
                </label>
                <label
                    class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-indigo-300 has-[:checked]:border-indigo-600 has-[:checked]:ring-1 has-[:checked]:ring-indigo-600">
                    <input x-model="imageSource" type="radio" value="{{ \App\Models\Product::IMAGE_SOURCE_LIBRARY }}"
                        class="text-indigo-600 focus:ring-indigo-600">
                    <span>Library</span>
                </label>
            </div>
            @error('imageSource')
                <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 lg:grid-cols-[100px_minmax(0,1fr)] items-start pt-2">
            {{-- Preview thumbnail --}}
            @if($this->previewUrl)
                <img src="{{ $this->previewUrl }}" alt="Product preview"
                    class="h-[100px] w-[100px] rounded-xl border border-slate-200 bg-white object-cover shadow-sm">
            @else
                <div
                    class="flex h-[100px] w-[100px] items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-100">
                    <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
            @endif

            <div>
                {{-- Upload panel — shown/hidden by Alpine, no server round-trip --}}
                <div x-show="isUpload" x-cloak>
                    <input wire:model.live="upload" type="file" accept="image/png,image/jpeg,image/webp"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
                    <p class="mt-2 text-xs text-slate-500">Accepted: JPG, PNG, WEBP up to 4 MB (Min: 256×256).</p>
                    @error('upload')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Library panel — shown/hidden by Alpine, no server round-trip --}}
                <div x-show="isLibrary" x-cloak>
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                        @foreach ($this->libraryImages as $image)
                            <button wire:click="$set('selectedLibraryImage', '{{ $image['key'] }}')" type="button"
                                class="group relative overflow-hidden rounded-xl border-2 transition {{ $selectedLibraryImage === $image['key'] ? 'border-indigo-600 ring-2 ring-indigo-600/20' : 'border-transparent hover:border-slate-300' }}">
                                <img src="{{ $image['url'] }}" alt="{{ $image['label'] }}" loading="lazy" width="160"
                                    height="80"
                                    class="h-20 w-full object-cover transition duration-300 group-hover:scale-105">
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-2">
                                    <span
                                        class="block truncate text-left text-[10px] font-medium text-white">{{ $image['label'] }}</span>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @error('selectedLibraryImage')
                        <p class="mt-2 text-xs font-medium text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- None panel --}}
                <div x-show="!isUpload && !isLibrary" x-cloak>
                    <p class="flex h-full items-center text-sm text-slate-500 italic">No image will be displayed for
                        this product.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-2">
        <button type="submit"
            class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ $productId ? 'Save changes' : 'Create product' }}
        </button>
    </div>
</form>
````

## File: resources/views/livewire/waiter/requests/index.blade.php
````php
<div @if (config('services.supabase.url') && config('services.supabase.realtime_anon_enabled')) wire:poll.10s @else
wire:poll.3s @endif class="space-y-6">

    {{-- Supabase Realtime subscription lives in its own inner div so Alpine
    does not share the same root element as wire:poll. When Alpine and
    Livewire both own the same root element, Livewire's morphing can
    conflict with Alpine's reactivity and prevent poll-triggered re-renders
    from reaching the DOM correctly. --}}
    <div x-data="{
            handle: null,
            init() {
                if (window.AppRealtime && typeof window.AppRealtime.onRequestChange === 'function') {
                    this.handle = window.AppRealtime.onRequestChange(
                        { tenantId: {{ auth()->user()->tenant_id }} },
                        (payload) => {
                            if (window.AppRealtimeFilters && typeof window.AppRealtimeFilters.shouldRefreshWaiterList === 'function' && window.AppRealtimeFilters.shouldRefreshWaiterList(payload)) {
                                window.dispatchEvent(new CustomEvent('waiter-requests-refresh'));
                            }
                        },
                    );
                }
            },
            destroy() {
                if (this.handle && window.AppRealtime && typeof window.AppRealtime.unsubscribe === 'function') {
                    window.AppRealtime.unsubscribe(this.handle);
                }
            },
        }" x-on:waiter-requests-refresh.window="$wire.dispatch('refresh')">
    </div>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">Waiter requests</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">My Table Requests</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-600">
            Active service requests for your assigned tables. Updates live when Realtime is available.
        </p>

        <div class="mt-6">
            <button type="button" x-data @click="$dispatch('open-modal', 'scan-to-assign')"
                class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-sky-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 14h2m4 0h-2m-4 4h6" />
                </svg>
                <span>Scan to Assign</span>
            </button>
        </div>
    </section>

    @if (!$hasAssignedTables)
        {{-- No-assignment callout --}}
        <section class="overflow-hidden rounded-2xl border border-amber-200 bg-amber-50 p-8 shadow-sm">
            <div class="flex flex-col items-center justify-center text-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 border border-amber-200">
                    <svg class="h-7 w-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-amber-900">No Tables Assigned Yet</h2>
                    <p class="mt-2 text-sm text-amber-800 max-w-sm leading-relaxed">
                        You haven't been assigned to any tables. Ask your manager to assign you from the
                        <strong>Owner › Tables</strong> page. Once assigned, requests from those tables will appear here.
                    </p>
                </div>
            </div>
        </section>
    @else
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">
                        <th class="px-6 py-4">Table</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Elapsed</th>
                        <th class="px-6 py-4">Accepted by</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($requests as $request)
                        <tr class="align-top">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $request->tableSession->table->name }}</p>
                                <p class="mt-1 text-xs text-slate-500">{{ $request->tableSession->session_token }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $request->status === \App\Models\ServiceRequest::STATUS_PENDING ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 font-mono" x-data="{
                                        elapsed: Math.abs(parseInt('{{ now()->diffInSeconds($request->created_at, true) }}')) || 0,
                                        timer: null,
                                        init() {
                                            this.timer = setInterval(() => this.elapsed++, 1000);
                                        },
                                        destroy() {
                                            clearInterval(this.timer);
                                        },
                                        formatTime(seconds) {
                                            const total = Math.max(0, Math.floor(Math.abs(seconds)));
                                            const m = Math.floor(total / 60);
                                            const s = total % 60;
                                            return `${m}m ${s}s`;
                                        }
                                    }">
                                <span x-text="formatTime(elapsed)"></span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $request->acceptedBy?->name ?? 'Unassigned' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_PENDING)
                                        <button wire:click="acceptRequest({{ $request->id }})" type="button"
                                            class="rounded-lg border border-sky-300 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:border-sky-400 hover:text-sky-900">
                                            Accept
                                        </button>
                                    @endif

                                    @if ($request->status === \App\Models\ServiceRequest::STATUS_ACCEPTED)
                                        <button wire:click="resolveRequest({{ $request->id }})" type="button"
                                            class="rounded-lg border border-emerald-300 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:border-emerald-400 hover:text-emerald-900">
                                            Resolved
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 border border-slate-100">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">All Clear</p>
                                        <p class="mt-1 text-xs text-slate-400">No active requests for your tables right now.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    @endif
</div>
````

## File: routes/web.php
````php
<?php

use App\Enums\UserRole;
use App\Http\Controllers\Owner\TableQrCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Waiter\TableAssignmentController;

use App\Livewire\Customer\Catalog as CustomerCatalog;
use App\Livewire\Customer\TablePage as CustomerTablePage;
use App\Livewire\Owner\Categories\Index as OwnerCategoriesIndex;
use App\Livewire\Owner\Products\Index as OwnerProductsIndex;
use App\Livewire\Owner\Requests\Index as OwnerRequestsIndex;
use App\Livewire\Owner\Staff\Index as OwnerStaffIndex;
use App\Livewire\Owner\Tables\Index as OwnerTablesIndex;
use App\Livewire\Waiter\Requests\Index as WaiterRequestsIndex;
use App\Livewire\Waiter\Tables\Index as WaiterTablesIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();

    if (!$user) {
        return redirect()->route('login');
    }

    if (!$user->tenant_id || $user->role === null) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors(['email' => 'Your account is not fully set up. Please contact support.']);
    }

    return redirect()->route($user->dashboardRouteName());
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'tenant', 'role:' . UserRole::Owner->value])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tables', OwnerTablesIndex::class)->name('tables.index');
    Route::get('/products', OwnerProductsIndex::class)->name('products.index');
    Route::get('/categories', OwnerCategoriesIndex::class)->name('categories.index');
    Route::get('/staff', OwnerStaffIndex::class)->name('staff.index');
    Route::get('/tables/{table}/qr.png', TableQrCodeController::class)->name('tables.qr.download');
    Route::get('/requests', OwnerRequestsIndex::class)->name('requests.index');
});

Route::middleware(['auth', 'tenant', 'role:' . UserRole::Waiter->value])->prefix('waiter')->name('waiter.')->group(function () {
    Route::get('/dashboard', function () {
        return view('waiter.dashboard');
    })->name('dashboard');

    Route::get('/requests', WaiterRequestsIndex::class)->name('requests.index');
    Route::get('/tables', WaiterTablesIndex::class)->name('tables.index');
    Route::post('/tables/assign-via-qr', TableAssignmentController::class)->name('tables.assign-via-qr');
});

Route::get('/t/{qr_token}/catalog', CustomerCatalog::class)->name('customer.catalog');

Route::get('/t/{qr_token}', CustomerTablePage::class)->name('customer.table');

use App\Http\Controllers\Customers\CustomerRequestController;

Route::post('/api/table/request', [CustomerRequestController::class, 'store'])->name('customer.request.store');
Route::delete('/api/table/request/{id}', [CustomerRequestController::class, 'cancel'])->name('customer.request.cancel');

require __DIR__ . '/auth.php';
````

## File: app/Livewire/Customer/TablePage.php
````php
<?php

namespace App\Livewire\Customer;

use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Services\TableSessionService;
use App\Support\ComponentRateLimiter;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

#[Layout('layouts.customer')]
class TablePage extends Component
{
    public const SESSION_COOKIE = 'st_session_token';

    public const SESSION_TTL_MINUTES = 360;

    public int $tableId;

    public int $sessionId;

    public string $qrToken;

    public string $tableName;

    public string $tenantName;

    public bool $blocked = false;

    public ?int $activeRequestId = null;

    public function mount(string $qr_token, TableSessionService $tableSessionService): void
    {
        $table = Table::withoutGlobalScopes()
            ->where('qr_token', $qr_token)
            ->whereNull('deleted_at')
            ->with('tenant')
            ->firstOrFail();

        $result = $tableSessionService->resolveOrStart($table, request()->cookie(self::SESSION_COOKIE));
        $session = $result['session'];

        $this->tableId = $table->getKey();
        $this->sessionId = $session->getKey();
        $this->qrToken = $qr_token;
        $this->tableName = $table->name;
        $this->tenantName = $table->tenant->name;
        $this->blocked = $result['blocked'];

        if (!$this->blocked) {
            Cookie::queue($this->sessionCookie($session->session_token));
            $this->syncActiveRequest();
        }
    }

    public function callWaiter(): void
    {
        $session = $this->authorizedActiveSession();
        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        $existingRequest = $this->currentOpenRequest($session);

        if ($existingRequest !== null) {
            $this->activeRequestId = $existingRequest->getKey();

            return;
        }

        // Mark the table occupied now that a customer has actively engaged
        $session->table()->withoutGlobalScopes()->first()?->markOccupied();

        // Resolve any old pending/accepted requests for this table (across all sessions)
        // so only the latest request stays active
        ServiceRequest::withoutGlobalScopes()
            ->whereHas('tableSession', function ($query) {
                $query->where('table_id', $this->tableId);
            })
            ->whereIn('status', [
                ServiceRequest::STATUS_PENDING,
                ServiceRequest::STATUS_ACCEPTED,
            ])
            ->update([
                'status' => ServiceRequest::STATUS_RESOLVED,
                'resolved_at' => now(),
            ]);

        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $session->tenant_id,
            'table_session_id' => $session->getKey(),
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $this->activeRequestId = $request->getKey();
    }

    public function cancelRequest(): void
    {
        $session = $this->authorizedActiveSession();
        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        $request = ServiceRequest::withoutGlobalScopes()
            ->whereKey($this->activeRequestId)
            ->where('table_session_id', $session->getKey())
            ->first();

        if ($request === null) {
            $this->activeRequestId = null;

            return;
        }

        $request->cancel();
        $this->activeRequestId = null;
    }

    public function refreshRequestStatus(): void
    {
        if ($this->blocked) {
            return;
        }

        $this->syncActiveRequest();
    }

    #[On('refresh-status')]
    public function refreshStatusFromRealtime(): void
    {
        $this->refreshRequestStatus();
    }

    public function render()
    {
        $activeRequest = null;
        $requestsAhead = 0;
        $status = $this->blocked ? 'blocked' : 'idle';
        $requestId = null;
        $elapsedSeconds = 0;

        if (!$this->blocked && $this->activeRequestId !== null) {
            $found = ServiceRequest::withoutGlobalScopes()
                ->find($this->activeRequestId);

            if (
                $found !== null && in_array($found->status, [
                    ServiceRequest::STATUS_RESOLVED,
                    ServiceRequest::STATUS_CANCELLED,
                ], true)
            ) {
                $this->activeRequestId = null;
                $found = null;
            }

            if ($found !== null) {
                $activeRequest = $found;

                $requestsAhead = ServiceRequest::withoutGlobalScopes()
                    ->where('tenant_id', $activeRequest->tenant_id)
                    ->whereIn('status', [
                        ServiceRequest::STATUS_PENDING,
                        ServiceRequest::STATUS_ACCEPTED,
                    ])
                    ->where('created_at', '<', $activeRequest->created_at)
                    ->count();

                $status = $activeRequest->status; // 'pending' or 'accepted'
                $requestId = $activeRequest->getKey();
                $elapsedSeconds = max(0, (int) abs(now()->diffInSeconds($activeRequest->created_at)));
            }
        }

        return view('livewire.customer.table-page', [
            'activeRequest' => $activeRequest,
            'requestsAhead' => $requestsAhead,
            'status' => $status,
            'requestId' => $requestId,
            'elapsedSeconds' => $elapsedSeconds,
        ]);
    }

    protected function syncActiveRequest(): void
    {
        $session = TableSession::withoutGlobalScopes()->find($this->sessionId);

        if ($session === null || !$session->isActive()) {
            $this->activeRequestId = null;
            Cookie::queue(Cookie::forget(self::SESSION_COOKIE));

            return;
        }

        $request = $this->currentOpenRequest($session);
        $this->activeRequestId = $request?->getKey();
    }

    protected function currentOpenRequest(TableSession $session): ?ServiceRequest
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('table_session_id', $session->getKey())
            ->whereIn('status', [
                ServiceRequest::STATUS_PENDING,
                ServiceRequest::STATUS_ACCEPTED,
            ])
            ->oldest('created_at')
            ->first();
    }

    protected function authorizedActiveSession(): TableSession
    {
        abort_if($this->blocked, Response::HTTP_FORBIDDEN);

        $session = TableSession::withoutGlobalScopes()
            ->whereKey($this->sessionId)
            ->where('table_id', $this->tableId)
            ->where('status', TableSession::STATUS_ACTIVE)
            ->firstOrFail();

        $cookieToken = request()->cookie(self::SESSION_COOKIE);

        abort_unless(
            $cookieToken !== null && hash_equals($session->session_token, $cookieToken),
            Response::HTTP_FORBIDDEN
        );

        return $session;
    }

    protected function sessionCookie(string $token): \Symfony\Component\HttpFoundation\Cookie
    {
        return Cookie::make(
            self::SESSION_COOKIE,
            $token,
            self::SESSION_TTL_MINUTES,
            '/',
            null,
            null,
            config('session.secure', false),
            false,
            'lax'
        );
    }
}
````

## File: resources/views/livewire/customer/table-page.blade.php
````php
<div x-data="tablePage({
        sessionId:      {{ $sessionId }},
        status:         '{{ $status }}',
        requestId:      {{ $requestId ?? 'null' }},
        requestsAhead:  {{ $requestsAhead }},
        elapsedSeconds: {{ $elapsedSeconds }},
    })" class="flex min-h-[70vh] flex-col items-center justify-center space-y-10 py-8 relative z-10">

    {{-- ── BLOCKED ──────────────────────────────────────────────────────────── --}}
    <template x-if="status === 'blocked'">
        <div class="flex flex-col items-center justify-center space-y-5 text-center animate-fade-in-up">
            <div
                class="flex h-24 w-24 items-center justify-center rounded-full bg-red-50 border border-red-100 shadow-lg shadow-red-100/50">
                <svg class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 115.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Table Restricted</h2>
                <p class="mt-2 text-slate-500 font-medium max-w-sm leading-relaxed">This table session has been
                    temporarily
                    paused. Please see a staff member for assistance.</p>
            </div>
        </div>
    </template>

    {{-- ── NOT BLOCKED: venue header (always visible when not blocked) ─────── --}}
    <template x-if="status !== 'blocked'">
        <div class="text-center space-y-2">
            <h2 class="text-indigo-500 font-bold tracking-[0.25em] uppercase text-3xl">{{ $tenantName }}</h2>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight drop-shadow-sm">Table N° : {{ $tableName }}
            </h2>
        </div>
    </template>

    {{-- ── ACTIVE REQUEST (pending / accepted) ─────────────────────────────── --}}
    <template x-if="status === 'pending' || status === 'accepted'">
        <div
            class="w-full max-w-sm overflow-hidden rounded-[2rem] border border-white/60 bg-white/70 p-8 shadow-2xl shadow-indigo-100/60 backdrop-blur-xl relative transition-all duration-500">

            <!-- Ambient Card Glow -->
            <div
                class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-amber-200/30 blur-[60px] pointer-events-none">
            </div>
            <div
                class="absolute -left-10 -bottom-10 h-48 w-48 rounded-full bg-indigo-200/30 blur-[60px] pointer-events-none">
            </div>

            <div class="flex flex-col items-center justify-center space-y-8 relative z-10">

                <!-- Status Badge -->
                <div class="flex flex-col items-center space-y-3 text-center">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-md transition-colors duration-300"
                        :class="status === 'pending'
                            ? 'border-amber-200 bg-amber-50 text-amber-600'
                            : 'border-emerald-200 bg-emerald-50 text-emerald-600'">
                        <!-- Pending dot -->
                        <template x-if="status === 'pending'">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                            </span>
                        </template>
                        <!-- Accepted dot -->
                        <template x-if="status === 'accepted'">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-40"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                            </span>
                        </template>
                        <span x-text="status === 'pending' ? 'Waiter Alerted' : 'Waiter Approaching'"></span>
                    </span>
                    <p class="text-slate-500 text-sm font-medium" x-text="status === 'pending'
                            ? 'Your request has been broadcasted to the staff.'
                            : 'A staff member is heading to your table now.'">
                    </p>
                </div>

                <!-- Queue Position -->
                <template x-if="requestsAhead > 0">
                    <div
                        class="flex w-full items-center justify-center gap-3 rounded-2xl bg-amber-50/50 border border-amber-100/80 py-3.5 px-4 shadow-inner">
                        <svg class="h-5 w-5 text-amber-500 animate-pulse" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span class="text-sm font-medium text-slate-600">
                            <strong class="text-slate-900 text-base font-black" x-text="requestsAhead"></strong>
                            <span
                                x-text="requestsAhead === 1 ? ' request ahead of you' : ' requests ahead of you'"></span>
                        </span>
                    </div>
                </template>
                <template x-if="requestsAhead === 0">
                    <div
                        class="flex w-full items-center justify-center gap-2.5 rounded-2xl bg-emerald-50 border border-emerald-100 py-3.5 px-4 shadow-inner">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-black tracking-wide text-emerald-600 uppercase">You are next!</span>
                    </div>
                </template>

                <!-- Timer -->
                <div
                    class="w-full bg-slate-50/80 rounded-2xl p-6 border border-slate-200/60 shadow-inner flex flex-col items-center justify-center gap-2">
                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">Wait Time</span>
                    <span class="text-4xl font-light text-slate-800 font-mono tracking-tight drop-shadow-sm"
                        x-text="formatTime(elapsed)"></span>
                </div>

                <!-- Cancel -->
                <button @click="cancelRequest()" :disabled="loading" type="button"
                    class="group relative inline-flex w-full items-center justify-center gap-2 overflow-hidden rounded-xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm font-bold text-red-600 transition-all hover:bg-red-100 hover:border-red-300 hover:text-red-700 hover:shadow-md focus:outline-none active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="h-4 w-4 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span x-text="loading ? 'Cancelling…' : 'Cancel Request'"></span>
                </button>

            </div>
        </div>
    </template>

    {{-- ── IDLE: golden call-waiter button ─────────────────────────────────── --}}
    <template x-if="status === 'idle'">
        <div class="flex flex-col items-center justify-center mt-4">

            <style>
                @keyframes premium-bell-vibrate {

                    0%,
                    65%,
                    100% {
                        transform: scale(1) rotate(0deg);
                    }

                    68% {
                        transform: scale(1.04) rotate(-4deg);
                    }

                    71% {
                        transform: scale(0.96) rotate(5deg);
                    }

                    74% {
                        transform: scale(1.04) rotate(-4deg);
                    }

                    77% {
                        transform: scale(0.96) rotate(4deg);
                    }

                    80% {
                        transform: scale(1.02) rotate(-2deg);
                    }

                    83% {
                        transform: scale(0.98) rotate(2deg);
                    }

                    86% {
                        transform: scale(1) rotate(0deg);
                    }
                }

                .animate-bell-vibrate {
                    animation: premium-bell-vibrate 2.5s infinite ease-in-out;
                }
            </style>

            <button @click="callWaiter()" :disabled="loading" type="button"
                class="group relative flex h-72 w-72 items-center justify-center rounded-full bg-gradient-to-br from-yellow-200 via-amber-400 to-amber-600 shadow-[0_20px_50px_-12px_rgba(217,119,6,0.5)] transition-all duration-500 hover:shadow-[0_20px_60px_-10px_rgba(217,119,6,0.7)] hover:-translate-y-2 active:scale-95 border border-yellow-300/50 disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:translate-y-0">
                <!-- Orbiting Light Track & Particle -->
                <div class="absolute -inset-4 rounded-full border border-amber-400/20 pointer-events-none"></div>
                <div class="absolute -inset-4 rounded-full pointer-events-none animate-spin"
                    style="animation-duration: 3s;">
                    <div
                        class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 h-4 w-4 rounded-full bg-white shadow-[0_0_15px_5px_rgba(255,255,255,0.9),0_0_25px_10px_rgba(245,158,11,0.7)]">
                    </div>
                </div>

                <!-- Outer Rim Highlight -->
                <div
                    class="absolute inset-0 rounded-full border-4 border-white/40 mix-blend-overlay pointer-events-none">
                </div>

                <!-- Inner Bevel -->
                <div
                    class="absolute inset-4 rounded-full bg-gradient-to-tl from-amber-600 via-amber-400 to-yellow-200 shadow-[inset_0_10px_20px_rgba(180,83,9,0.5)] flex flex-col items-center justify-center transition-transform duration-500 group-hover:scale-105 border border-amber-600/30">

                    <!-- Center Dome -->
                    <div
                        class="absolute inset-6 rounded-full bg-gradient-to-br from-yellow-100 via-amber-300 to-amber-500 shadow-[0_15px_30px_rgba(180,83,9,0.6),inset_0_4px_10px_rgba(255,255,255,0.8)] flex flex-col items-center justify-center border border-yellow-200/80">

                        <!-- Vibrating Content -->
                        <div class="flex flex-col items-center justify-center animate-bell-vibrate select-none">
                            <div
                                class="rounded-full bg-amber-900/10 p-4 mb-2 shadow-[inset_0_4px_8px_rgba(180,83,9,0.3)] transition-colors group-hover:bg-amber-900/20">
                                <svg class="h-12 w-12 text-amber-950 drop-shadow-md" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </div>
                            <span x-text="loading ? 'Sending…' : 'Call Waiter'"
                                class="text-md font-black text-amber-950 tracking-widest uppercase drop-shadow-[0_2px_2px_rgba(255,255,255,0.4)]">
                            </span>
                        </div>

                    </div>
                </div>
            </button>

            <p
                class="mt-12 text-slate-500 text-sm font-medium text-center max-w-xs leading-relaxed bg-white/50 backdrop-blur-sm px-6 py-3 rounded-2xl border border-white/60 shadow-sm">
                Tap the golden ring above to immediately notify a staff member to assist you.
            </p>

            <!-- Catalog Navigation Link -->
            <a href="{{ route('customer.catalog', ['qr_token' => $qrToken]) }}"
                class="mt-6 group inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-700 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <svg class="h-5 w-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span>View Menu & Catalog</span>
            </a>
        </div>
    </template>

</div>

<script>
    function tablePage({ sessionId, status, requestId, requestsAhead, elapsedSeconds }) {
        return {
            status,
            requestId,
            requestsAhead,
            elapsed: elapsedSeconds,
            loading: false,
            _timer: null,
            _handle: null,

            init() {
                if (this.status === 'pending' || this.status === 'accepted') {
                    this._startTimer();
                }

                if (window.AppRealtime && typeof window.AppRealtime.onSessionChange === 'function') {
                    this._handle = window.AppRealtime.onSessionChange(
                        { sessionId },
                        (payload) => this._handlePush(payload)
                    );
                }
            },

            destroy() {
                clearInterval(this._timer);
                if (this._handle && window.AppRealtime?.unsubscribe) {
                    window.AppRealtime.unsubscribe(this._handle);
                }
            },

            // ── Realtime push: mutate state directly — zero server round-trip ──
            _handlePush(payload) {
                const r = payload.new ?? payload;

                if (r.status === 'resolved' || r.status === 'cancelled') {
                    this._resetToIdle();
                    return;
                }

                // pending or accepted
                this.status = r.status;
                this.requestId = r.id ?? this.requestId;
                this.requestsAhead = r.requests_ahead ?? this.requestsAhead;
                this._startTimer();
            },

            // ── Actions ────────────────────────────────────────────────────────
            async callWaiter() {
                if (this.loading) return;
                this.loading = true;
                try {
                    const res = await fetch('/api/table/request', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        },
                        body: JSON.stringify({ session_id: sessionId }),
                    });
                    if (!res.ok) return;
                    const data = await res.json();
                    this.requestId = data.id;
                    this.status = 'pending';
                    this.elapsed = 0;
                    this.requestsAhead = data.requests_ahead ?? 0;
                    this._startTimer();
                } finally {
                    this.loading = false;
                }
            },

            async cancelRequest() {
                if (this.loading || !this.requestId) return;
                this.loading = true;
                try {
                    const res = await fetch(`/api/table/request/${this.requestId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        },
                        body: JSON.stringify({ session_id: sessionId }),
                    });
                    if (!res.ok) return;
                    this._resetToIdle();
                } finally {
                    this.loading = false;
                }
            },

            // ── Helpers ────────────────────────────────────────────────────────
            _resetToIdle() {
                clearInterval(this._timer);
                this.status = 'idle';
                this.requestId = null;
                this.elapsed = 0;
                this.requestsAhead = 0;
            },

            _startTimer() {
                clearInterval(this._timer);
                this._timer = setInterval(() => this.elapsed++, 1000);
            },

            formatTime(s) {
                const total = Math.max(0, Math.floor(Math.abs(s)));
                if (total < 60) return `${total}s`;
                const m = Math.floor(total / 60);
                return `${m}min ${String(total % 60).padStart(2, '0')}s`;
            },
        };
    }
</script>
````
