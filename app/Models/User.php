<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, MustVerifyEmail, Notifiable, SoftDeletes;

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
        'phone',
        'verification_method',
        'account_verified_at',
        'verification_code_hash',
        'verification_code_expires_at',
        'verification_code_sent_at',
        'photo',
        'joined_at',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code_hash',
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
            'account_verified_at' => 'datetime',
            'verification_code_expires_at' => 'datetime',
            'verification_code_sent_at' => 'datetime',
            'joined_at' => 'datetime',
            'is_active' => 'boolean',
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

    /** Service requests explicitly assigned to this waiter. */
    public function assignedRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'assigned_waiter_id');
    }

    /** Reviews received by this waiter. */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'waiter_id');
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

    public function hasVerifiedAccount(): bool
    {
        return $this->account_verified_at !== null;
    }

    public function requiresAccountVerification(): bool
    {
        return ! $this->hasVerifiedAccount();
    }

    public function verificationDestination(): string
    {
        return $this->verification_method === 'whatsapp'
            ? (string) $this->phone
            : (string) $this->email;
    }
}
