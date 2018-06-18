<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnityStoreRequest extends FormRequest
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
			'name'         => 'required|min:3|max:25|unique:units,name',
			'abbreviation' => 'required|min:1|max:10|unique:units,abbreviation'
        ];
    }

    public function messages()
    {
		return [
			'name.required'         => 'Es necesario ingresar el nombre.',
			'name.min'              => 'El nombre es demasiado reducido.',
			'name.max'              => 'El nombre es demasiado extenso.',
			'name.unique'           => 'El nombre de la medida existe.',
			'abbreviation.required' => 'Es necesario ingresar la abreviación.',
			'abbreviation.min'      => 'La abreviación es demasiado reducido.',
			'abbreviation.max'      => 'La abreviación es demasiado extenso.',
			'abbreviation.unique'   => 'La abreviación existe.'
		];
	}	
}
