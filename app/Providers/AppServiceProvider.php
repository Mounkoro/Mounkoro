<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('is-client', function (User $user) {
            return $user->role === 'client';
        });

        Gate::define('is-engineer', function (User $user) {
            return $user->role === 'engineer';
        });
    }
}
