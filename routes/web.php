<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/register',[
    "uses"=>'Auth\RegisterController@index',
    "as"=>"register"
]);

Route::post('/register',[
    "uses"=>'Auth\RegisterController@registeruser',
    "as"=>"register"
]);

Route::get('/login', [
    'uses' => 'Auth\LoginController@index',
    'as' => 'login'
]);

Route::post('/login',[
    "uses"=>'Auth\LoginController@login',
    'as'=>'login.post'
]);

Route::get('/home',[
   'uses'=>'HomeController@index',
   'as'=>'home',
]);

Route::post('/logout',[
    "uses"=>'Auth\LoginController@logout',
    "as"=>"logout",
]);

Route::get('/database/menu',[
    "uses" => 'MenuController@index',
    "as"=>"database.menu",
]);

Route::group(['prefix' => '/database/user'], function(){
    
    Route::get('/',[
        "uses" => 'UserController@index',
        "as"=>"database.user",
    ]);

    Route::get('/add',[
        "uses" => 'UserController@create',
        "as"=>"database.add",
    ]);

    Route::get('/edit/{id}',[
        "uses" => 'UserController@edit',
        "as"=>"database.edit",
    ]);

    Route::post('/update/{id}',[
        "uses" => 'UserController@update',
        "as"=>"database.update",
    ]);

    Route::post('/store',[
        "uses" => 'UserController@store',
        "as"=>"database.store",
    ]);

    Route::get('/get_datatable',[
        "uses" => 'UserController@get_datatable',
        "as"=>"database.user.dt",
    ]);

    Route::get('/delete/{id}',[
        "uses" => 'UserController@destroy',
        "as"=>"database.delete",
    ]);

});

Route::group(['prefix' => '/database/menu'], function(){
    
    Route::get('/',[
        "uses" => 'MenuController@index',
        "as"=>"database.menu",
    ]);

    Route::get('/add',[
        "uses" => 'MenuController@create',
        "as"=>"menu.add",
    ]);

    Route::get('/edit/{id}',[
        "uses" => 'MenuController@edit',
        "as"=>"menu.edit",
    ]);

    Route::post('/update/{id}',[
        "uses" => 'MenuController@update',
        "as"=>"menu.update",
    ]);

    Route::post('/store',[
        "uses" => 'MenuController@store',
        "as"=>"menu.store",
    ]);

    Route::get('/get_datatable',[
        "uses" => 'MenuController@get_datatable',
        "as"=>"menu.user.dt",
    ]);

    Route::get('/delete/{id}',[
        "uses" => 'MenuController@destroy',
        "as"=>"menu.delete",
    ]);

});


Route::group(['prefix' => '/database/order'], function(){
    
    Route::get('/',[
        "uses" => 'OrderController@index',
        "as"=>"database.order.index",
    ]);

    Route::get('/fetch_data',[
        "uses" => 'OrderController@fetch_data',
        "as"=>"database.order.fetch_data",
    ]);

    Route::post('/delete',[
        "uses" => 'OrderController@destroy',
        "as"=>"database.order.delete",
    ]);

});



