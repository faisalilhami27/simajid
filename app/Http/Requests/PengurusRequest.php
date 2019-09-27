<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengurusRequest extends FormRequest
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
            'nama' => 'required|max:50|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:60',
            'no_hp' => 'required|numeric',
            'status' => 'required',
            'id_jabatan' => 'required'
        ];
    }
}
