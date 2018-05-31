<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
			'name'=>'required|min:3|max:50|unique:categories,name,'.$this->id,
			'description'=>'max:250'
        ];
    }

    public function messages(){
		return [
			'name.required'=>'Es necesario ingresar el nombre.',
			'name.min'=>'El nombre es demasiado reducido.',
			'name.max'=>'El nombre es demasiado extenso.',
			'name.unique'=>'El nombre de la categoria existe.',
		];
	}	
}
