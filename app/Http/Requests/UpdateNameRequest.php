<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class UpdateNameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'regex:/^[\pL\s]+$/u', 'min:2', 'max:50'],
            'lastName' => ['required', 'string', 'regex:/^[\pL\s]+$/u', 'min:2', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'firstName.required' => 'We need to know your name!',
            'firstName.min' => 'That FirstName seems a bit too short.',
            'lastName.required' => 'We need to know your name!',
            'lastName.min' => 'That lastName seems a bit too short.',
        ];
    }
}
