<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;

class ProgramUpdateRequest extends FormRequest
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
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg,gif,jfif|max:5000',
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga_per_bulan' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'thumbnail.image' => 'Thumbnail harus berupa gambar!',
            'thumbnail.mimes' => 'Format Thumbnail harus berupa png,jpg,jpeg,gif,jfif!',
            'thumbnail.max' => 'Thumbnail maksimal 5MB!',
            // 'thumbnail.dimensions' => 'Ukuran Thumbnail maksimal 600 * 600!',
            'nama.required' => 'Nama tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'harga_per_bulan.required' => 'Harga tidak boleh kosong!',
            'harga_per_bulan.numeric' => 'Harga harus berupa angka!',
        ];
    }
}
