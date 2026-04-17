<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'different:old_password',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.regex' => 'Your password must contain at least one uppercase letter and one number.',
            'new_password.different' => 'New password must be different from your current password.',
        ];
    }
}
