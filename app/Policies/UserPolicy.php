<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, User $staff): bool
    {
        return $user->isOwner() && $user->tenant_id === $staff->tenant_id;
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function delete(User $user, User $staff): bool
    {
        return $user->isOwner()
            && $user->tenant_id === $staff->tenant_id
            && $staff->isWaiter()
            && $user->getKey() !== $staff->getKey();
    }
}