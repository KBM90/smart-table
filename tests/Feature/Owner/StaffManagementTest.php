<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Staff\Form;
use App\Livewire\Owner\Staff\Index;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StaffManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_creates_waiter_with_tenant_role_and_verified_email(): void
    {
        $owner = User::factory()->owner()->create([
            'password' => 'Password123',
        ]);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Ali')
            ->set('email', 'ali@test.com')
            ->set('password', 'Password123')
            ->set('password_confirmation', 'Password123')
            ->call('save')
            ->assertHasNoErrors();

        $waiter = User::where('email', 'ali@test.com')->firstOrFail();

        $this->assertSame($owner->tenant_id, $waiter->tenant_id);
        $this->assertTrue($waiter->isWaiter());
        $this->assertNotNull($waiter->email_verified_at);

        auth()->logout();

        $response = $this->post('/login', [
            'email' => 'ali@test.com',
            'password' => 'Password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->followRedirects($response)->assertSeeText('Waiter');
    }

    public function test_staff_form_validates_missing_fields_weak_password_and_duplicate_email(): void
    {
        $owner = User::factory()->owner()->create();
        User::factory()->waiter($owner->tenant)->create([
            'email' => 'ali@test.com',
        ]);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->call('save')
            ->assertHasErrors(['name', 'email', 'password', 'password_confirmation']);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Ali')
            ->set('email', 'ali@test.com')
            ->set('password', 'short')
            ->set('password_confirmation', 'short')
            ->call('save')
            ->assertHasErrors(['email' => 'unique', 'password']);
    }

    public function test_owner_sees_only_own_tenant_waiters_in_staff_list(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $owner = User::factory()->owner($tenantA)->create();

        User::factory()->waiter($tenantA)->create([
            'name' => 'Ali Tenant A',
            'email' => 'a@test.com',
        ]);
        User::factory()->waiter($tenantB)->create([
            'name' => 'Bassem Tenant B',
            'email' => 'b@test.com',
        ]);

        $this->actingAs($owner)
            ->get('/owner/staff')
            ->assertOk()
            ->assertSeeText('Ali Tenant A')
            ->assertDontSeeText('Bassem Tenant B');
    }

    public function test_owner_cannot_delete_themselves(): void
    {
        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteWaiter', $owner->id)
            ->assertForbidden();

        $this->assertDatabaseHas('users', [
            'id' => $owner->id,
            'deleted_at' => null,
        ]);
    }

    public function test_owner_cannot_delete_waiter_from_another_tenant(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $owner = User::factory()->owner($tenantA)->create();
        $waiter = User::factory()->waiter($tenantB)->create();

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteWaiter', $waiter->id)
            ->assertNotFound();

        $this->assertDatabaseHas('users', [
            'id' => $waiter->id,
            'deleted_at' => null,
        ]);
    }

    public function test_owner_soft_deletes_waiter_and_waiter_cannot_log_in_afterwards(): void
    {
        $owner = User::factory()->owner()->create();
        $waiter = User::factory()->waiter($owner->tenant)->create([
            'email' => 'ali@test.com',
            'password' => 'Password123',
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteWaiter', $waiter->id);

        $this->assertSoftDeleted('users', ['id' => $waiter->id]);

        auth()->logout();

        $this->post('/login', [
            'email' => 'ali@test.com',
            'password' => 'Password123',
        ])->assertSessionHasErrors('email');
    }

    public function test_waiter_cannot_access_owner_staff_page(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/staff')
            ->assertForbidden();
    }
}