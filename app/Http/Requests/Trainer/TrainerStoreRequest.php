<?php

namespace App\Http\Requests\Trainer;

use Illuminate\Foundation\Http\FormRequest;

class TrainerStoreRequest extends FormRequest
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
            'alamat' => 'required',
            'foto_ktp' => 'required|image|mimes:png,jpg,jpeg,gif,jfif|max:5000',
            'cv' => 'required|file|max:10000',
        ];
    }
    public function messages()
    {
        return [
            'foto.required' => 'Foto tidak boleh kosong!',
            'foto.image' => 'Foto harus berupa gambar!',
            'foto.mimes' => 'Format foto harus berupa png,jpg,jpeg,gif,jfif!',
            'foto.max' => 'Foto maksimal 5MB!',

            'foto_ktp.required' => 'Foto KTP tidak boleh kosong!',
            'foto_ktp.image' => 'Foto KTP harus berupa gambar!',
            'foto_ktp.mimes' => 'Format foto KTP harus berupa png,jpg,jpeg,gif,jfif!',
            'foto_ktp.max' => 'Foto KTP maksimal 5MB!',

            'cv.required' => 'Curriculum Vitae tidak boleh kosong!',
            'cv.file' => 'Curriculum Vitae harus berupa gambar!',
            'cv.max' => 'Curriculum Vitae maksimal 10MB!',

            'nama.required' => 'Nama tidak boleh kosong!',

            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong!',

            'tanggal_lahir.date' => 'Tanggal lahir harus berformat tanggal!',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong!',

            'nomor_hp.required' => 'Nomor Telepon tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
        ];
    }
}
