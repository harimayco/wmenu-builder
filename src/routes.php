<?php 

Route::get('/wmenuindex', array('as' => 'wmenuindex','uses'=>'WmenuController@wmenuindex'));

Route::post('/addcustommenu', array('as' => 'addcustommenu','uses'=>'WmenuController@addcustommenu'));
Route::post('/deleteitemmenu', array('as' => 'deleteitemmenu','uses'=>'WmenuController@deleteitemmenu'));
Route::post('/deletemenug', array('as' => 'deletemenug','uses'=>'WmenuController@deletemenug'));
Route::post('/createnewmenu', array('as' => 'createnewmenu','uses'=>'WmenuController@createnewmenu'));
Route::post('/generatemenucontrol', array('as' => 'generatemenucontrol','uses'=>'WmenuController@generatemenucontrol'));
Route::post('/updateitem', array('as' => 'updateitem','uses'=>'WmenuController@updateitem'));

   