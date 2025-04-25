<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $authUser, User $user): bool
    {
        return $authUser->can('view_users');
    }

    public function create(User $authUser): bool
    {
        return $authUser->can('create_users');
    }

    public function edit(User $authUser, User $user): bool
    {
        return $authUser->can('edit_users');
    }

    public function disable(User $authUser, User $user): bool
    {
        return $authUser->can('disable_users');
    }
}