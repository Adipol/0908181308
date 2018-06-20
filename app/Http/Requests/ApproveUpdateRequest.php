<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveUpdateRequest extends FormRequest
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
            'product'  => 'required|array',
            'quantity' => 'required|array',
            'real'     => 'required|array',
        ];
    }

    public function messages(){
		return [
            'product.required'  => 'Es necesario agregar productos.',
            'product.array'     => 'Datos incorrectos.',
            'quantity.required' => 'Es necesario agregar la cantidad.',
            'quantity.array'    => 'Datos incorrectos.',
            'real.required'     => 'Es necesario agregar la cantidad aprobada.',
            'real.array'        => 'Datos incorrectos.',
		];
	}
}
