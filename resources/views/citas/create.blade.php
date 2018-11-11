@extends('layouts.card_content')

@section('title', 'Nueva cita')

@section('card_header')
	<h1>Nueva cita</h1>
@endsection

@section('card_body')
	@include('commons.errors')

	{!! Form::open(['route' => 'citas.store', 'method' => 'POST', 'id'=>'form-cita']) !!}
	@include('citas.form')
	{!! Form::close() !!}

@endsection
