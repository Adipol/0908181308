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
Route::post('/productos','ProductController@store')->name('product.store');
Route::get('/productos/add','ProductController@add')->name('product.add');
Route::post('/productos/storep','ProductController@storep')->name('product.storep');
Route::get('/productos/{id}','ProductController@show')->name('product.show');
Route::get('/productos/{id}/edit','ProductController@edit')->name('product.edit');
Route::put('/productos/{id}','ProductController@update')->name('product.update');

Route::get('/entradas','EntryController@index')->name('entry.index');
Route::get('/entradas/create','EntryController@create')->name('entry.create');
Route::post('/entradas','EntryController@store')->name('entry.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
