	<div class="row">

		<div class="form-group col-12">

			<?php $inv = $errors->has('cliente_id') ? ' is-invalid' : '' ?>
			{!! Form::label('cliente_id', 'Cliente'); !!}
			{!! Form::select('cliente_id', $clientes, null,['class' => 'form-control'.$inv ]) !!}
		</div>

		<div class="form-group col-sm-6" >
			<?php $inv = $errors->has('fecha') ? ' is-invalid' : '' ?>
			{!! Form::label('fecha', 'Fecha'); !!}
			{!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control'.$inv ] ); !!}
		</div>

		<div class="form-group col-sm-6">
			<?php $inv = $errors->has('hora') ? ' is-invalid' : '' ?>
			{!! Form::label('hora', 'Hora'); !!}
			<input name="hora" type="time" class="form-control{{ $inv }}" value="{{ old('hora') }}">
		</div>

		<div class="form-group col-sm-3">
			<?php 
					$optionAttributes = [
					    '' => [
					        'disabled' => true,
					        'selected' => true,
					    ],
					]; 
			?>
			{!! Form::select('cita_linea_origen_type', $linea_origen_tipos, null,['class' => 'form-control' ], $optionAttributes) !!}
		</div>

		<div class="input-group mb-3 col-sm-9">
			{!! Form::select('cita_linea_origen_id', ['placeholder'=>'select'], null,['class'=>'form-control', 'disabled'=>'disabled' ]) !!}
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="btn-add-line">Añadir línea</button>
			</div>
		</div>

		<div class="col-12" id="lineas-cita" style="display: none;">
			<table class="table table-responsive-sm table-sm" id="table-lineas-cita">
				<thead class="thead-dark">
					<tr class="">
						<th class="text-center">Concepto</th>
						<th class="text-center">Cant</th>
						<th class="text-center">€</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		
		<div class="col-12"><hr></div> 

		<div class="form-group col-6">
			{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
		</div>

	</div>


	<h2>Lineas:</h2>
	<?php if ( isset($cita->cita_lineas)) dump($cita->cita_lineas) ?>
	<hr>
	<h2>Cita:</h2>
	<?php if ( isset($cita)) dump($cita) ?>


@section('scripts')

<script>

	var lineas = [];
	var errors = [];

	<?php if( isset($cita->cita_lineas) ) { ?>
		lineas = <?php echo json_encode($cita->cita_lineas->toArray()) ?>;
	<?php } ?>
	<?php if( is_array(old('lineas')) ) { ?>
		lineas = <?php echo json_encode(old('lineas')) ?>;
	<?php } ?>

	<?php if( is_array( $errors->getBag('default')->keys() ) ) { ?>
		errors = <?php echo json_encode($errors->getBag('default')->keys()) ?>;
	<?php } ?>

	console.log(lineas);

	jQuery(document).ready(function() {	

		if ( lineas.length ) pintaLineas();	

		jQuery("select[name=cita_linea_origen_type]").val('').change();

		jQuery("select[name=cita_linea_origen_type]").on('change', function() {
			var origen_tipo = jQuery(this).find("option:selected").val();
			if (origen_tipo != '')
				getListToSelect(origen_tipo);
		});

		jQuery(document).on('click', '.rem-line' ,function() {
			var index = jQuery(this).attr('index');
			console.log(index);
			lineas.splice(index, 1);
			jQuery(this).closest('tr').hide('slow', function(){ 
				jQuery(this).empty().remove(); 
				pintaLineas();
			});
		});

		jQuery("#btn-add-line").on('click', function() {
			var $option = jQuery("select[name=cita_linea_origen_id] option:selected");
			if ( $.isNumeric($option.val()) ) {
				lineas.push({
					'cita_linea_origen_id'		: $option.val(),
					'cita_linea_origen_type'	: jQuery("select[name=cita_linea_origen_type] option:selected").val(),
					'concepto'	: $option.text(),
					'cantidad'	: 1,
					'precio'	: $option.attr('price'),
				});
				pintaLineas();
			}
		});

	});

	function getListToSelect(origen_tipo) {
		var html = '<option selected disabled>---</option>';
		jQuery.get("/"+origen_tipo, function(result) {
			jQuery.each( result, function(i,v) {
				html += '<option value="'+v.id+'" price="'+v.price+'">'+v.name+'</option>';
			});
			jQuery("select[name=cita_linea_origen_id]").html(html).attr('disabled',false);
		});
	}

	function pintaLineas() {
	console.log('pintaLineas');
	console.log(lineas);
		var html = '';
		jQuery.each(lineas, function(i, linea) {

			html += '<tr index='+i+'>';
			//html += '<td>'+(i+1)+'</td>';

			var is_invalid = ( jQuery.inArray(('lineas.'+i+'.concepto'), errors) != -1) ? ' is-invalid' : ''; 
			html += '<td><input type="text" name="lineas['+i+'][concepto]" class="form-control form-control-sm '+is_invalid+'" value="'+((linea.concepto==null)?'':linea.concepto)+'"></td>';

			var is_invalid = ( jQuery.inArray(('lineas.'+i+'.cantidad'), errors) != -1) ? ' is-invalid' : ''; 
			html += '<td><input type="number" min="0" name="lineas['+i+'][cantidad]" class="form-control form-control-sm text-right '+is_invalid+'" value="'+linea.cantidad+'"></td>';

			var is_invalid = ( jQuery.inArray(('lineas.'+i+'.precio'), errors) != -1) ? ' is-invalid' : ''; 
			html += '<td><input type="number" step="0.01" name="lineas['+i+'][precio]" class="form-control form-control-sm text-right '+is_invalid+'" value="'+linea.precio+'"></td>';

			html += '<td><i index='+i+' class="fa fa-times-circle fa-2x rem-line" aria-hidden="true"></i></td>';

			html += '</tr>';
			html += '<input type="hidden" name="lineas['+i+'][cita_linea_origen_id]" value="'+linea.cita_linea_origen_id+'">';
			html += '<input type="hidden" name="lineas['+i+'][cita_linea_origen_type]" value="'+linea.cita_linea_origen_type+'">';


		})
		jQuery("#table-lineas-cita tbody").html(html);
		jQuery("#lineas-cita").show();
	}



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


/*
		jQuery("#form-cita").on('submit', function(e) {
			e.preventDefault();
			jQuery("input[name=lineas_json]").val(JSON.stringify(lineas));
			jQuery("form#form-cita").unbind('submit').submit();
		});
*/

/*
	function getListServicios() {
		var html = '<option selected disabled>seleccione un servicio</option>';
		jQuery.get("{{ route('servicios.index') }}", function(result) {
			jQuery.each( result, function(i,v) {
				html += '<option value="'+v.id+'" price="'+v.price+'">'+v.name+'</option>';
			});
			jQuery("select[name=origen_id]").html(html);
		});
	}
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
</script>

@endsection