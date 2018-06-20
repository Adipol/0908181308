<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliverUpdateRequest extends FormRequest
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
            'observation' => 'required|min:5',
            'voucher'     => 'image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages(){
		return [
            'observation.required' => 'La observacion es obligatoria.',
            'observation.min'      => 'La observacion es muy reducida.',
            'voucher.image'        => 'El archivo tiene que ser una imagen.',
            'voucher.mimes'        => 'El archivo no tiene extension: jpg, jpeg, png',
            'voucher.uploaded'     => 'El archivo fallo al subir.',
		];
	}
}
