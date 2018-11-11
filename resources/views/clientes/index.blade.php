@extends('layouts.card_content')

@section('title', 'Listado de clientes')


@section('card_header')
	<div class="d-flex justify-content-between">
		<h1>Listado de clientes</h1>
		<p>
			<a href="{{ route('clientes.create') }}" class="btn btn-flat btn-primary">nuevo cliente</a>
		</p>
	</div>
@endsection

@section('card_body')

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Apellidos</th>
				<th scope="col">Nombre</th>
				<th scope="col">Teléfono</th>
				<th scope="col"></th>
			</tr>
		</thead>	
		<tbody>
			@forelse ($clientes as $i => $user)
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td><a href="{{ route('clientes.edit', $user) }}">editar</a></td>
					<td><a href="{{ route('clientes.show', $user) }}">ver</a></td>
				</tr>
			@empty
				<tr>
					<td colspan="3" class="text-center">No hay clientes que mostrar</td>
				</tr>
			@endforelse
		</tbody>
	</table>

@endsection
