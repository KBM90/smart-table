<?php

use App\Enums\UserRole;
use App\Http\Controllers\Owner\BillingController;
use App\Http\Controllers\Owner\TableQrCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Waiter\TableAssignmentController;
use App\Http\Controllers\Owner\WaiterStatsController;
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
Route::view('/pricing', 'pricing')->name('pricing');

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();

    if ($user->tenant_id === null || $user->role === null) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Your account is not fully set up. Please contact support.',
            ]);
    }

    return redirect()->route($user->dashboardRouteName());
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'tenant', 'role:' . UserRole::Owner->value])
    ->prefix('api/owner')
    ->name('owner.api.')
    ->group(function () {
        Route::get('/waiters', [WaiterStatsController::class, 'index'])->name('waiters.index');
        Route::get('/waiters/{waiter}/stats', [WaiterStatsController::class, 'show'])->name('waiters.stats');
    });

Route::middleware(['auth', 'tenant', 'role:' . UserRole::Owner->value])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tables', OwnerTablesIndex::class)->name('tables.index');
    Route::get('/products', OwnerProductsIndex::class)->name('products.index');
    Route::get('/staff', OwnerStaffIndex::class)->name('staff.index');
    Route::get('/tables/{table}/qr.png', TableQrCodeController::class)->name('tables.qr.download');
    Route::get('/requests', OwnerRequestsIndex::class)->name('requests.index');

    // ─── Billing ────────────────────────────────────────────────────────────
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/checkout', [BillingController::class, 'checkout'])->name('billing.checkout');
    Route::get('/billing/portal', [BillingController::class, 'portal'])->name('billing.portal');
    Route::get('/billing/success', [BillingController::class, 'success'])->name('billing.success');
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

// ─── Stripe Webhook ──────────────────────────────────────────────────────────
// Must be outside all auth/tenant middleware groups — Stripe POSTs here as an
// unauthenticated server-to-server request. CSRF is excluded in bootstrap/app.php.
Route::post('/stripe/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');

require __DIR__ . '/auth.php';