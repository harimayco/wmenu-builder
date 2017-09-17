<?php
namespace Harimayco\Menu;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Harimayco\Menu\Models\Menu;
use Harimayco\Menu\Models\MenuItem;

class WMenu
{

	public function render(){
		$menu = new Menu();
		$menuitems = new MenuItem();
		$menulist = $menu->select(['id', 'name'])->get();
		$menulist = $menulist->pluck('name', 'id')->prepend('Select menu', 0)-> all();

		//$menulist[0] = "Select menu";
		if ( (request()->has("action")  && empty(request()->input("menu"))) || request()->input("menu") == '0' ) {
			return view('vendor.harimayco-menu.menu') -> with("menulist", $menulist);
		} else {

			$menu = Menu::find(request()->input("menu"));
			$menus = $menuitems -> getall(request()->input("menu"));

			$data = [ 'menus' => $menus, 'indmenu' => $menu, 'menulist' => $menulist ];
			//\Debugbar::info();
			return view('vendor.harimayco-menu.menu-html', $data);
		}

	}

	public function scripts(){
		return view('vendor.harimayco-menu.scripts');
	}

	public function select($name="menu", $menulist = array()){
		$html = '<select name="'.$name.'">';

		foreach($menulist as $key => $val){
			$active = '';
			if(request()->input('menu') == $key){
				$active = 'selected="selected"';
			}
			$html .= '<option '.$active.' value="'.$key.'">'.$val.'</option>';
		}
		$html .= '</select>';
		return $html;
	}
}