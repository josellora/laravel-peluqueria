<?php


namespace App\Http\Controllers;

use App\Cita;
use App\CitaLinea;
use App\Cliente;
use \App\Servicio;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\CitaRequest;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = Cita::orderBy('fecha', 'DESC')->orderBy('hora', 'DESC')->get();
        return view('citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Responsef
     */
    public function create()
    {
        $clientes = Cliente::all()->pluck('full_name', 'id')
                        ->prepend('Seleccione cliente', '')
                        ->toArray();

        $servicios = Servicio::all()->pluck('name', 'id')
                        ->prepend('Seleccione servicio', '')
                        ->toArray();

        $linea_origen_tipos = array_prepend(CitaLinea::getLineaOrigenTipos(), '-tipo de linea-', '');
        
        //return view('citas.create2', compact('clientes', 'servicios', 'linea_origen_tipos'));
        return view('citas.create', compact('clientes', 'servicios', 'linea_origen_tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CitaRequest $request)
    {
        $cita = DB::transaction(function () use ($request) {
            $cita = Cita::create($request->all());
            if ( $request->has('lineas')) {
                $cita_lineas = array_map( function($v){ return new CitaLinea($v); }, $request->lineas );
                $cita->cita_lineas()->saveMany( $cita_lineas );
            }
            return $cita;
        });
        return redirect()->route('citas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show(Cita $cita)
    {
        dd($cita->cita_lineas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit(Cita $cita)
    {      

        $clientes = Cliente::all()->pluck('full_name', 'id')
                        ->prepend('Seleccione cliente', '')
                        ->toArray();
  
        $linea_origen_tipos = array_prepend(CitaLinea::getLineaOrigenTipos(), '-tipo de linea-', '');
        return view('citas.edit', compact('cita', 'clientes', 'linea_origen_tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cita $cita)
    {
        //
    }
}
