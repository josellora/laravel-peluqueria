@extends('layouts.card_content')

@section('title', 'Nuevo usuario')

@section('card_header')
	<h1>Nuevo usuario</h1>
@endsection

@section('card_body')
	@include('commons.errors')
	{!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
		@include('users.form')
	{!! Form::close() !!}
@endsection