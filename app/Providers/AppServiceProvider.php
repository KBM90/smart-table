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
