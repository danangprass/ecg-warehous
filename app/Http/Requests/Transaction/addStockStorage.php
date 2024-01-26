<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class addStockStorage extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'product.*.id' => 'required|exists:products,id',
            'product.*.amount' => 'nullable|lte:product.*.available_amount',
        ];
    }

    // public function prepareForValidation() : void {
    //     $this->merge([
    //         'product.*.available_amount' => 
    //     ]);
    // }
}
