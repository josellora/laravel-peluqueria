<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteRequest extends FormRequest
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
            'name'      => 'required',
            'telefono'	=> 'required',
            'email'     => 'email|unique:users,email,'.$this->user,
        ];
        
    }  

    /**
     * Get data to be validated from the request.
     *
     * @return array
    protected function validationData()
    {
        //$this->request->add(['slug' => str_slug($this->input('name')) ] );
        return $this->all();
    }
     */

}
