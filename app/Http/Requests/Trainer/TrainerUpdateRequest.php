<?php

namespace App\Http\Requests\Trainer;

use Illuminate\Foundation\Http\FormRequest;

class TrainerUpdateRequest extends FormRequest
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
            'foto' => 'nullable|image|mimes:png,jpg,jpeg,gif,jfif|max:5000',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required',
            'alamat' => 'required',
            'foto_ktp' => 'nullable|image|mimes:png,jpg,jpeg,gif,jfif|max:5000',
            'cv' => 'nullable|file|max:10000',
        ];
    }
    public function messages()
    {
        return [
            'foto.image' => 'Foto harus berupa gambar!',
            'foto.mimes' => 'Format foto harus berupa png,jpg,jpeg,gif,jfif!',
            'foto.max' => 'Foto maksimal 5MB!',

            'foto_ktp.image' => 'Foto KTP harus berupa gambar!',
            'foto_ktp.mimes' => 'Format foto KTP harus berupa png,jpg,jpeg,gif,jfif!',
            'foto_ktp.max' => 'Foto KTP maksimal 5MB!',

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
