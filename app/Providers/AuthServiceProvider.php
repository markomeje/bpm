<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\{Blog, User};
use App\Policies\{BlogPolicy, PaymentPolicy};

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
        Payment::class => PaymentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view', function(User $user, $resource) {
            $permissions = [];
            if ($user->permissions()->exists()) {
                foreach ($user->permissions as $access) {
                    if ($resource == $access->resource) {
                        $permissions[] = $access->permission;
                    }
                }
            }

            return in_array('view', $permissions) || in_array($user->role, ['superadmin']);
                
        });
    }
}
