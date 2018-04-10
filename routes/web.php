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

	/* --- Grupos ---*/
	Route::resource('grupos','GruposController',["middleware" => 'rol_admin']);
	Route::get('mostrar', 'GruposController@mostrar');

	// entrevistas
	Route::resource('entrevistas','EntrevistasController');
	Route::get('cargarEntrevistas/{id}', 'EntrevistasController@show');
	Route::get('cargarEntrevistaOne/{id}', 'EntrevistasController@show_id');
	Route::get('eliminarEntrevista/{id}', 'EntrevistasController@eliminar');

	// PDF entrevistas
	Route::get('pdf_entrevistas/{id}', 'EntrevistasController@pdf');

	// articulos
	Route::resource('articulos','ArticulosController');
	Route::get('editarImagen/{id}','ArticulosController@editImagen');
	Route::put('updateImagen/{id}','ArticulosController@updateImagen');

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
	Route::get('vender/{id}', 'VentasController@venta');
	Route::post('pdf_venta/{id}', 'VentasController@pdf');

	// comentarios 
	Route::resource('comentario','ComentariosController');
	Route::post('guardarComentario', 'ComentariosController@store');

	// inventario 
	Route::resource('inventario','InventarioController');	

	//* --- Perfil --- */
	Route::get('/perfil', 'UserController@perfil')->name('perfil');
	Route::patch('/perfil', 'UserController@update_perfil')->name('update_perfil');
	
	Route::get('users_status/{id}', 'UserController@userStatus');
	Route::put('update_status/{id}', 'UserController@updateStatusUser');

	Route::get('articulos/img/{filename}',function($filename){
		
		// ubicacion de la ruta en storage
		$path = storage_path("app/images/$filename");
		
		if (!\File::exists($path)){
			abort(404);
		}
		
		$file = \File::get($path);
		$type = \File::mimeType($path);
		$response = Response::make($file,200);
		$response->header("Content-Type", $type);

		return $response;
	});

});