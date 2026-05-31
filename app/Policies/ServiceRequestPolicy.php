<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->tenant_id !== null;
    }

    public function view(User $user, ServiceRequest $request): bool
    {
        return $user->tenant_id !== null && $user->tenant_id === $request->tenant_id;
    }

    public function accept(User $user, ServiceRequest $request): bool
    {
        return in_array($user->role?->value, [User::ROLE_OWNER, User::ROLE_WAITER], true)
            && $user->tenant_id !== null
            && $user->tenant_id === $request->tenant_id
            && $request->status === ServiceRequest::STATUS_PENDING;
    }

    public function resolve(User $user, ServiceRequest $request): bool
    {
        return in_array($user->role?->value, [User::ROLE_OWNER, User::ROLE_WAITER], true)
            && $user->tenant_id !== null
            && $user->tenant_id === $request->tenant_id
            && $request->status === ServiceRequest::STATUS_ACCEPTED;
    }
}