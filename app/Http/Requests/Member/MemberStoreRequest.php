<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class MemberStoreRequest extends FormRequest
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
            'foto' => 'required|image|mimes:png,jpg,jpeg,gif,jfif|max:5000',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required',
            'alamat' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'foto.required' => 'Foto tidak boleh kosong!',
            'foto.image' => 'Foto harus berupa gambar!',
            'foto.mimes' => 'Format foto harus berupa png,jpg,jpeg,gif,jfif!',
            'foto.max' => 'Foto maksimal 5MB!',
            'nama.required' => 'Nama tidak boleh kosong!',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong!',
            'tanggal_lahir.date' => 'Tanggal lahir harus berformat tanggal!',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
            'nomor_hp.required' => 'Nomor Telepon tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
        ];
    }
}
