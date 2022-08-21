<?php 
namespace Wakatobi\Menu\Facades;
use Illuminate\Support\Facades\Facade;

class OpdMenu extends Facade {
    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wakatobi-menu';
    }
}