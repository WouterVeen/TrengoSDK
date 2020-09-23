<?php

namespace Solvari\Trengo;

use Illuminate\Support\ServiceProvider;

class TrengoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/config/trengo.php' => config_path('trengo.php')
        ], 'config');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make('Solvari\Trengo\TrengoApiController');
    }
}
