<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryStoreRequest extends FormRequest
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
            'product' => 'required|array',
            'stock'   => 'required|array',
        ];
    }

    public function messages(){
		return [
            'product.required'  => 'Es necesario agregar productos.',
            'product.array'     => 'Datos incorrectos.',
            'stock.required' => 'Es necesario agregar la cantidad.',
            'stock.array'    => 'Datos incorrectos.',
		];
	}
}
