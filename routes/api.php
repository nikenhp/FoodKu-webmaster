<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/view","API\ApiLoginController@viewAll");
Route::post("/create","API\ApiLoginController@create");
Route::put("/update/{id}","API\ApiLoginController@update");
Route::delete("/delete/{id}","API\ApiLoginController@delete");
Route::post('/login','API\ApiLoginController@login');

Route::get('/get_menu_all', 'API\ApiController@get_menu_all');
Route::get('/get_order_all', 'API\ApiController@get_order_all');
Route::get('/get_menu_where', 'API\ApiController@get_menu_where');
Route::post('/create_order', 'API\ApiController@create_order');
Route::post('/add_menu_to_order', 'API\ApiController@add_menu_to_order');