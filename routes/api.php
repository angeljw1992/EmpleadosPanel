<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Empleados
    Route::post('empleados/media', 'EmpleadosApiController@storeMedia')->name('empleados.storeMedia');
    Route::apiResource('empleados', 'EmpleadosApiController');

    // Contratos
    Route::apiResource('contratos', 'ContratosApiController');

    // Documentos
    Route::post('documentos/media', 'DocumentosApiController@storeMedia')->name('documentos.storeMedia');
    Route::apiResource('documentos', 'DocumentosApiController');
});
