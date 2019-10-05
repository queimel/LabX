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


Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {


    Route::middleware(['password_change'])->group(function () {
        Route::get('/', 'Admin\AdminController@index')->name('dashboard');
        Route::resource('roles', 'Admin\RolesController', ['as' => 'admin']);
        Route::resource('usuarios', 'Admin\UsersController', ['as' => 'admin']);
        Route::resource('clientes', 'Admin\ClientsController', ['as' => 'admin']);
        Route::resource('equipos', 'Admin\ClientsController', ['as' => 'admin']);
    });

    Route::get('password/change', 'Auth\ChangePasswordController@change')
    ->name('password.change');

    Route::post('password/post_change', 'Auth\ChangePasswordController@postChange')
    ->name('password.post_change');


});
