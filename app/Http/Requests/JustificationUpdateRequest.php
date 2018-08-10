<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JustificationUpdateRequest extends FormRequest
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
			'name'=>'required|min:3|max:100|unique:justifications,name,'.$this->id,
        ];
    }

    public function messages(){
		return [
			'name.required' => 'Es necesario ingresar la justificación.',
			'name.min'      => 'La justificación es demasiado reducido.',
			'name.max'      => 'La justificación es demasiado extenso.',
			'name.unique'   => 'La justificación existe.',
		];
	}	
}
