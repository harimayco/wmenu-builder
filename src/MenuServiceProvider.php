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
        if (!$this->app->routesAreCached()) {
            require  __DIR__ . '/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/Views', 'wmenu');

        $this->publishes([
            __DIR__ . '/../config/menu.php'  => config_path('menu.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/Views'   => resource_path('views/vendor/wmenu'),
        ], 'view');

        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/harimayco-menu'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../migrations/2017_08_11_073824_create_menus_wp_table.php' => database_path('migrations/2017_08_11_073824_create_menus_wp_table.php'),
            __DIR__ . '/../migrations/2017_08_11_074006_create_menu_items_wp_table.php' => database_path('migrations/2017_08_11_074006_create_menu_items_wp_table.php'),
            __DIR__ . '/../migrations/2019_01_05_293551_add-role-id-to-menu-items-table.php' => database_path('2019_01_05_293551_add-role-id-to-menu-items-table.php'),
        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('harimayco-menu', function () {
            return new WMenu();
        });

        $this->app->make('Harimayco\Menu\Controllers\MenuController');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/menu.php',
            'menu'
        );
    }
}
