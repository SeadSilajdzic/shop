<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

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
            'title' => 'bail|required|string',
            'description' => 'bail|required|string|max:2000',
            'featured' => 'nullable',
            'slug' => 'nullable',
            'user_id' => 'nullable|integer',
            'price' => 'bail|required',
            'quantity' => 'bail|required|integer'
        ];
    }
}
