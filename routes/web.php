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
Route::get('/productos/{id}/del','ProductController@delete')->name('product.delete');
Route::get('/productos/{id}/restaurar','ProductController@restore')->name('product.restore');

Route::get('/entradas','EntryController@index')->name('entry.index');
Route::get('/entradas/create','EntryController@create')->name('entry.create');
Route::post('/entradas','EntryController@store')->name('entry.store');
Route::get('/entradas/{id}','EntryController@show')->name('entry.show');
Route::get('/entradas/{id}/del','EntryController@delete')->name('entry.delete');

Route::get('/solicitudes','RequestController@index')->name('request.index');
Route::get('/solicitudes/create','RequestController@create')->name('request.create');
Route::post('/solicitudes','RequestController@store')->name('request.store');
Route::get('/solicitudes/{id}','RequestController@show')->name('request.show');
Route::get('/solicitudes/{id}/del','RequestController@delete')->name('request.delete');

Route::get('/aprobaciones','ApproveController@index')->name('approve.index');
Route::get('/aprobaciones/{id}','ApproveController@show')->name('approve.show');
Route::get('/aprobaciones/{id}/editar','ApproveController@edit')->name('approve.edit');
Route::put('/aprobaciones/{id}','ApproveController@update')->name('approve.update');
Route::get('/aprobaciones/{id}/del','ApproveController@delete')->name('approve.delete');

Route::get('/entregas','DeliverController@index')->name('deliver.index');
Route::get('/entregas/{id}/editar','DeliverController@edit')->name('deliver.edit');
Route::put('/entregas/{id}','DeliverController@update')->name('deliver.update');

Route::get('/seguimiento-solicitudes','TracingRequestController@index')->name('trequest.index');
Route::get('/seguimiento-solicitudes/{id}','TracingRequestController@show')->name('trequest.show');

Route::get('/seguimiento-aprobados','TracingApproveController@index')->name('tapprove.index');
Route::get('/seguimiento-aprobados/{id}','TracingApproveController@show')->name('tapprove.show');

Route::get('/seguimiento-entregados','TracingDeliverController@index')->name('tdeliver.index');
Route::get('/seguimiento-entregados/{id}','TracingDeliverController@show')->name('tdeliver.show');
Route::get('/seguimiento-entregado/{id}/editar','TracingDeliverController@edit')->name('tdeliver.edit');
Route::put('/seguimiento-entregado//{id}','TracingDeliverController@update')->name('tdeliver.update');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


