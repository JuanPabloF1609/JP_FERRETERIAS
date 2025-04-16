<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view(User $authUser, Categoria $category): bool
    {
        return $authUser->can('view_categories');
    }

    public function create(User $authUser): bool
    {
        return $authUser->can('create_categories');
    }

    public function edit(User $authUser, Categoria $category): bool
    {
        return $authUser->can('edit_categories');
    }

    public function disable(User $authUser, Categoria $category): bool
    {
        return $authUser->can('disable_categories');
    }
}