<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemasukanRequest extends FormRequest
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
        if (request('jenis') == 1) {
            return [
                'tanggal' => 'required',
                'id_jenis_infaq' => 'required',
                'jumlah' => 'required',
                'keterangan' => 'required|regex:/^([a-zA-Z0-9-., ]*)$/'
            ];
        } else {
            return [
                'tanggal' => 'required',
                'id_donatur' => 'required',
                'jumlah' => 'required',
                'keterangan' => 'required|regex:/^([a-zA-Z0-9-., ]*)$/'
            ];
        }
    }
}
