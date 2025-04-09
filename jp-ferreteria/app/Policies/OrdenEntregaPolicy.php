<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrdenEntrega;

class OrdenEntregaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_delivery_order');
    }

    public function view(User $user, OrdenEntrega $ordenEntrega): bool
    {
        return $user->can('view_delivery_order');
    }

    public function create(User $user): bool
    {
        return $user->can('create_delivery_order');
    }

    public function update(User $user, OrdenEntrega $ordenEntrega): bool
    {
        return $user->can('edit_delivery_order');
    }

    public function delete(User $user, OrdenEntrega $ordenEntrega): bool
    {
        return $user->can('disable_delivery_order');
    }
}