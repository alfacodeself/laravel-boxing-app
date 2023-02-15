<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeRequest extends FormRequest
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
            'waktu' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'waktu.required' => 'Waktu tidak boleh kosong!',
            'jam_mulai.required' => 'Jam mulai tidak boleh kosong!',
            'jam_selesai.required' => 'Jam selesai tidak boleh kosong!',
        ];
    }
}
