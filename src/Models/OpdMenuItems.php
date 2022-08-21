<?php

namespace Wakatobi\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class OpdMenuItems extends Model
{

    protected $connection = 'opd';  
    protected $table = null;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id'];

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->connection = config('opdmenu.connection_name');
        $this->table = config('opdmenu.table_prefix') . config('opdmenu.table_name_items');
    }

    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }
    public function getall($id)
    {
        return $this->where("menu", $id)->orderBy("sort", "asc")->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu', $menu)->max('sort') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo('Wakatobi\Menu\Models\OpdMenus', 'menu');
    }

    public function child()
    {
        return $this->hasMany('Wakatobi\Menu\Models\OpdMenuItems', 'parent')->orderBy('sort', 'ASC');
    }
}
