@extends('layouts.card_content')

@section('title', 'Listado de Usuarios')


@section('card_header')
	<div class="d-flex justify-content-between">
		<h1>Listado de Usuarios</h1>
		<p>
			<a href="{{ route('users.create') }}" class="btn btn-flat btn-primary">nuevo usuario</a>
		</p>
	</div>
@endsection

@section('card_body')
	@include('commons.messages')

	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nombre</th>
				<th scope="col">email</th>
				<th scope="col"></th>
			</tr>
		</thead>	
		<tbody>
			@forelse ($users as $i => $user)
				<tr>
					<th scope="row">{{ $user->id }}</th>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td><a href="{{ route('users.edit', $user) }}">editar</a></td>
				</tr>
			@empty
				<tr>
					<td colspan="3" class="text-center">No hay usuarios que mostrar</td>
				</tr>
			@endforelse
		</tbody>
	</table>

@endsection
