<?php

namespace App\Policies;

use App\Models\ProductCategory;
use App\Models\User;

class ProductCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isOwner();
    }

    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    public function view(User $user, ProductCategory $category): bool
    {
        return $user->isOwner() && $user->tenant_id === $category->tenant_id;
    }

    public function update(User $user, ProductCategory $category): bool
    {
        return $user->isOwner() && $user->tenant_id === $category->tenant_id;
    }

    public function delete(User $user, ProductCategory $category): bool
    {
        return $user->isOwner() && $user->tenant_id === $category->tenant_id;
    }
}
