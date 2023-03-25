<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\RequestHandle;

class FormRequestHandlerServiceProvider extends ServiceProvider
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
        $this->app->bind('formRequestHandle', function(){
           return new RequestHandle(); 
        });
    }
}
