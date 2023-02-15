<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'nama' => 'required',
            'nomor_hp' => 'required|numeric',
            'alamat' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong!',
            'nomor_hp.required' => 'Nomor Telepon tidak boleh kosong!',
            'nomor_hp.numeric' => 'Nomor Telepon harus berupa angka!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
        ];
    }
}
