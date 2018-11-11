@extends('layouts.card_content')

@section('title', 'Listado de citas')


@section('card_header')
	<div class="d-flex justify-content-between">
		<h1>Listado de citas</h1>
		<p>
			<a href="{{ route('citas.create') }}" class="btn btn-flat btn-primary">nueva cita</a>
		</p>
	</div>
@endsection

@section('card_body')
	@include('commons.messages')
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Fecha</th>
				<th scope="col">Hora</th>
				<th scope="col">Cliente</th>
				<th scope="col"></th>
			</tr>
		</thead>	
		<tbody>
			@forelse ($citas as $i => $cita)
				<tr>
					<th scope="row">{{ $cita->id }}</th>
					<td>{{ $cita->fecha }}</td>
					<td>{{ $cita->hora }}</td>
					<td>{{ $cita->cliente->name.' '.$cita->cliente->surname }}</td>
					<td><a href="{{ route('citas.edit', $cita) }}">editar</a></td>
				</tr>
			@empty
				<tr>
					<td colspan="3" class="text-center">No hay usuarios que mostrar</td>
				</tr>
			@endforelse
		</tbody>
	</table>

@endsection
