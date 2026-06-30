<?php

use App\Enums\UserRole;
use App\Http\Controllers\Owner\AccountVerificationController;
use App\Http\Controllers\Owner\BillingController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\SettingsController;
use App\Http\Controllers\Owner\TableQrCodeController;
use App\Http\Controllers\Owner\WaiterPerformanceController;
use App\Http\Controllers\Owner\WaiterStatsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Waiter\TableAssignmentController;
use App\Livewire\Customer\Catalog as CustomerCatalog;
use App\Livewire\Customer\TablePage as CustomerTablePage;
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
Route::view('/terms-of-service', 'legal.terms')->name('legal.terms');
Route::view('/privacy-policy', 'legal.privacy')->name('legal.privacy');
Route::view('/refund-policy', 'legal.refund')->name('legal.refund');

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

Route::middleware(['auth', 'tenant', 'subscription', 'role:'.UserRole::Owner->value])
    ->prefix('api/owner')
    ->name('owner.api.')
    ->group(function () {
        Route::get('/waiters', [WaiterStatsController::class, 'index'])->name('waiters.index');
        Route::get('/waiters/{waiter}/stats', [WaiterStatsController::class, 'show'])->name('waiters.stats');
    });

Route::middleware(['auth', 'tenant', 'role:'.UserRole::Owner->value])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/account-verification', [AccountVerificationController::class, 'show'])->name('account-verification.show');
    Route::post('/account-verification/send', [AccountVerificationController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('account-verification.send');
    Route::post('/account-verification', [AccountVerificationController::class, 'verify'])
        ->middleware('throttle:10,1')
        ->name('account-verification.verify');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('subscription')->name('dashboard');
    Route::get('/tables', OwnerTablesIndex::class)->middleware('subscription')->name('tables.index');
    Route::get('/products', OwnerProductsIndex::class)->middleware('subscription')->name('products.index');
    Route::get('/staff', OwnerStaffIndex::class)->middleware('subscription')->name('staff.index');
    Route::get('/tables/{table}/qr.png', TableQrCodeController::class)->middleware('subscription')->name('tables.qr.download');
    Route::get('/requests', OwnerRequestsIndex::class)->middleware('subscription')->name('requests.index');
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // ─── Waiter Performance ─────────────────────────────────────────────────
    Route::get('/waiters', [WaiterPerformanceController::class, 'index'])->middleware('subscription')->name('waiters.index');
    Route::get('/waiters/{waiter}', [WaiterPerformanceController::class, 'show'])->middleware('subscription')->name('waiters.show');

    // ─── Billing ────────────────────────────────────────────────────────────
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/checkout', [BillingController::class, 'checkout'])->name('billing.checkout');
    Route::get('/billing/portal', [BillingController::class, 'portal'])->name('billing.portal');
    Route::get('/billing/success', [BillingController::class, 'success'])->name('billing.success');
});

Route::middleware(['auth', 'tenant', 'subscription', 'role:'.UserRole::Waiter->value])->prefix('waiter')->name('waiter.')->group(function () {
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
use App\Http\Controllers\Customers\CustomerReviewController;

Route::post('/api/table/request', [CustomerRequestController::class, 'store'])->name('customer.request.store');
Route::delete('/api/table/request/{id}', [CustomerRequestController::class, 'cancel'])->name('customer.request.cancel');

// ─── Customer Review ─────────────────────────────────────────────────────────
// No auth required — customers are identified via the session cookie.
Route::post('/api/reviews', [CustomerReviewController::class, 'store'])->name('customer.review.store');

require __DIR__.'/auth.php';
