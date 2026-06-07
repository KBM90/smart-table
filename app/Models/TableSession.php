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
