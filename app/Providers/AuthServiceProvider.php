<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $allowed = ['superadmin', 'admin'];
        Gate::define('view', function(User $user, $resource) use($allowed) {
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('view', $permissions) || in_array($user->role, $allowed);
        });

        Gate::define('create', function(User $user, $resource) use($allowed) {
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('create', $permissions) || in_array($user->role, $allowed);
        });

        Gate::define('update', function(User $user, $resource) use($allowed) {
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('update', $permissions) || in_array($user->role, $allowed);   
        });

        Gate::define('delete', function(User $user, $resource) use($allowed) {
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('delete', $permissions) || in_array($user->role, $allowed);   
        });

    }
}
