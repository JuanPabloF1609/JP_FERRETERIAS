<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function view(User $authUser, Producto $product): bool
    {
        return $authUser->can('view_products');
    }

    public function create(User $authUser): bool
    {
        return $authUser->can('create_products');
    }

    public function edit(User $authUser, Producto $product): bool
    {
        return $authUser->can('edit_products');
    }

    public function disable(User $authUser, Producto $product): bool
    {
        return $authUser->can('disable_products');
    }
}