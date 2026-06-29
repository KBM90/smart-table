<?php

namespace Tests\Feature\Auth;

use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response
            ->assertStatus(200)
            ->assertSeeText('Terms of Service')
            ->assertSeeText('Privacy Policy');
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'business_name' => 'Test Cafe',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => '1',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertDatabaseHas('tenants', [
            'name' => 'Test Cafe',
            'slug' => 'test-cafe',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => UserRole::Owner->value,
        ]);
    }

    public function test_registration_requires_terms_acceptance(): void
    {
        $response = $this->from('/register')->post('/register', [
            'business_name' => 'Test Cafe',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertRedirect('/register')
            ->assertSessionHasErrors('terms');

        $this->assertGuest();
        $this->assertDatabaseMissing('users', [
            'email' => 'test@example.com',
        ]);
    }
}
