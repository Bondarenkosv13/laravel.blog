<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'sku' => ['required', 'min:1', 'max:25',
                Rule::unique('products')
                    ->ignore(request()->route()->parameter('product')->id)
            ],
            'name' => ['required', 'min:2', 'max:150',
                Rule::unique('products')
                    ->ignore(request()->route()->parameter('product')->id)
            ],
            'short_description' => ['required', 'min:10'],
            'thumbnail' => ['image'],
            'products-images.*' => 'image'
        ];
    }
}
