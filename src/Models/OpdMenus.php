<?php

namespace Wakatobi\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class OpdMenus extends Model
{
    protected $connection = 'opd';
    protected $table = 'menus';

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->connection = config('opdmenu.connection_name');
        $this->table = config('opdmenu.table_prefix') . config('opdmenu.table_name_menus');

    }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    public function items()
    {
        return $this->hasMany('Wakatobi\Menu\Models\OpdMenuItems', 'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    }
}
