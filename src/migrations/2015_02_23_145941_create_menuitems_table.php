<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menuitems', function(Blueprint $table)
		{
		  $table->increments('id');
		  $table->string('label', 255);	
		  $table->string('link', 255);	
		  $table->string('parent', 255);	
		  $table->integer('sort');	
		  $table->string('class', 255);	
		  $table->integer('menu');	
		  $table->integer('depth');	
    	$table->timestamps();
		});
		
		Schema::table('menus', function(Blueprint $table)
		{
		  $table->increments('id');
		  $table->string('name', 255);	
    	  $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('authors', function(Blueprint $table)
		{
			//
		});
	}

}
