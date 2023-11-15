<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWisata extends FormRequest
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
            'nama' => 'required|max:50|regex:[[A-Za-z]+]',
            'daerah' => 'required|max:50',
            'alamat' => 'required',
            'fasilitas' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' =>  'required',
            'ulasan' =>  'required',
            'rating' =>  'required',
            'latitude' =>  'required|max:50',
            'longitude' =>  'required|max:50',
        ];
    }
}
