<?php

Route::group(['middleware' => config('menu.middleware')], function () {
	//Route::get('wmenuindex', array('uses'=>'\Harimayco\Menu\Controllers\MenuController@wmenuindex'));
	Route::post('harimayco/addcustommenu', array( 'as' => 'haddcustommenu', 'uses'=>'\Harimayco\Menu\Controllers\MenuController@addcustommenu'));
	Route::post('harimayco/deleteitemmenu', array('as' => 'hdeleteitemmenu', 'uses'=>'\Harimayco\Menu\Controllers\MenuController@deleteitemmenu'));
	Route::post('harimayco/deletemenug', array('as' => 'hdeletemenug', 'uses'=>'\Harimayco\Menu\Controllers\MenuController@deletemenug'));
	Route::post('harimayco/createnewmenu', array('as' => 'hcreatenewmenu', 'uses'=>'\Harimayco\Menu\Controllers\MenuController@createnewmenu'));
	Route::post('harimayco/generatemenucontrol', array('as' => 'hgeneratemenucontrol', 'uses'=>'\Harimayco\Menu\Controllers\MenuController@generatemenucontrol'));
	Route::post('harimayco/updateitem', array('as' => 'hupdateitem', 'uses'=>'\Harimayco\Menu\Controllers\MenuController@updateitem'));
});
