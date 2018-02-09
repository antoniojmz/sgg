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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/empresas', 'EmpresaController@getEmpresas')->name('empresas');
Route::post('/empresas', 'EmpresaController@postEmpresas')->name('empresas');
Route::post('/activarE', 'EmpresaController@postEmpresactiva')->name('activarE');
Route::post('/detallesE', 'EmpresaController@postEmpresadeatalles')->name('detallesE');

Route::group(['namespace' => 'Auth', 'prefix' => 'admin'], function (){
	//accesos (Seleccionar acceso para ingresar a la aplicacion)
	Route::get('/accesos', 'UsuarioController@getAccesos')->name('accesos');
	Route::post('/accesos', 'UsuarioController@postAccesos')->name('accesos');
	//Mostrar Perfiles de los usuarios (Activar / Desactivar)
	Route::get('/perfiles', 'UsuarioController@getPerfiles')->name('perfiles');
	Route::post('/perfiles', 'UsuarioController@postPerfiles')->name('perfiles');
	// Registro de usuarios
	Route::get('/usuarios', 'UsuarioController@getUsuarios')->name('usuarios');
	Route::post('/usuarios', 'UsuarioController@postUsuarios')->name('usuarios');
	// Cambio de contraseña por el mismo usuario
	Route::get('/password', 'UsuarioController@getPassword')->name('password');
	Route::post('/password', 'UsuarioController@postPassword')->name('password');
	// Pantalla de perfil del usuario
	Route::get('/perfil', 'UsuarioController@getPerfil')->name('perfil');
	Route::post('/perfil', 'UsuarioController@postPerfil')->name('perfil');
	//Cargar y eliminar foto de perfil de usuario
	Route::post('/fotoc', 'UsuarioController@postCargarfoto')->name('fotoc');
	Route::post('/fotoe', 'UsuarioController@postEliminarfoto')->name('fotoe');
	// Recuperar y reiniciar contraseña
	Route::post('/recuperar', 'RecuperarController@postRecuperar')->name('recuperar');
	Route::post('/reiniciar', 'UsuarioController@postReiniciar')->name('reiniciar');
	// Activar o Desactivar usuario
	Route::post('/activar', 'UsuarioController@postUsuarioactivo')->name('activar');
	// Activar o Desactivar Perfil de usuario
	Route::post('/activarP', 'UsuarioController@postPerfilactivo')->name('activarP');
	// Desbloquear cuenta de usuario por maximo de intentos fallídos
	Route::post('/desbloquearC', 'UsuarioController@postDesbloquearcuenta')->name('desbloquearC');
});


