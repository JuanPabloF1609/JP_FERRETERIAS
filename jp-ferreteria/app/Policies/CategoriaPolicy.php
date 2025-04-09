<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Categoria;

class CategoriaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_categories');
    }

    public function view(User $user, Categoria $categoria): bool
    {
        return $user->can('view_categories');
    }

    public function create(User $user): bool
    {
        return $user->can('create_categories');
    }

    public function update(User $user, Categoria $categoria): bool
    {
        return $user->can('edit categories');
    }

    public function delete(User $user, Categoria $categoria): bool
    {
        return $user->can('disable_categories');
    }
}