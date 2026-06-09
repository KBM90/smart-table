<?php

namespace Database\Seeders;

use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder; // ← add this


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class); // ← add this line

        $tenantA = Tenant::factory()->create([
            'name' => 'Smoke Cafe A',
            'slug' => 'smoke-cafe-a',
        ]);

        $ownerA = User::factory()->owner($tenantA)->create([
            'name' => 'Owner A',
            'email' => 'owner-a@example.com',
        ]);

        User::factory()->waiter($tenantA)->create([
            'name' => 'Waiter A',
            'email' => 'waiter-a@example.com',
        ]);

        Table::factory()->count(2)->create([
            'tenant_id' => $tenantA->id,
        ]);

        $tenantB = Tenant::factory()->create([
            'name' => 'Smoke Cafe B',
            'slug' => 'smoke-cafe-b',
        ]);

        User::factory()->owner($tenantB)->create([
            'name' => 'Owner B',
            'email' => 'owner-b@example.com',
        ]);

        Table::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Table B1',
            'status' => Table::STATUS_FREE,
        ]);


    }
}
