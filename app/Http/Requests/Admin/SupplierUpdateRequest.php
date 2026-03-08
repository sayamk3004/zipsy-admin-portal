<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id') ?? $this->route('supplier');

        return [
            'f_name' => ['required', 'string', 'max:100'],
            'l_name' => ['nullable', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', Rule::unique('suppliers', 'phone')->ignore($id)],
            'address' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,bmp', 'max:2048'],
            'email' => ['required', 'email', 'max:190', Rule::unique('suppliers', 'email')->ignore($id)],
            'password' => ['nullable', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
            'confirmPassword' => ['nullable', 'same:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'confirmPassword.same' => translate('messages.password_does_not_match'),
            'password.regex' => translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters'),
        ];
    }
}