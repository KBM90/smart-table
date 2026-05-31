<?php

use App\Enums\UserRole;
use App\Http\Controllers\Owner\TableQrCodeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Customer\Catalog as CustomerCatalog;
use App\Livewire\Customer\TablePage as CustomerTablePage;
use App\Livewire\Owner\Products\Index as OwnerProductsIndex;
use App\Livewire\Owner\Requests\Index as OwnerRequestsIndex;
use App\Livewire\Owner\Staff\Index as OwnerStaffIndex;
use App\Livewire\Owner\Tables\Index as OwnerTablesIndex;
use App\Livewire\Waiter\Requests\Index as WaiterRequestsIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return redirect()->route(Auth::user()->dashboardRouteName());
});

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();

    if (! $user) {
        return redirect()->route('login');
    }

    if (! $user->tenant_id || $user->role === null) {
        abort(403);
    }

    return redirect()->route($user->dashboardRouteName());
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'tenant', 'role:'.UserRole::Owner->value])->prefix('owner')->name('owner.')->group(function () {
    Route::view('/dashboard', 'owner.dashboard')->name('dashboard');
    Route::get('/tables', OwnerTablesIndex::class)->name('tables.index');
    Route::get('/products', OwnerProductsIndex::class)->name('products.index');
    Route::get('/staff', OwnerStaffIndex::class)->name('staff.index');
    Route::get('/tables/{table}/qr.png', TableQrCodeController::class)->name('tables.qr.download');
    Route::get('/requests', OwnerRequestsIndex::class)->name('requests.index');
});

Route::middleware(['auth', 'tenant', 'role:'.UserRole::Waiter->value])->prefix('waiter')->name('waiter.')->group(function () {
    Route::get('/dashboard', WaiterRequestsIndex::class)->name('dashboard');
    Route::get('/requests', WaiterRequestsIndex::class)->name('requests.index');
});

Route::get('/t/{qr_token}/catalog', CustomerCatalog::class)->name('customer.catalog');

Route::get('/t/{qr_token}', CustomerTablePage::class)->name('customer.table');

require __DIR__.'/auth.php';
