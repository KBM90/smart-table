<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Database\Factories\ServiceRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'assigned_waiter_id',
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

    /**
     * Computed: seconds between request creation and resolution.
     * Returns null if the request has not been resolved yet.
     */
    public function getResponseTimeSecondsAttribute(): ?int
    {
        if ($this->resolved_at === null || $this->created_at === null) {
            return null;
        }

        return (int) $this->created_at->diffInSeconds($this->resolved_at);
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

    /** The waiter explicitly assigned to handle this request. */
    public function assignedWaiter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_waiter_id');
    }

    /** The customer review submitted after this request was resolved. */
    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'request_id');
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
        // Close the session entirely so the customer cannot reuse it
        // from their browser history after leaving the table.
        $session->forceFill([
            'status' => TableSession::STATUS_CLOSED,
            'ended_at' => now(),
        ])->save();

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