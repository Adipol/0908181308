<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestStoreRequest extends FormRequest
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
            'justification_id' => ['required',Rule::exists('justifications','id')],
            'description'      => 'required|min:3',
        ];
    }

    public function messages(){
		return [
            'justification_id.required' => 'Es necesario ingresar la justificacion.',
            'justification_id.exists'   => 'La justificacion ingresada no existe.',
            'description.required'      => 'Ingrese el detalle de la justificacion.',
            'description.min'           => 'El detalle es demasiado reducido.'
		];
	}
}
