@extends('layouts.card_content')

@section('title', 'Nuevo usuario')

@section('card_header')
	<h1>Editar usuario</h1>
@endsection

@section('card_body')
	@include('commons.errors')
	{!! Form::model( $user, ['route' => ['users.update', $user->id], 'method' => 'PUT']  ) !!}
		@include('users.form')
	{!! Form::close() !!}
@endsection