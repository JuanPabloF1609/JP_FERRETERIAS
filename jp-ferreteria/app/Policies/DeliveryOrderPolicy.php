<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OrdenEntrega;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryOrderPolicy
{
    use HandlesAuthorization;

    public function view(User $authUser, OrdenEntrega $order): bool
    {
        return $authUser->can('view_delivery_order');
    }

    public function create(User $authUser): bool
    {
        return $authUser->can('create_delivery_order');
    }

    public function edit(User $authUser, OrdenEntrega $order): bool
    {
        return $authUser->can('edit_delivery_order');
    }

    public function disable(User $authUser, OrdenEntrega $order): bool
    {
        return $authUser->can('disable_delivery_order');
    }
}