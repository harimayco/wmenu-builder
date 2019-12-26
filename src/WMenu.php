<?php

namespace Harimayco\Menu;

use App\Http\Requests;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use Illuminate\Support\Facades\DB;

class WMenu
{

    public function render()
    {
        $menu = new Menus();
        $menuitems = new MenuItems();
        $menulist = $menu->select(['id', 'name'])->get();
        $menulist = $menulist->pluck('name', 'id')->prepend('Select menu', 0)->all();

        //$roles = Role::all();

        if ((request()->has("action") && empty(request()->input("menu"))) || request()->input("menu") == '0') {
            return view('wmenu::menu-html')->with("menulist" , $menulist);
        } else {

            $menu = Menus::find(request()->input("menu"));
            $menus = $menuitems->getall(request()->input("menu"));

            $data = ['menus' => $menus, 'indmenu' => $menu, 'menulist' => $menulist];
            if( config('menu.use_roles')) {
                $data['roles'] = DB::table(config('menu.roles_table'))->select([config('menu.roles_pk'),config('menu.roles_title_field')])->get();
                $data['role_pk'] = config('menu.roles_pk');
                $data['role_title_field'] = config('menu.roles_title_field');
            }
            return view('wmenu::menu-html', $data);
        }

    }

    public function scripts()
    {
        return view('wmenu::scripts');
    }

    public function select($name = "menu", $menulist = array())
    {
        $html = '<select name="' . $name . '">';

        foreach ($menulist as $key => $val) {
            $active = '';
            if (request()->input('menu') == $key) {
                $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }


    /**
     * Returns empty array if menu not found now.
     * Thanks @sovichet
     *
     * @param $name
     * @return array
     */
    public static function getByName($name)
    {
        $menu = Menus::byName($name);
        return is_null($menu) ? [] : self::get($menu->id);
    }

    public static function get($menu_id)
    {
        $menuItem = new MenuItems;
        $menu_list = $menuItem->getall($menu_id);

        $roots = $menu_list->where('menu', (integer) $menu_id)->where('parent', 0);

        $items = self::tree($roots, $menu_list);
        return $items;
    }

    private static function tree($items, $all_items)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $all_items->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
                $data_arr[$i]['child'] = self::tree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }

}
