<?php //dd($errors); ?>
@if ( count($errors) ) 
<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<h4 class="alert-heading">Se ha producido algún error:</h4>
	<hr>
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach

	</ul>
</div>
@endif