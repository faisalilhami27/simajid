<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonaturRequest extends FormRequest
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
            'nama' => 'required|regex:/^[a-zA-Z-., ]*$/',
            'id_jenis' => 'required',
            'tempat_lahir' => 'required|regex:/^[a-zA-Z ]*$/',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required|regex:/^[0-9]*$/|max:15',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|regex:/^[a-zA-Z0-9-., ]*$/',
        ];
    }
}
