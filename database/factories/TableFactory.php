<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Table>
 */
class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition(): array
    {
        static $sequence = 1;

        return [
            'tenant_id' => Tenant::factory(),
            'name' => 'Table '.$sequence++,
            'status' => Table::STATUS_FREE,
        ];
    }
}
