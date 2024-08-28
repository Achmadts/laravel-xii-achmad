<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\FilmRepoistoryInterface;
use App\Repositories\FilmRepository;

class FilmServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FilmRepoistoryInterface::class, FilmRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
