<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Factura;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPolicy
{
    use HandlesAuthorization;

    public function view(User $authUser, Factura $bill): bool
    {
        return $authUser->can('view_bill');
    }

    public function create(User $authUser): bool
    {
        return $authUser->can('create_bill');
    }

    public function edit(User $authUser, Factura $bill): bool
    {
        return $authUser->can('edit_bill');
    }

    public function disable(User $authUser, Factura $bill): bool
    {
        return $authUser->can('disable_bill');
    }
}