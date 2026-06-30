<?php

namespace Tests\Feature\Owner;

use App\Models\User;
use App\Services\WhatsAppVerificationSender;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class AccountVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_register_with_whatsapp_verification(): void
    {
        $this->mock(WhatsAppVerificationSender::class, function ($mock) {
            $mock->shouldReceive('send')
                ->once()
                ->with(
                    Mockery::on(fn (User $user) => $user->phone === '+15550101234'),
                    Mockery::type('string')
                );
        });

        $response = $this->post('/register', [
            'business_name' => 'Test Cafe',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'verification_method' => 'whatsapp',
            'phone' => '+15550101234',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => '1',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'phone' => '+15550101234',
            'verification_method' => 'whatsapp',
            'account_verified_at' => null,
        ]);
    }

    public function test_unverified_owner_can_access_dashboard_and_sees_notification(): void
    {
        $owner = User::factory()->owner()->unverified()->create([
            'verification_method' => 'email',
        ]);

        $this->actingAs($owner)
            ->get('/owner/dashboard')
            ->assertOk()
            ->assertSeeText('Your account is not verified yet.')
            ->assertSeeText('Verify your account');
    }

    public function test_owner_can_verify_account_with_code(): void
    {
        $owner = User::factory()->owner()->unverified()->create([
            'verification_method' => 'email',
            'verification_code_hash' => Hash::make('123456'),
            'verification_code_expires_at' => now()->addMinutes(10),
            'verification_code_sent_at' => now(),
        ]);

        $response = $this->actingAs($owner)
            ->post(route('owner.account-verification.verify'), [
                'code' => '123456',
            ]);

        $response
            ->assertRedirect(route('owner.dashboard'))
            ->assertSessionHas('status', 'account-verified');

        $owner->refresh();

        $this->assertNotNull($owner->account_verified_at);
        $this->assertNotNull($owner->email_verified_at);
        $this->assertNull($owner->verification_code_hash);
    }
}
