<?php

namespace Tests\Feature\Owner;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_business_settings(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/settings')
            ->assertOk()
            ->assertSeeText('Account Settings')
            ->assertSeeText('Business name')
            ->assertSeeText('Business email');
    }

    public function test_owner_updates_business_information_for_their_tenant(): void
    {
        $owner = User::factory()->owner()->create();

        $response = $this->actingAs($owner)->patch('/owner/settings', [
            'name' => 'Maison Atlas',
            'contact_email' => 'hello@maison-atlas.test',
            'phone' => '+212 600 000 000',
            'address' => '12 Avenue Mohammed V',
            'city' => 'Casablanca',
            'country' => 'Morocco',
        ]);

        $response->assertRedirect(route('owner.settings.edit'));
        $response->assertSessionHas('status', 'business-settings-updated');

        $this->assertDatabaseHas('tenants', [
            'id' => $owner->tenant_id,
            'name' => 'Maison Atlas',
            'contact_email' => 'hello@maison-atlas.test',
            'phone' => '+212 600 000 000',
            'address' => '12 Avenue Mohammed V',
            'city' => 'Casablanca',
            'country' => 'Morocco',
        ]);
    }

    public function test_owner_settings_validation_requires_a_business_name(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->from('/owner/settings')
            ->patch('/owner/settings', [
                'name' => '',
                'contact_email' => 'not-an-email',
            ])
            ->assertRedirect('/owner/settings')
            ->assertSessionHasErrors(['name', 'contact_email']);
    }

    public function test_waiter_cannot_access_owner_business_settings(): void
    {
        $waiter = User::factory()->waiter(Tenant::factory()->create())->create();

        $this->actingAs($waiter)
            ->get('/owner/settings')
            ->assertForbidden();
    }
}
