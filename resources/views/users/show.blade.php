@extends('layouts.card_content')

@section('title', 'Vista de Usuarios')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
	<div class="content">
		<h1>{{ $user->name }}</h1>
		<h2>{{ $user->email }}</h2>
	</div>
@endsection
