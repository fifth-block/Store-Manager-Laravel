<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array("before"=>"loggedOut"), function(){
	Route::get('/', function(){
		return View::make('login');
	});
	Route::post('/', array("uses"=>"UserController@login", "as"=>"user.login"));
});

Route::group(array("before"=>"loggedIn"), function(){
	
	Route::get('/dashboard', array("uses"=>"DashboardController@index", "as"=>"dashboard.index"));
	Route::get('/dashboard/settings', array("uses"=>"DashboardController@settings", "as"=>"dashboard.settings"));

	Route::post('/dashboard/settings', array("uses"=>"DashboardController@changePassword", "as"=>"dashboard.changePassword"));

	Route::get('/store', array("uses"=>"DrugsController@index", "as"=>"store.index"));
	Route::get('/store/create', array("uses"=>"DrugsController@create", "as"=>"store.create"));
	Route::post('/store/create', array("uses"=>"DrugsController@store", "as"=>"store.store"));
	Route::get('/store/details/{medicine_name}', array("uses" => "DrugsController@details", "as" => "store.details"));
	Route::get('/store/update/{id}', array("uses" => "DrugsController@edit", "as" => "store.edit"));
	Route::post('/store/update/{id}', array("uses" => "DrugsController@update", "as" => "store.update"));
	Route::delete('/store/delete/{id}', array("uses" => "DrugsController@delete", "as" => "store.delete"));



	Route::get('/sell/', array("uses" => "SellController@index", 'as' => 'sell.index'));
	Route::get('/sell/{id}', array("uses" => "SellController@toBag", 'as' => 'sell.toBag'));
	Route::post('/sell/{id}', array("uses" => "SellController@addToBag", 'as' => 'sell.addToBag'));
	Route::get('/bag/', array("uses" => "SellController@showBag", 'as' => 'sell.showBag'));


	Route::post('/bag/empty', array("uses" => "SellController@emptyBag", 'as' => 'sell.emptyBag'));

	Route::get('/invoice/', array("uses" => "SellController@invoice", 'as' => 'invoice.index'));
	Route::get('/invoice/{id}', array("uses" => "SellController@invoiceShow", 'as' => 'invoice.show'));
	Route::post('/invoice/{id}', array("uses" => "SellController@changeStat", 'as' => 'invoice.changeStat'));

	Route::post('/invoice', array("uses" => "SellController@createInvoice", 'as' => 'invoice.create'));
	Route::delete('/invoice/{id}', array("uses" => "SellController@destroyInvoice", 'as' => 'invoice.destroy'));



Route::get('/report/date', array("uses" => "ReportController@index", "as" => "report.index"));
Route::get('/report/monthly', array("uses" => "ReportController@monthly", "as" => "report.monthly"));
Route::get('/report/yearly', array("uses" => "ReportController@yearly", "as" => "report.yearly"));
Route::get('/report/range', array("uses" => "ReportController@range", "as" => "report.range"));

	Route::get('/logout', array("uses"=>"UserController@logout", "as"=>"user.logout"));



});
Route::get('/get/companies.json' ,array("uses" => "AjaxController@companies", "as" => "ajax.get.companies"));

Event::listen("illuminate.query", function($query, $bindings, $time, $name){
    echo "<script>console.log('".$query."');</script>";
});