<?php

class MenuItem extends Eloquent {

	public function getsons($id) {
		return $this -> where("parent", $id) -> get();
	}

	public function getall($id) {
		return $this -> where("menu", $id) -> orderBy("sort", "asc") -> get();
	}

}
