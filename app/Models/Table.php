<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Database\Factories\TableFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
