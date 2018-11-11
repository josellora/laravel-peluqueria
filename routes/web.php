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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

	Route::resource('users', 	'UserController');
	Route::resource('usuarios', 'UserController');

	Route::resource('clientes', 'ClienteController');
	Route::resource('citas', 	'CitaController');

	Route::resource('servicios', 'ServicioController');
	Route::resource('articulos', 'ArticuloController');
/*
	Route::post('citas/paint_lineas', function(Request $request) { 
	    //dd($request); 
	    $data = Request::all();

	    $lineas = $data['lineas'];
        $cita_lineas = array_map( function($v){ return new App\CitaLinea($v); }, $lineas );
		//dd($cita_lineas); 
	    return view('citas.lineas_cita', compact('lineas') )->render();
	    //return view('citas.lineas_cita', compact('lineas') );

	});
	Route::get('citas/create2', function() {  
        $clientes = App\Cliente::all()->pluck('full_name', 'id')
                        ->prepend('Seleccione cliente', '')
                        ->toArray();

        $servicios = App\Servicio::all()->pluck('name', 'id')
                        ->prepend('Seleccione servicio', '')
                        ->toArray();

        $linea_origen_tipos = array_prepend(App\CitaLinea::getLineaOrigenTipos(), '-tipo de linea-', '');
        
        return view('citas.create2', compact('clientes', 'servicios', 'linea_origen_tipos'));
	});

	Route::get('citas_detalle/{id}', function($id) {  /////// para pruebas de polimorfismo

		$cita = App\Cita::with('cita_lineas.cita_linea_origen')->find(204);
		dump($cita);

		$cita_linea = App\CitaLinea::with('cita_linea_origen')->find(1);
		dump($cita_linea);

		
		$servicio = App\Servicio::with('citaLineas')->find(1);
		dump($servicio);

		dump($cita->cita_lineas[0]->concepto);
	});

*/
	// Route::get('servicios/{servicio}/get', 'ServicioController@getServicio');

});
