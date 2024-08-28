<?php

namespace App\Providers;

use App\Models\User;

use App\Models\Genre;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        //
        if (Schema::hasTable('genres')) {
            view()->share('genres', Genre::all());
            Paginator::useBootstrap();
        }

        Gate::define('manage_users', function (User $user) {
            return $user->is_admin == 2;
        });
    }
}
