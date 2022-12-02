<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => ['required','max:255', Rule::in(['tienda','envio'])],
            'shipping_address' => [Rule::requiredIf($this->type == 'envio'),'max:255'],
            'status' => Rule::in(['0','1','2','3','4']),
            'total' => ['required','numeric'],
            'user_id' => ['required','integer'],
            'products_array' => ['required'],
        ];
    }
}
