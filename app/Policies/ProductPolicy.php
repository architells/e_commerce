<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user)
    {
        return $user->roles->contains('role_name', 'Admin');
    }

    public function create(User $user)
    {
        return $user->roles->contains('role_name', 'Admin');
    }

    public function update(User $user, Product $product)
    {
        return $user->roles->contains('role_name', 'Admin');
    }

    public function delete(User $user, Product $product)
    {
        return $user->roles->contains('role_name', 'Admin');
    }
}
