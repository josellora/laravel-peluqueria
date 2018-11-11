@extends('layouts.card_content')

@section('title', 'Nueva cita')

@section('card_header')
	<h1>Nueva cita</h1>
@endsection

@section('card_body')
	@include('commons.errors')

	{!! Form::open(['route' => 'citas.store', 'method' => 'POST', 'id'=>'form-cita']) !!}
	<div class="row">

		<div class="form-group col-12">

			<?php $inv = $errors->has('cliente_id') ? ' is-invalid' : '' ?>
			{!! Form::label('cliente_id', 'Cliente'); !!}
			{!! Form::select('cliente_id', $clientes, null,['class' => 'form-control'.$inv ]) !!}
		</div>

		<div class="form-group col-6" >
			<?php $inv = $errors->has('fecha') ? ' is-invalid' : '' ?>
			{!! Form::label('fecha', 'Fecha'); !!}
			{!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control'.$inv ] ); !!}
		</div>

		<div class="form-group col-6">
			<?php $inv = $errors->has('hora') ? ' is-invalid' : '' ?>
			{!! Form::label('hora', 'Hora'); !!}
			<input name="hora" type="time" class="form-control{{ $inv }}" value="{{ old('hora') }}">
		</div>

		<div class="input-group mb-3 col-12">
			<?php $tipo_linea = ['SERVICIO', 'PRODUCTO', 'ARTICULO', 'OTROS'] ?>
			<?php 
					$optionAttributes = [
					    '' => [
					        'disabled' => 'disabled',
					        'selected' => 'selected',
					    ],
					]; 
			?>
			{!! Form::select('tipo_linea', $linea_origen_tipos, null,['class' => 'form-control' ], $optionAttributes) !!}
			{!! Form::select('origen_id', [], null,['class' => 'form-control' ]) !!}
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="btn-add-line">Añadir línea</button>
			</div>
		</div>

		<div class="col-12" id="lineas-cita">
			@include('citas.lineas_cita')
		</div>


		
		<div class="col-12"><hr></div> 

		<div class="form-group col-6">
			{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
		</div>


	</div>
	{!! Form::close() !!}

	<pre>
		<h2>servicios</h2>
		<?php if (isset($servicios)) dump($servicios) ?>
	</pre>
	<pre>
		<h2>Lineas</h2>
		<?php if (isset($lineas)) dump($lineas) ?>
	</pre>
	<pre>
		
		<h2>Errors</h2>
		{{ print_r($errors) }}

	</pre>
	<pre>
		
		{{ print_r( $errors->getBag('default')->keys() ) }}

	</pre>
	<pre>
		
		{{ print_r($errors->all()) }}
	</pre>
	<pre>
		<h2>old</h2>
		<?php dump(old());  ?>

	</pre>
	<pre>
		

	</pre>
@endsection

@section('scripts')

<script>

	getListServicios();

	
	var lineas = [];
	var errors = [];

	<?php if( is_array(old('lineas')) ) { ?>
		lineas = <?php echo json_encode(old('lineas')) ?>;
	<?php } ?>

	<?php if( is_array( $errors->getBag('default')->keys() ) ) { ?>
		errors = <?php echo json_encode($errors->getBag('default')->keys()) ?>;
	<?php } ?>

	jQuery(document).ready(function() {	

		//if ( lineas.length ) pintaLineas();		
/*
		jQuery("select[name=servicio_id]").on('change', function() {
			//var route = "/servicios/"+jQuery(this).val();
			var route = "{{ route('servicios.show', ['servicio'=>'']) }}/"+jQuery(this).val();
			jQuery.get(route, function(result) {
				console.log(result);
				var data = JSON.parse(result);
				console.log(result);
				data.takata_id = data.id;
				delete(data.id);
				console.log(result);
				console.log(result);
			})
		});
*/
		jQuery("#btn-add-line").on('click', function() {
			var $option = jQuery("select[name=origen_id] option:selected");
			if ( $option.val() != '' ) {
				lineas.push({
					'cita_linea_origen_id'		: $option.val(),
					'cita_linea_origen_type'	: jQuery("select[name=tipo_linea] option:selected").val(),
					'concepto'		: $option.text(),
					'cantidad'		: 1,
					'precio'		: $option.attr('price'),
				});
				paintLineas();
			}
		});
/*
		jQuery("#form-cita").on('submit', function(e) {
			e.preventDefault();
			jQuery("input[name=lineas_json]").val(JSON.stringify(lineas));
			jQuery("form#form-cita").unbind('submit').submit();
		});
*/
	});

	function getListServicios() {
		console.log('getListServicios')
		var html = '';
		jQuery.get("{{ route('servicios.index') }}", function(result) {

			jQuery.each( result, function(i,v) {
				html += '<option value="'+v.id+'" price="'+v.price+'">'+v.name+'</option>';
			});
			jQuery("select[name=origen_id]").html(html);
		});
	}

	function paintLineas() {
		console.log('paintLineas');
		var data = { 
			lineas: lineas, 
			_token: '{{csrf_token()}}'  // esto hace falta, sino post ajax devuelve error.
		};

        jQuery.ajax({
            url: "/citas/paint_lineas",
            method: "POST",
            data: data,
    		dataType: 'json',
            success: function(data){
				console.log(data);
				jQuery("#lineas-cita").html(data);
            }
        });
        return;

		jQuery.post("/citas/paint_lineas", data, function(result) {
				console.log(result);
		});
		return;
		jQuery.get("/citas/paint_lineas", function(result) {
			console.log(result);
			return;

			jQuery.each( result, function(i,v) {
				html += '<option value="'+v.id+'" price="'+v.price+'">'+v.name+'</option>';
			});
			jQuery("lineas-cita").html(html);
		});

	}
/*
	function pintaLineas() {
		var toTextRight = ['cantidad', 'precio'];
		var hidden = ['cantidad', 'precio'];
		var html = '';
		jQuery.each(lineas, function(i, linea) {
			html += '<tr index='+i+'>';
			html += '<td>'+(i+1)+'</td>';


			var is_invalid = ( jQuery.inArray(('lineas.'+i+'.concepto'), errors) != -1) ? ' is-invalid' : ''; 
			html += '<td><input type="text" name="lineas['+i+'][concepto]" class="form-control form-control-sm '+is_invalid+'" value="'+linea.concepto+'"></td>';

			var is_invalid = ( jQuery.inArray(('lineas.'+i+'.cantidad'), errors) != -1) ? ' is-invalid' : ''; 
			html += '<td><input type="number" min="0" name="lineas['+i+'][cantidad]" class="form-control form-control-sm text-right '+is_invalid+'" value="'+linea.cantidad+'"></td>';

			var is_invalid = ( jQuery.inArray(('lineas.'+i+'.precio'), errors) != -1) ? ' is-invalid' : ''; 
			html += '<td><input type="number" step="0.01" name="lineas['+i+'][precio]" class="form-control form-control-sm text-right '+is_invalid+'" value="'+linea.precio+'"></td>';

			html += '</tr>';
			html += '<input type="hidden" name="lineas['+i+'][origen_id]" value="'+linea.origen_id+'">';
			html += '<input type="hidden" name="lineas['+i+'][origen_type]" value="'+linea.origen_type+'">';
*/

/*
			jQuery.each( linea, function (elem, value) {
				var name_error = 'lineas.'+i+'.'+elem;
				value = (value === null) ? '' : value;
				style += ( jQuery.inArray(name_error, errors) != -1) ? ' is-invalid' : '';
				//style += ( jQuery.inArray(elem, toTextRight) ) ? ' ' : '';
				html += '<td><input name="lineas['+i+']['+elem+']" class="form-control form-control-sm '+style+'" type="text" value="'+value+'"></td>'
			})
*/
/*
		})
		jQuery("#table-lineas-cita tbody").html(html);
		jQuery("#lineas-cita").show();
	}
*/
</script>

@endsection