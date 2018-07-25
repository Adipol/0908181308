<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home'); 

    Route::group(['middleware' => ['admin']], function () {

        Route::get('/almacenes','Admin\WarehouseController@index')->name('warehouse.index');
        Route::get('/almacenes/crear','Admin\WarehouseController@create')->name('warehouse.create');
        Route::post('/almacenes','Admin\WarehouseController@store')->name('warehouse.store');
        Route::get('/almacenes/{id}/editar','Admin\WarehouseController@edit')->name('warehouse.edit');
        Route::put('/almacenes/{id}','Admin\WarehouseController@update')->name('warehouse.update');
        Route::get('/almacenes/{id}/del','Admin\WarehouseController@delete')->name('warehouse.delete');
        Route::get('/almacenes/{id}/restaurar','Admin\WarehouseController@restore')->name('warehouse.restore');

        Route::get('/medicion','Admin\UnityController@index')->name('unity.index');
        Route::get('/medicion/crear','Admin\UnityController@create')->name('unity.create');
        Route::post('/medicion','Admin\UnityController@store')->name('unity.store');
        Route::get('/medicion/{id}/editar','Admin\UnityController@edit')->name('unity.edit');
        Route::put('/medicion/{id}','Admin\UnityController@update')->name('unity.update');
        Route::get('/medicion/{id}/del','Admin\UnityController@delete')->name('unity.delete');
        Route::get('/medicion/{id}/restaurar','Admin\UnityController@restore')->name('unity.restore');

        Route::get('/justificaciones','Admin\JustificationController@index')->name('justification.index');
        Route::get('/justificaciones/crear','Admin\JustificationController@create')->name('justification.create');
        Route::post('/justificaciones','Admin\JustificationController@store')->name('justification.store');
        Route::get('/justificaciones/{id}/editar','Admin\JustificationController@edit')->name('justification.edit');
        Route::put('/justificaciones/{id}','Admin\JustificationController@update')->name('justification.update');
        Route::get('/justificaciones/{id}/del','Admin\JustificationController@delete')->name('justification.delete');
        Route::get('/justificaciones/{id}/restaurar','Admin\JustificationController@restore')->name('justification.restore');

        Route::get('/usuarios','Admin\UserController@index')->name('user.index');
        Route::get('/usuarios/crear','Admin\UserController@create')->name('user.create');
        Route::post('/usuarios','Admin\UserController@store')->name('user.store');
        Route::get('/usuarios/{id}/editar','Admin\UserController@edit')->name('user.edit');
        Route::put('/usuarios/{id}','Admin\UserController@update')->name('user.update');
        Route::get('/usuarios/{id}/del','Admin\UserController@delete')->name('user.delete');
        Route::get('/usuarios/{id}/restaurar','Admin\UserController@restore')->name('user.restore');
        Route::get('/usuarios/asociar/{id}/editar','Admin\UserController@associate')->name('user.associate');
        Route::put('/usuarios/asociar/{id}','Admin\UserController@updateAssociate')->name('user.updateAssociate');
        Route::get('/usuarios/desasociar/{id}/editar','Admin\UserController@disassociate')->name('user.disassociate');
        Route::put('/usuarios/desasociar/{id}','Admin\UserController@updateDisassociate')->name('user.updateDisassociate'); 
    });
    
    Route::group(['middleware' => ['sol']], function () {
        Route::get('/solicitudes','RequestController@index')->name('request.index');
        Route::get('/solicitudes/create','RequestController@create')->name('request.create');
        Route::post('/solicitudes','RequestController@store')->name('request.store');
        Route::get('/solicitudes/{id}','RequestController@show')->name('request.show');
        Route::get('/solicitudes/{id}/del','RequestController@delete')->name('request.delete');

        Route::get('/seguimiento-solicitudes','TracingRequestController@index')->name('trequest.index');
        Route::get('/seguimiento-solicitudes/{id}','TracingRequestController@show')->name('trequest.show');
        Route::get('/seguimiento-solicitudes/pdf/{id}','TracingRequestController@requestPdf')->name('request_pdf');
    });

    Route::group(['middleware' => ['resp']], function () {
        Route::get('/categorias','CategoryController@index')->name('category.index');
        Route::get('/categorias/create','CategoryController@create')->name('category.create');
        Route::post('/categorias','CategoryController@store')->name('category.store');
        Route::get('/categorias/{id}/edit','CategoryController@edit')->name('category.edit');
        Route::put('/categorias/{id}','CategoryController@update')->name('category.update');
        Route::get('/categorias/{id}','CategoryController@delete')->name('category.delete');

        Route::get('/productos/clear_search','ProductController@clearSearch')->name('product.clear_search');
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

        Route::post('/productos/buscar','ProductController@search')->name('product.search');

        Route::get('/entradas','EntryController@index')->name('entry.index');
        Route::get('/entradas/create','EntryController@create')->name('entry.create');
        Route::post('/entradas','EntryController@store')->name('entry.store');
        Route::get('/entradas/{id}','EntryController@show')->name('entry.show');
        Route::get('/entradas/{id}/del','EntryController@delete')->name('entry.delete');

        Route::get('/entregas','DeliverController@index')->name('deliver.index');
        Route::get('/entregas/{id}/editar','DeliverController@edit')->name('deliver.edit');
        Route::put('/entregas/{id}','DeliverController@update')->name('deliver.update');

        Route::get('/seguimiento-entregados','TracingDeliverController@index')->name('tdeliver.index');
        Route::get('/seguimiento-entregados/{id}','TracingDeliverController@show')->name('tdeliver.show');
        Route::get('/seguimiento-entregado/{id}/editar','TracingDeliverController@edit')->name('tdeliver.edit');
        Route::put('/seguimiento-entregado/{id}','TracingDeliverController@update')->name('tdeliver.update');
    });

    Route::group(['middleware' => ['super']], function () {
        Route::get('/aprobaciones','ApproveController@index')->name('approve.index');
        Route::get('/aprobaciones/{id}/editar','ApproveController@edit')->name('approve.edit');
        Route::put('/aprobaciones/{id}','ApproveController@update')->name('approve.update');
        Route::get('/aprobaciones/{id}/del','ApproveController@delete')->name('approve.delete');

        Route::get('/seguimiento-aprobados','TracingApproveController@index')->name('tapprove.index');
        Route::get('/seguimiento-aprobados/{id}','TracingApproveController@show')->name('tapprove.show');

        Route::get('/reporte/justificaciones/clear_search','JustificationController@clearSearch')->name('justification.clear_search');
        Route::get('/reporte/justificaciones','JustificationController@index')->name('justification.index');
        Route::get('/reporte/justificaciones/{id}','JustificationController@show')->name('justification.show');
        Route::post('/reporte/justificaciones/buscar','JustificationController@search')->name('justification.search');
        Route::get('/reporte/export-file', 'JustificationController@exportFile')->name('justification.file');

    });

    Route::get('/accesos','AccessController@index')->name('access.index');

    Route::get('/lista-productos/clear_search','ProductListController@clearSearch')->name('productList.clear_search');
    Route::get('/lista-productos','ProductListController@index')->name('productList.index');
    Route::get('/lista-productos/{id}','ProductListController@show')->name('productList.show');
    Route::post('/lista-productos/buscar','ProductListController@search')->name('productList.search');

    Route::get('/graficos','ChartController@index')->name('chart.index');

    Route::get('/acerca-de','AboutController@index')->name('about.index');

    Route::get('/profile','ProfileController@edit')->name('profile.edit');
	Route::put('/profile', 'ProfileController@update')->name('profile.update');
});

Auth::routes();


