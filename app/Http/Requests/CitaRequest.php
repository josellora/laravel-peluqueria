<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente_id'    => 'required|notIn:0',
            'fecha'         => 'date|required',
            'hora'          => 'bail|required|date_format:H:i',

            'lineas'            => 'array',
            'lineas.*.concepto' => 'required',
            'lineas.*.cantidad' => 'nullable|numeric',
            'lineas.*.precio'   => 'nullable|numeric',
            'lineas.*.cita_linea_origen_id'    => 'nullable|numeric',
            'lineas.*.cita_linea_origen_type'  => 'nullable|string',
        ];
        
    }  

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'cliente_id.required'   => 'Seleccione un cliente válido',
            'hora.date_format'      => 'Introduzca una hora hh:mm',
/*
            'lineas.*.concepto.required'    => 'El CONCEPTO no puede estar en blanco',
            'lineas.*.precio.numeric'       => 'El precio debe ser un número',
            'lineas.*.cantidad.numeric'     => 'La cantidad debe ser un número',*/
        ];

        if ( is_array($this->request->get('lineas')) )
            foreach ($this->request->get('lineas') as $i => $val) {
                $messages['lineas.' . $i . '.concepto.required'] = 'Concepto en línea '.($i+1).' no puede estar en blanco';
                $messages['lineas.' . $i . '.cantidad.numeric'] = 'Cantidad en línea '.($i+1).' debe ser un número';
                $messages['lineas.' . $i . '.precio.numeric'] = 'Precio en línea '.($i+1).' debe ser un número';
            }

        return $messages;
    }   

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {

        //$lineas = json_decode($this->lineas);
        //$this->merge(['lineas' => $lineas]);

        if ( $this->input('cliente_id') == '0')
            unset($this['cliente_id']);

        // si una línea viene marcada como 'borrada' no se valida...

        return $this->all();
    }

}
