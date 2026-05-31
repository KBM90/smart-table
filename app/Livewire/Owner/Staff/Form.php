<?php

namespace App\Livewire\Owner\Staff;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Form extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->authorize('create', User::class);
    }

    public function save(): void
    {
        $this->authorize('create', User::class);

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required', 'string'],
        ]);

        User::create([
            'tenant_id' => auth()->user()->tenant_id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => UserRole::Waiter->value,
            'email_verified_at' => now(),
        ]);

        $this->reset(['name', 'email', 'password', 'password_confirmation']);

        $this->dispatch('waiter-saved');
    }

    public function render()
    {
        return view('livewire.owner.staff.form');
    }
}