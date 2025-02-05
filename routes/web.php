<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Empresas
    Route::delete('empresas/destroy', 'EmpresasController@massDestroy')->name('empresas.massDestroy');
    Route::post('empresas/parse-csv-import', 'EmpresasController@parseCsvImport')->name('empresas.parseCsvImport');
    Route::post('empresas/process-csv-import', 'EmpresasController@processCsvImport')->name('empresas.processCsvImport');
    Route::resource('empresas', 'EmpresasController');

    // Empleados
    Route::delete('empleados/destroy', 'EmpleadosController@massDestroy')->name('empleados.massDestroy');
    Route::post('empleados/media', 'EmpleadosController@storeMedia')->name('empleados.storeMedia');
    Route::post('empleados/ckmedia', 'EmpleadosController@storeCKEditorImages')->name('empleados.storeCKEditorImages');
    Route::post('empleados/parse-csv-import', 'EmpleadosController@parseCsvImport')->name('empleados.parseCsvImport');
    Route::post('empleados/process-csv-import', 'EmpleadosController@processCsvImport')->name('empleados.processCsvImport');
    Route::resource('empleados', 'EmpleadosController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Contratos
    Route::delete('contratos/destroy', 'ContratosController@massDestroy')->name('contratos.massDestroy');
    Route::resource('contratos', 'ContratosController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
