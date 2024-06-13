<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\AdministrativePolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\Movie;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;


class AppServiceProvider extends ServiceProvider
{


    protected $policies = [
        User::class => UserPolicy::class,
    ];


    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    { 
        Gate::policy(User::class, UserPolicy::class);

        Gate::policy(User::class, AdministrativePolicy::class);

        Gate::define('use-cart', function (?User $user) {
            return true;
        });

        Gate::define('confirm-cart', function (User $user) {
            return true;
        });

        Gate::define('edit-settings', function ($user) {
            return $user->isAdmin();
        });

    }
}
