<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Producto;

class ProductoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_products');
    }

    public function view(User $user, Producto $producto): bool
    {
        return $user->can('view_products');
    }

    public function create(User $user): bool
    {
        return $user->can('create_products');
    }

    public function update(User $user, Producto $producto): bool
    {
        return $user->can('edit_products');
    }

    public function delete(User $user, Producto $producto): bool
    {
        return $user->can('disable_products');
    }
}