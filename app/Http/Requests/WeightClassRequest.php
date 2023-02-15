<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightClassRequest extends FormRequest
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
            'kelas_berat' => 'required',
            'minimal_berat' => 'required|numeric',
            'maksimal_berat' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'kelas_berat.required' => 'Kelas berat tidak boleh kosong!',
            'minimal_berat.required' => 'Minimal berat tidak boleh kosong!',
            'maksimal_berat.required' => 'Maksimal berat tidak boleh kosong!',
        ];
    }
}
