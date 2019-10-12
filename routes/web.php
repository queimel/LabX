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

// Route::get('email', function () {
//     return new App\Mail\CredencialesLogin(App\User::first(), 'asd123');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/no-autorizado', 'Auth\UserActiveFilter@blocked')->name('no-autorizado');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {

    Route::middleware(['user_active'])->group(function () {
        Route::middleware(['password_change'])->group(function () {

            Route::middleware(['password_expired'])->group(function () {
                Route::get('/', 'Admin\AdminController@index')->name('dashboard');
                Route::resource('roles', 'Admin\RolesController', ['as' => 'admin']);
                Route::resource('usuarios', 'Admin\UsersController', ['as' => 'admin']);
                Route::resource('clientes', 'Admin\ClientsController', ['as' => 'admin']);

                // SUCURSALES
                Route::get('sucursales/create/{cliente}','Admin\SucursalesController@create')->name('admin.sucursales.create');
                Route::get('sucursales/{cliente}/edit/{sucursal}','Admin\SucursalesController@edit')->name('admin.sucursales.edit');
                Route::put('sucursales/{cliente}/{sucursal}','Admin\SucursalesController@update')->name('admin.sucursales.update');
                Route::delete('sucursales/{cliente}/{sucursal}','Admin\SucursalesController@destroy')->name('admin.sucursales.destroy');
                Route::get('sucursales/{cliente}/{sucursal}','Admin\SucursalesController@show')->name('admin.sucursales.show');

                // SECCIONES
                Route::get('secciones/create/{cliente}/{sucursal}','Admin\SeccionesController@create')->name('admin.secciones.create');
                Route::get('secciones/{cliente}/{sucursal}/{seccion}/edit','Admin\SeccionesController@edit')->name('admin.secciones.edit');
                Route::put('secciones/{cliente}/{sucursal}/{seccion}','Admin\SeccionesController@update')->name('admin.secciones.update');
                Route::delete('secciones/{cliente}/{sucursal}/{seccion}','Admin\SeccionesController@destroy')->name('admin.secciones.destroy');
                Route::get('secciones/{cliente}/{sucursal}/{seccion}','Admin\SeccionesController@show')->name('admin.secciones.show');

                // COMBOBOX REGIONES Y PROVINCIAS
                Route::get('provinciasPorRegion/{id}', 'Admin\RegionsController@GetProvinciasPorRegiones');
                Route::get('comunasPorProvincia/{id}', 'Admin\RegionsController@GetComunasPorProvincia');

                Route::get('modeloPorMarca/{id_marca}', 'Admin\EquiposController@GetModeloPorMarca');
                // EQUIPOS
                Route::resource('equipos', 'Admin\EquiposController', ['as' => 'admin']);

                // MARCAS
                Route::resource('equipos/marcas', 'Admin\MarcasController', ['as' => 'admin.equipos']);
            });

            Route::get('password/expired', 'Auth\ExpiredPasswordController@expired')->name('password.expired');
        });
        Route::get('password/change', 'Auth\ChangePasswordController@change')
        ->name('password.change');

        Route::post('password/post_change', 'Auth\ChangePasswordController@postChange')
        ->name('password.post_change');
    });

});
