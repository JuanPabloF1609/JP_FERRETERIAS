<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Registra tus policies aquí si las usas
            User::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Definir gates (permisos)
        Gate::define('view_users', function (User $user) {
            return $user->hasRole('Administrador');
        });

        Gate::define('edit_users', function (User $user) {
            return $user->hasRole('Administrador');
        });
        
        // Agrega más gates según necesites
    }
}