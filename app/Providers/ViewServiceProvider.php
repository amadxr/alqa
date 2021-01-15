<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ArtworkType;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('layouts.app', function ($view) {
            $view->with('artworkTypes', ArtworkType::all());
        });
    }
}
