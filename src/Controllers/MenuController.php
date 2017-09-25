<?php

namespace Harimayco\Menu\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Harimayco\Menu\Models\Menu;
use Harimayco\Menu\Models\MenuItem;

class MenuController extends Controller
{
    
	public function createnewmenu() {

		$menu = new Menu();
		$menu->name = request()->input("menuname");
		$menu->save();
		return json_encode(array("resp" => $menu -> id));
	}

	public function deleteitemmenu() {
		$menuitem = MenuItem::find(request()->input("id"));

		$menuitem -> delete();
	}

	public function deletemenug() {
		$menus = new MenuItem();
		$getall = $menus -> getall(request()->input("id"));
		if (count($getall) == 0) {
			$menudelete = Menu::find(request()->input("id"));
			$menudelete -> delete();

			return json_encode(array("resp" => "you delete this item"));
		} else {
			return json_encode(array("resp" => "You have to delete all items first", "error" => 1));

		}
	}

	public function updateitem() {
		$arraydata = request()->input("arraydata");
		if(is_array($arraydata)){
			foreach ($arraydata as $value) {
				$menuitem = MenuItem::find($value['id']);
				$menuitem->label = $value['label'];
				$menuitem->link = $value['link'];
				$menuitem->class = $value['class'];
				$menuitem->save();
			}
		}else{
			$menuitem = MenuItem::find(request()->input("id"));
			$menuitem->label = request()->input("label");
			$menuitem->link = request()->input("url");
			$menuitem->class = request()->input("clases");
			$menuitem->save();
		}
	}

	public function addcustommenu() {

		$menuitem = new MenuItem();
		$menuitem -> label = request()->input("labelmenu");
		$menuitem -> link = request()->input("linkmenu");
		$menuitem -> menu = request()->input("idmenu");
		$menuitem -> save();

	}

	public function generatemenucontrol() {
		$menu = Menu::find(request()->input("idmenu"));
		$menu -> name = request()->input("menuname");
		$menu -> save();
		if(is_array(request()->input("arraydata"))){
			foreach (request()->input("arraydata") as $value) {

				$menuitem = MenuItem::find($value["id"]);
				$menuitem -> parent = $value["parent"];
				$menuitem -> sort = $value["sort"];
				$menuitem -> depth = $value["depth"];
				$menuitem -> save();
			}
		}
		echo json_encode(array("resp" => 1));

	}
}
