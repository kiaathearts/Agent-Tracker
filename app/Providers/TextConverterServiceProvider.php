<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\MessageConverter as MessageConverter;

class TextConverterServiceProvider extends ServiceProvider
{
    protected $defer = true;
    
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
        $this->app->bind('App\Contracts\Message\Conversion', function($app){
            return new MessageConverter();
        });
    }
    
    public function provides(){
        return ['App\Contracts\Message\Conversion'];
    }
}
