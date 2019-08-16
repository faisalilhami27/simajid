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
            'nama_mesjid' => 'required|max:40|regex:/^[a-zA-Z- ]*$/',
            'ketua' => 'required|max:50|regex:/^[a-zA-Z,. ]*$/',
            'alamat' => 'required',
            'versi' => 'required|regex:/^[0-9. ]*$/',
            'password' => 'required|min:8|max:12',
            'kota' => 'required|regex:/^[a-zA-Z- ]*$/',
            'latitude' => 'required|regex:/^[-+]?[0-9]*\.?[0-9]+$/',
            'longitude' => 'required|regex:/^[-+]?[0-9]*\.?[0-9]+$/',
            'metode' => 'required|regex:/^[0-9. ]*$/',
        ];
    }
}
