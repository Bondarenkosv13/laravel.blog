<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'sku' => ['required', 'min:1', 'max:25', 'unique:products'],
            'name' => ['required', 'min:2', 'max:150', 'unique:products'],
            'short_description' => ['required', 'min:10'],
            'thumbnail' => ['required', 'image'],
            'products-images.*' => 'image'
        ];
    }
}
