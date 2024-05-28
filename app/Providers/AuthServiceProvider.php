<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // protected $policies = [
    //     'App\Models\User' => 'App\Policies\AdminPolicy'
    // ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('adminAndStaff', function (User $user) {
            return $user->isAdmin() || $user->isStaff();
        });

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
