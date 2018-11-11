<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ClienteRequest $request )
    {
        $cliente = new Cliente();
        $cliente->fill($request->all());

        return redirect()
                ->route('clientes.index')
                ->with('success','El nuevo usuario ha sido creado');
        /*
        $data = $request->all();
        Cliente::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
        ]);
        dd($data);
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }
    /*
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.show', compact('cliente'));
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
        $data = $request->all();
        $cliente = Cliente::find($id);
        $cliente->fill($data)->save();
        return redirect()
                ->route('clientes.index')
                ->with('success','El cliente ha sido modificado');

        /*
        $data = $request->all();
        Cliente::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
        ]);
        dd($data);
        */
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "destroy  cliente_controller";
    }
}
