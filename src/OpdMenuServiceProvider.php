<?php

namespace Wakatobi\Menu;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class OpdMenuServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__ . '/Views', 'opdmenu');

        $this->publishes([
            __DIR__ . '/../config/opdmenu.php'  => config_path('opdmenu.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/Views'   => resource_path('views/vendor/opdmenu'),
        ], 'view');

        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/wakatobi-menu'),
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
        $this->app->bind('wakatobi-menu', function () {
            return new OpdMenu();
        });

        $this->app->make('Wakatobi\Menu\Controllers\OpdMenuController');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/opdmenu.php',
            'opdmenu'
        );
    }
}
