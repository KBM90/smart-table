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
        if (!in_array($user->role?->value, [User::ROLE_OWNER, User::ROLE_WAITER], true)) {
            return false;
        }

        if ($user->tenant_id === null || $user->tenant_id !== $request->tenant_id) {
            return false;
        }

        if ($request->status !== ServiceRequest::STATUS_PENDING) {
            return false;
        }

        // Owners can accept any request for their tenant.
        if ($user->isOwner()) {
            return true;
        }

        // Waiters may only accept requests for tables they are assigned to.
        return $this->waiterIsAssignedToRequest($user, $request);
    }

    public function resolve(User $user, ServiceRequest $request): bool
    {
        if (!in_array($user->role?->value, [User::ROLE_OWNER, User::ROLE_WAITER], true)) {
            return false;
        }

        if ($user->tenant_id === null || $user->tenant_id !== $request->tenant_id) {
            return false;
        }

        if ($request->status !== ServiceRequest::STATUS_ACCEPTED) {
            return false;
        }

        // Owners can resolve any request for their tenant.
        if ($user->isOwner()) {
            return true;
        }

        // Waiters may only resolve requests for tables they are assigned to.
        return $this->waiterIsAssignedToRequest($user, $request);
    }

    /**
     * Check whether the given waiter is assigned to the table that raised the request.
     */
    private function waiterIsAssignedToRequest(User $user, ServiceRequest $request): bool
    {
        // Load the session → table relationship if not already loaded.
        $session = $request->relationLoaded('tableSession')
            ? $request->tableSession
            : $request->tableSession()->withoutGlobalScopes()->first();

        if ($session === null) {
            return false;
        }

        $tableId = $session->table_id;

        return $user->assignedTables()
            ->withoutGlobalScopes()
            ->where('tables.id', $tableId)
            ->exists();
    }
}