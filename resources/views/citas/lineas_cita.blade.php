
@isset($lineas)
		
	<table class="table" id="table-lineas-cita">
		<thead class="thead-dark">
			<tr>
				<th class="text-center w-10">#</th>
				<th class="text-center w-70">Concepto</th>
				<th class="text-center w-10">Cant</th>
				<th class="text-center w-10">€</th>
			</tr>
		</thead>
		<tbody>
		@foreach ( $lineas as $i => $linea)
			<tr index="{{ $i }}">
				<td>{{ $i+1 }}</td>
				<td>
					{!! Form::text('lineas[".$i."][concepto]') !!}
					<!--
					<input type="text" name="lineas[{{ $i }}][concepto]" class="form-control form-control-sm " value="{{ $linea['concepto'] }}">
				-->
				</td>

				<td>
					<input type="number" min="0" name="lineas[{{ $i }}][cantidad]" class="form-control form-control-sm text-right" value="{{ $linea['cantidad'] }}">
				</td>
				<td>
					<input type="number" step="0.01" name="lineas[{{ $i }}][precio]" class="form-control form-control-sm text-right " value="{{ $linea['precio'] }}">
				</td>
			</tr>
			<input type="hidden" name="lineas[{{ $i }}][cita_linea_origen_id]" value="{{ $linea['cita_linea_origen_id'] }}">
			<input type="hidden" name="lineas[{{ $i }}][cita_linea_origen_type]" value="{{ $linea['cita_linea_origen_type'] }}">
		
		@endforeach 
		</tbody>
	</table>
	
@else 
 ooooooooo
@endisset