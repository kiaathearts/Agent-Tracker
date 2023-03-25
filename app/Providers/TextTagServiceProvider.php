<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\TableTextTag;

class TextTagServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Contracts\Message\TextTag', function($app){
            return new TableTextTag();
        });
    }
    
    public function provides(){
        return ['App\Contracts\Message\TextTag'];
    }
}
