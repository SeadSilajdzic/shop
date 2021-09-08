<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'user_id' => 'bail|required',
            'product_id' => 'bail|required',
            'order_status_id' => 'bail|required',
            'location' => 'bail|required|string',
            'address' => 'bail|required|string',
            'number' => 'bail|required',
            'status_changed' => 'nullable',
            'reqQuantity' => 'bail|required'
        ];
    }
}
