<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tenant>
 */
class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        $company = fake()->unique()->company();

        return [
            'name' => $company,
            'slug' => Str::slug($company),
            'trial_ends_at' => now()->addWeek(),
        ];
    }

    public function expiredTrial(): static
    {
        return $this->state(fn () => [
            'trial_ends_at' => now()->subDay(),
        ]);
    }
}
