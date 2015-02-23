<?php

class WmenuController extends BaseController {

	public function wmenuindex() {
		$menuitems = new MenuItem();
		$menulist = Menu::lists("name", "id");
		$menulist[0] = "Select menu";
		if (Input::has("action")) {
			return View::make('wmenu::wmenuindex') -> with("menulist", $menulist);
		} else {

			$menu = Menu::find(Input::get("menu"));
			$menus = $menuitems -> getall(Input::get("menu"));

			return View::make('wmenu::wmenuindex') -> with("menus", $menus) -> with("indmenu", $menu) -> with("menulist", $menulist);

		}

	}

	public function createnewmenu() {

		$menu = new Menu();
		$menu -> name = Input::get("menuname");
		$menu -> save();
		return json_encode(array("resp" => $menu -> id));
	}

	public function deleteitemmenu() {
		$menuitem = MenuItem::find(Input::get("id"));

		$menuitem -> delete();
	}

	public function deletemenug() {
		$menus = new MenuItem();
		$getall = $menus -> getall(Input::get("id"));
		if (count($getall) == 0) {
			$menudelete = Menu::find(Input::get("id"));
			$menudelete -> delete();

			return json_encode(array("resp" => "you delete this item"));
		} else {
			return json_encode(array("resp" => "You have to delete all items first", "error" => 1));

		}
	}

	public function updateitem() {

		$menuitem = MenuItem::find(Input::get("id"));
		$menuitem -> label = Input::get("label");
		$menuitem -> link = Input::get("url");
		$menuitem -> class = Input::get("clases");
		$menuitem -> save();
	}

	public function addcustommenu() {

		$menuitem = new MenuItem();
		$menuitem -> label = Input::get("labelmenu");
		$menuitem -> link = Input::get("linkmenu");
		$menuitem -> menu = Input::get("idmenu");
		$menuitem -> save();

	}

	public function generatemenucontrol() {
		$menu = Menu::find(Input::get("idmenu"));
		$menu -> name = Input::get("menuname");
		$menu -> save();
		foreach (Input::get("arraydata") as $value) {

			$menuitem = MenuItem::find($value["id"]);
			$menuitem -> parent = $value["parent"];
			$menuitem -> sort = $value["sort"];
			$menuitem -> depth = $value["depth"];
			$menuitem -> save();
		}
		echo json_encode(array("resp" => 1));

	}

}
