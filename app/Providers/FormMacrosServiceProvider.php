<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormMacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        require base_path() . '/resources/macros/FormMacros.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
