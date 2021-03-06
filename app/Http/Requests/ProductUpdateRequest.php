<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            'category_id'=>[
                'required',
                Rule:: exists('categories','id')
            ],
            'name'    => 'required|min:3|max:50|unique:products,name,'.$this->id,
            'unit_id' => [
                'required',
                Rule:: exists('units','id')
            ],
            'description' => 'max:150',
            'image'       => 'image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages(){
		return [
            'category_id.required' => 'Es necesario ingresar la categoría.',
            'category_id.exists'   => 'La categoria seleccionada no existe.',
            'name.required'        => 'Es necesario ingresar el nombre.',
            'name.min'             => 'El nombre es demasiado reducido.',
            'name.max'             => 'El nombre es demasiado extenso.',
            'name.unique'          => 'El nombre se encuentra en uso.',
            'unit_id.required'     => 'Es necesario ingresar la medida.',
            'unit_id.exists'       => 'La medida seleccionada no esxiste.',
            'description.max'      => 'La descripción es demasiado extenso.',
            'image.image'          => 'El archivo tiene que ser una imagen.',
            'image.mimes'          => 'El archivo no tiene extensión: jpg, jpeg, png'
		];
	}
}
