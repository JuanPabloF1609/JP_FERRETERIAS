<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Factura;

class FacturaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_bill');
    }

    public function view(User $user, Factura $factura): bool
    {
        return $user->can('view_bill');
    }

    public function create(User $user): bool
    {
        return $user->can('create_bill');
    }

    public function update(User $user, Factura $factura): bool
    {
        return $user->can('edit_bill');
    }

    public function delete(User $user, Factura $factura): bool
    {
        return $user->can('disable_bill');
    }
}