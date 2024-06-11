<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\AdministrativePolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\Movie;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
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
        Gate::policy(User::class, AdministrativePolicy::class);

        Gate::define('use-cart', function (?User $user) {
            return true;
        });

        Gate::define('confirm-cart', function (User $user) {
            return true;
        });

        // Gate::define('admin', function (User $user) {
        //     // Only "administrator" users can "admin"
        //     return $user->admin;
        // });

    }
}
