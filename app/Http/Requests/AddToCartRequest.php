<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'quantity' => 'required|integer|min:1|max:100',
        ];
    }
    public function messages()
    {
        return [
            'quantity.required' => 'Необходимо указать количество товара.',
            'quantity.integer' => 'Количество должно быть целым числом.',
            'quantity.min' => 'Минимальное количество товара — 1.',
            'quantity.max' => 'Максимальное количество товара — 100.',
        ];
    }
}
