<div class="form-group" >
	{!! Form::label('name', 'Nombre:'); !!}
	<?php $is_invalid = $errors->has('name') ? ' is-invalid' : '' ?>
	{!! Form::text('name', null, ['class' => 'form-control'.$is_invalid ]) !!}
</div>
<div class="form-group" >
	{!! Form::label('email', 'E-Mail Address'); !!}
	<?php $is_invalid = $errors->has('email') ? ' is-invalid' : '' ?>
	{!! Form::text('email', null, ['class' => 'form-control'.$is_invalid ]) !!}
</div>
<div class="form-group">
	{!! Form::label('password', 'Password'); !!}
	<?php $is_invalid = $errors->has('password') ? ' is-invalid' : '' ?>
	{!! Form::password('password', ['class' => 'form-control'.$is_invalid ]) !!}
</div>
{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}