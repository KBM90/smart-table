<?php

namespace App\Policies;

use App\Models\TableSession;
use App\Models\User;

class TableSessionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->tenant_id !== null;
    }

    public function view(User $user, TableSession $tableSession): bool
    {
        return $user->tenant_id !== null && $user->tenant_id === $tableSession->tenant_id;
    }

    public function close(User $user, TableSession $tableSession): bool
    {
        return $user->isOwner()
            && $user->tenant_id !== null
            && $user->tenant_id === $tableSession->tenant_id
            && $tableSession->isActive();
    }
}