<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthItemProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('authItem', function(){
            return new \App\AuthItem();
        });
    }
}
