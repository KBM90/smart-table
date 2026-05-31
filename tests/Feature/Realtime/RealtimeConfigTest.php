<?php

namespace Tests\Feature\Realtime;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RealtimeConfigTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_page_marks_realtime_enabled_when_supabase_url_is_present(): void
    {
        config([
            'services.supabase.url' => 'https://example.supabase.co',
            'services.supabase.anon_key' => 'anon-key',
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSee('window.REALTIME_ENABLED = true;', false);
    }

    public function test_owner_page_falls_back_to_polling_when_supabase_url_is_missing(): void
    {
        config([
            'services.supabase.url' => null,
            'services.supabase.anon_key' => null,
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSee('window.REALTIME_ENABLED = false;', false)
            ->assertSee('wire:poll.3s', false);
    }

    public function test_realtime_partial_does_not_render_service_role_key(): void
    {
        config([
            'services.supabase.url' => 'https://example.supabase.co',
            'services.supabase.anon_key' => 'anon-key',
            'services.supabase.service_role' => 'super-secret-role-key',
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertDontSee('super-secret-role-key', false);
    }
}