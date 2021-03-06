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

                //CLIENTES
                Route::resource('clientes', 'Admin\ClientsController', ['as' => 'admin']);
                


                // SUCURSALES
                Route::resource('sucursales', 'Admin\SucursalesController', ['as' => 'admin'])->except([
                    'create'
                ]);

                Route::get('sucursales/{cliente}/create','Admin\SucursalesController@create', ['as' => 'admin'])->name('admin.sucursales.create');

                // SECCIONES
                Route::resource('secciones', 'Admin\SeccionesController', ['as' => 'admin'])->except([
                    'create'
                ]);
                Route::get('secciones/{sucursal}/create','Admin\SeccionesController@create', ['as' => 'admin'])->name('admin.secciones.create');

                Route::get('sucursales_cliente/{id}', 'Admin\ClientsController@getSucursalesPorCliente');
                Route::get('rut_cliente/{id}', 'Admin\ClientsController@getCliente');

                // COMBOBOX REGIONES Y PROVINCIAS
                Route::get('provinciasPorRegion/{id}', 'Admin\RegionsController@GetProvinciasPorRegiones');
                Route::get('comunasPorProvincia/{id}', 'Admin\RegionsController@GetComunasPorProvincia');


                // EQUIPOS
                Route::resource('equipos', 'Admin\EquiposController', ['as' => 'admin']);
                Route::get('sucursales_cliente/{id}', 'Admin\ClientsController@getSucursalesPorCliente');
                Route::get('equipos_cliente/{id}', 'Admin\EquiposController@GetEquiposPorCliente');

                // MARCAS
                Route::resource('marcas', 'Admin\MarcasController', ['as' => 'admin']);

                // MODELOS
                Route::resource('modelos', 'Admin\ModelosController', ['as' => 'admin'])->except([
                    'create'
                ]);
                Route::get('modelos/{marca}/create','Admin\ModelosController@create', ['as' => 'admin'])->name('admin.modelos.create');
                Route::get('modeloPorMarca/{id_marca_modelo}', 'Admin\EquiposController@GetModeloPorMarca');
                Route::get('modeloPorEquipo/{id}', 'Admin\EquiposController@GetProvinciasPorRegiones');


                // TECNICOS
                // Route::resource('tecnicos', 'Admin\TecnicosController', ['as' => 'admin']);
                // // TELEFONOS
                // Route::delete('telefono/{id_telefono}', 'Admin\TecnicosController@DeleteTelefonoTecnico');

                // ENCARGADOS
                Route::resource('encargados', 'Admin\EncargadosController', ['as' => 'admin']);
                Route::get('clienteSucursalEncargado/{id}', 'Admin\EncargadosController@GetSucursalCliente');
                Route::get('clienteSeccionEncargado/{id}', 'Admin\EncargadosController@GetSeccionCliente');

                //REPUESTOS
                Route::resource('repuestos', 'Admin\RepuestosController', ['as' => 'admin']);

                //MANTENIMIENTOS
                Route::resource('mantenimientos', 'Admin\MantenimientosController', ['as' => 'admin']);
                
                // MANTENIMIENTOS ENCARGADO
                Route::resource('mantenimientos-cliente', 'Admin\MantenimientosClienteController', ['as' => 'admin'])->except(['create']);
                // Route::get('mantenimientos-cliente/{cliente}','Admin\MantenimientosClienteController@index', ['as' => 'admin'])->name('admin.mantenimientos-cliente.index');

                Route::get('mantenimientos-cliente/{cliente}/create','Admin\MantenimientosClienteController@create', ['as' => 'admin'])->name('admin.mantenimientos-cliente.create');

                // MANTENIMIENTOS TECNICO
                Route::resource('mantenimientos-tecnico', 'Admin\MantenimientosTecnicoController', ['as' => 'admin']);
            });

            Route::get('password/expired', 'Auth\ExpiredPasswordController@expired')->name('password.expired');
        });
        Route::get('password/change', 'Auth\ChangePasswordController@change')
        ->name('password.change');

        Route::post('password/post_change', 'Auth\ChangePasswordController@postChange')
        ->name('password.post_change');
    });

});
