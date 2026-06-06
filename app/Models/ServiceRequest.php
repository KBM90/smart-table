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