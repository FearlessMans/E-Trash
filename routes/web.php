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

Route::get('/shop',['as' => 'user.product', 'uses' => 'PageController@showProduct']);

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
        Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
        Route::get('product', ['as' => 'pages.product', 'uses' => 'PageController@product']);
        Route::post('/product/add', ['as' => 'post.product', 'uses' => 'ProductsController@store']);
        Route::delete('/product/delete/{id}', ['as' => 'delete.product', 'uses' => 'ProductsController@destroy']);


});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

