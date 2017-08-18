<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( config('menu.table_prefix') . 'menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('link');
            $table->integer('parent')->unsigned()->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->integer('menu')->unsigned();
            $table->integer('depth')->default(0);
            $table->timestamps();

            $table->foreign('menu')->references('id')->on(config('menu.table_prefix') . 'menus')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( config('menu.table_prefix') . 'menu_items');
    }
}
