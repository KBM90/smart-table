<?php

namespace Tests\Feature\Realtime;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RealtimeAnonDisabledTest extends TestCase
{
    use RefreshDatabase;

    public function test_realtime_anon_disabled_marker_is_rendered_when_flag_is_false(): void
    {
        config([
            'services.supabase.url' => 'https://example.supabase.co',
            'services.supabase.anon_key' => 'anon-key',
            'services.supabase.realtime_anon_enabled' => false,
        ]);

        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSee('window.REALTIME_ANON_ENABLED = false;', false)
            ->assertSee('wire:poll.3s', false);
    }
}