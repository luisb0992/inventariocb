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

/*---------- RUTAS DE LOGIN ----------------*/
Route::get('/', function () {
  return view('login');
})->name('login');

Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function() { //middleware auth
  /* ---- Ruta para llamar al dashboard, modificarla si es necesario ----- */
	Route::get('dashboard', 'LoginController@index')->name('dashboard');
	
	/* --- Usuarios ---*/
	Route::resource('/users','UserController',["middleware" => 'rol_admin']);

	// entrevistas
	Route::resource('entrevistas','EntrevistasController');
	Route::get('cargarEntrevistas/{id}', 'EntrevistasController@show');

	// articulos
	Route::resource('articulos','ArticulosController');

	// modelos
	Route::resource('modelos','ModelosController');
	Route::post('guardarModelos', 'ModelosController@store');
	Route::get('cargarModelos', 'ModelosController@create');

	// colores
	Route::resource('colores','ColoresController');
	Route::post('guardarColores', 'ColoresController@store');
	Route::get('cargarColores', 'ColoresController@create');

	// ventas
	Route::resource('ventas','VentasController');

	// comentarios 
	Route::resource('ventas','ComentariosController');
	Route::post('guardarComentario', 'ComentariosController@store');	

	//* --- Perfil --- */
	Route::get('/perfil', 'UserController@perfil')->name('perfil');
	Route::patch('/perfil', 'UserController@update_perfil')->name('update_perfil');
	
	Route::get('users_status/{id}', 'UserController@userStatus');
	Route::put('update_status/{id}', 'UserController@updateStatusUser');
});