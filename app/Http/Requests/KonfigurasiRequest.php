<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KonfigurasiRequest extends FormRequest
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
            'nama_perusahaan' => 'required|max:40|regex:/^[a-zA-Z ]*$/',
            'nama_pemilik' => 'required|max:50|regex:/^[a-zA-Z,. ]*$/',
            'alamat' => 'required',
            'versi' => 'required|regex:/^[0-9. ]*$/',
            'password' => 'required|min:8|max:12',
            'no_hp' => 'required|max:12|regex:/^[0-9]*$/',
            'gambar' => 'required'
        ];
    }
}
