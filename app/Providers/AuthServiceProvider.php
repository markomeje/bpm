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

        Gate::define('view', function(User $user, $resource) {
<<<<<<< HEAD
            $permissions = [];
            if ($user->permissions()->exists()) {
                foreach ($user->permissions as $access) {
                    if ($resource == $access->resource) {
                        $permissions[] = $access->permission;
                    }
                }
            }

            return in_array('view', $permissions) || in_array($user->role, ['superadmin']);
                
=======
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('view', $permissions) || in_array($user->role, ['superadmin']);
>>>>>>> af4fe280f16f519ec766c71f2118baac453e608c
        });

        Gate::define('create', function(User $user, $resource) {
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('create', $permissions) || in_array($user->role, ['superadmin']);
        });

        Gate::define('update', function(User $user, $resource) {
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('update', $permissions) || in_array($user->role, ['superadmin']);   
        });

        Gate::define('delete', function(User $user, $resource) {
            $permissions = \App\Helpers\Permissions::get($user, $resource);
            return in_array('delete', $permissions) || in_array($user->role, ['superadmin']);   
        });

    }
}
