@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-12 col-lg-10">
				<div class="mt-4 card">
					<div class="card-header">
						@yield('card_header')
						@include('commons.messages')
					</div>
					<div class="card-body">
						@yield('card_body')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection