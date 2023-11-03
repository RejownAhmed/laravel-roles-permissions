<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // Gate permissions
        foreach ($this->getPermissions() as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                return $user->isAdmin() ?: $user->hasRole($permission->roles);

            });

        }

    }

    //Get all permissions with roles from Database
    protected function getPermissions(): Collection
    {
        return Permission::with('roles')->get();
    }
}
