<?php

namespace Harimayco\Menu;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom( __DIR__.'/routes.php');

        $this->publishes([
            __DIR__.'/../config/menu.php'  => config_path('menu.php'),
        ], 'config');

        $this->publishes([
           __DIR__.'/Views/menu.blade.php'   => resource_path('views/vendor/harimayco-menu/menu.blade.php'),
        ], 'view');

         $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/harimayco-menu'),
        ], 'public');
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('harimayco-menu', function() {
            return new WMenu();
        });

        $this->app->make('Harimayco\Menu\Controllers\MenuController');
        $this->loadViewsFrom(__DIR__.'/views', 'wmenu');

    }
}
