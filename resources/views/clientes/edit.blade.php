@extends('layouts.card_content')

@section('title', 'Nuevo usuario')

@section('card_header')
	<h1>Editar usuario</h1>
@endsection

@section('card_body')
	@include('commons.errors')
	{!! Form::model( $cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'PUT']  ) !!}
		<div class="form-group" >
			{!! Form::label('name', 'Nombre:'); !!}
			<?php $is_invalid = $errors->has('name') ? ' is-invalid' : '' ?>
			{!! Form::text('name', null, ['class' => 'form-control'.$is_invalid ]) !!}
		</div>
		<div class="form-group" >
			{!! Form::label('surname', 'Apellidos:'); !!}
			<?php $is_invalid = $errors->has('surname') ? ' is-invalid' : '' ?>
			{!! Form::text('surname', null, ['class' => 'form-control'.$is_invalid ]) !!}
		</div>
		<div class="form-group" >
			{!! Form::label('email', 'E-Mail Address'); !!}
			<?php $is_invalid = $errors->has('email') ? ' is-invalid' : '' ?>
			{!! Form::text('email', null, ['class' => 'form-control'.$is_invalid ]) !!}
		</div>	
		<div class="form-group" >
			{!! Form::label('telefono', 'Teléfono'); !!}
			<?php $is_invalid = $errors->has('telefono') ? ' is-invalid' : '' ?>
			{!! Form::text('telefono', null, ['class' => 'form-control'.$is_invalid ]) !!}
		</div>		
		{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@endsection