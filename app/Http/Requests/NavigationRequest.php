<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavigationRequest extends FormRequest
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
        if (request('is_main_menu') != 0) {
            return [
                'title' => 'required|max:30|regex:/^[a-zA-Z ]*$/',
                'url' => 'required|max:30|regex:/^[a-zA-Z#-.\/]*$/',
                'icon' => 'required|max:30||regex:/^[a-zA-Z- ]*$/',
                'is_main_menu' => 'required',
                'is_aktif' => 'required'
            ];
        } else {
            return [
                'title' => 'required|max:30|regex:/^[a-zA-Z ]*$/',
                'url' => 'required|max:30|regex:/^[a-zA-Z#-.\/]*$/',
                'icon' => 'required|max:30||regex:/^[a-zA-Z- ]*$/',
                'nomor' => 'required|max:4|regex:/^[0-9]*$/',
                'is_main_menu' => 'required',
                'is_aktif' => 'required'
            ];
        }
    }
}
