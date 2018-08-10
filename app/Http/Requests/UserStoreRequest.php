<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            'name'     => 'required|min:3|max:50|unique:users,name',
            'email'    => 'required|string|email|max:150|unique:users,email',
            'password' => 'min:6',
            'rol_id'   => ['required', Rule::exists('rols','id')]
        ];
    }

    public function messages(){
		return [
            'name.required'   => 'Es necesario ingresar el nombre.',
            'name.min'        => 'El nombre es demasiado reducido.',
            'name.max'        => 'El nombre es demasiado extenso.',
            'name.unique'     => 'El nombre del usuario existe.',
            'email.required'  => 'El correo es requerido.',
            'email.email'     => 'El correo ingresado no tiene un formato correcto.',
            'email.max'       => 'El correo es demasiado extenso.',
            'email.unique'    => 'El correo ingresado existe.',
            'rol_id.required' => 'Es necesario ingresar el rol.'
		];
	}
}
