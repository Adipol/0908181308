<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStorepRequest extends FormRequest
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
            'product_id' => [
                            'required',
                            Rule::exists('products','id')],
            'stock'    => 'required|integer|min:0'
        ];
    }

    public function messages(){
        return [
            'product_id.required' => 'Es necesario ingresar el producto.',
            'product_id.exists'=>'El producto seleccionado no existe.',
            'stock.required'=>'Ingrese la cantidad.',
            'stock.integer'=>'La cantidad debe ser un numero positivo.'

        ];
    }
}
