<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class Galleryrequest extends FormRequest
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
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'photo.required' => 'Error! Anda Belum Memasukan File Foto Sparepart',
            'photo.mimes' => 'Error! File diTerima dalam bentuk JPEG, PNG, JPG',
            'photo.max' => 'Error! Size File Maximal :max',
        ];
    }
}
