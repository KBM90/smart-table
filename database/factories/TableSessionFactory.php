<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TableSession>
 */
class TableSessionFactory extends Factory
{
    protected $model = TableSession::class;

    public function definition(): array
    {
        $table = Table::factory()->create();

        return [
            'tenant_id' => $table->tenant_id,
            'table_id' => $table->id,
            'session_token' => Str::random(40),
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
            'ended_at' => null,
        ];
    }

    public function closed(): static
    {
        return $this->state(fn () => [
            'status' => TableSession::STATUS_CLOSED,
            'ended_at' => now(),
        ]);
    }
}
