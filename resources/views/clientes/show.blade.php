@extends('layouts.card_content')

@section('title', 'Ficha de cliente')

@section('card_header')
	<h1>Ficha de cliente</h1>
@endsection

@section('card_body')
		<h1>{{ $cliente->surname . ', ' . $cliente->name }}</h1>
		<h2>{{ $cliente->email }}</h2>
			<ul class="list-group">
				@foreach ( $cliente->citas as $cita )
			  		<li class="list-group-item">{{ $cita->fecha . '-->' . $cita->hora }}</li>
				@endforeach
			</ul>
@endsection
