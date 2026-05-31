<?php

namespace App\Policies;

use App\Models\Table;
use App\Models\User;

class TablePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, Table $table): bool
    {
        return $user->isOwner() && $user->tenant_id === $table->tenant_id;
    }

    public function update(User $user, Table $table): bool
    {
        return $user->isOwner() && $user->tenant_id === $table->tenant_id;
    }

    public function delete(User $user, Table $table): bool
    {
        return $user->isOwner() && $user->tenant_id === $table->tenant_id;
    }
}
