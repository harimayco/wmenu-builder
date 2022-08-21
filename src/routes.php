<?php

Route::group(['middleware' => config('opdmenu.middleware')], function () {
    //Route::get('wmenuindex', array('uses'=>'\Wakatobi\Menu\Controllers\OpdMenuController@wmenuindex'));
    $path = rtrim(config('opdmenu.route_path'));
    Route::post($path . '/opdaddcustommenu', array('as' => 'opdhaddcustommenu', 'uses' => '\Wakatobi\Menu\Controllers\OpdMenuController@opdaddcustommenu'));
    Route::post($path . '/opddeleteitemmenu', array('as' => 'opdhdeleteitemmenu', 'uses' => '\Wakatobi\Menu\Controllers\OpdMenuController@opddeleteitemmenu'));
    Route::post($path . '/opddeletemenug', array('as' => 'opdhdeletemenug', 'uses' => '\Wakatobi\Menu\Controllers\OpdMenuController@opddeletemenug'));
    Route::post($path . '/opdcreatenewmenu', array('as' => 'opdhcreatenewmenu', 'uses' => '\Wakatobi\Menu\Controllers\OpdMenuController@opdcreatenewmenu'));
    Route::post($path . '/opdgeneratemenucontrol', array('as' => 'opdhgeneratemenucontrol', 'uses' => '\Wakatobi\Menu\Controllers\OpdMenuController@opdgeneratemenucontrol'));
    Route::post($path . '/opdupdateitem', array('as' => 'opdhupdateitem', 'uses' => '\Wakatobi\Menu\Controllers\OpdMenuController@opdupdateitem'));
});
