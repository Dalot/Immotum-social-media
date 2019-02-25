<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\API\InstantFans;

class InstantFansServiceProvider extends ServiceProvider
{
    
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        \App::bind('App\API\InstantFans', function(){
            return new \App\API\InstantFans( config('services.instant-fans.key') );
        });
    }
    
    
    
  
}
