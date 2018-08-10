<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseStoreRequest extends FormRequest
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
			'name'      => 'required|min:3|max:50|unique:warehouses,name',
			'ubication' => 'max:150'
        ];
    }

    public function messages(){
		return [
			'name.required' => 'Es necesario ingresar el nombre.',
			'name.min'      => 'El nombre es demasiado reducido.',
			'name.max'      => 'El nombre es demasiado extenso.',
			'name.unique'   => 'El nombre del almacén existe.',
			'ubication.max' => 'La ubicación del almacén es demasiado extenso.'
		];
	}
}
