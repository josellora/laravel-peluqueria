@extends('layouts.card_content')

@section('title', 'Editar cita')

@section('card_header')
	<h1>Editar cita</h1>
@endsection

@section('card_body')
	@include('commons.errors')
	{!! Form::model( $cita, ['route' => ['citas.update', $cita->id], 'method' => 'PUT', 'id'=>'form-cita']) !!}
	@include('citas.form')
	{!! Form::close() !!}

@endsection