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

Route::get('/categorias','CategoryController@index')->name('category.index');
Route::get('/categorias/create','CategoryController@create')->name('category.create');
Route::post('/categorias','CategoryController@store')->name('category.store');
Route::get('/categorias/{id}/edit','CategoryController@edit')->name('category.edit');
Route::put('/categorias/{id}','CategoryController@update')->name('category.update');
Route::get('/categorias/{id}','CategoryController@delete')->name('category.delete');

Route::get('/productos','ProductController@index')->name('product.index');
Route::get('/productos/create','ProductController@create')->name('product.create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

