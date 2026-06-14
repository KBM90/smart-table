<?php

namespace App\Models;

use Database\Factories\TenantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Cashier\Billable;

class Tenant extends Model
{
    /** @use HasFactory<TenantFactory> */
    use HasFactory;
    use Billable;

    protected $fillable = [
        'name',
        'slug',
        'trial_ends_at',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    // ─── Relationships ───────────────────────────────────────────────────────

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

    // ─── Billing Helpers ─────────────────────────────────────────────────────

    /**
     * True when the cardless local trial period has not yet expired.
     * This does NOT touch Stripe — it is a local timestamp check only.
     */
    public function isTrialActive(): bool
    {
        return $this->trial_ends_at !== null
            && $this->trial_ends_at->isFuture();
    }

    /**
     * True when the tenant has either an active local trial OR a valid
     * Stripe subscription (active, trialing, or in a cancellation grace period).
     *
     * Use this as the single source of truth for feature access gates.
     */
    public function hasActiveSubscription(): bool
    {
        if ($this->isTrialActive()) {
            return true;
        }

        // Cashier's subscribed() returns true for active and grace-period statuses
        return $this->subscribed('default');
    }
}
