<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'name' => 'required|string|min:4',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:3',
            'confirm-password' => 'required|string|min:3|same:password',
            'role' => 'required|exists:roles,name'
        ];
    }
}
