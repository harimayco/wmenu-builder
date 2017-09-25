<?php

namespace Harimayco\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{

	protected $table = 'menu_items';

	public function __construct( array $attributes = [] ){
    	//parent::construct( $attributes );
    	$this->table = config('menu.table_prefix') . $this->table;
    }

    public function getsons($id) {
		return $this -> where("parent", $id) -> get();
	}
	public function getall($id) {
		return $this -> where("menu", $id) -> orderBy("sort", "asc") -> get();
	}
}
