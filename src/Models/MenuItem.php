<?php

namespace Harimayco\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function getsons($id) {
		return $this -> where("parent", $id) -> get();
	}
	public function getall($id) {
		return $this -> where("menu", $id) -> orderBy("sort", "asc") -> get();
	}
}
