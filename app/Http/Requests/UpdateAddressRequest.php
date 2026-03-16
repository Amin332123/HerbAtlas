<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'street' => 'required|string|min:5|max:255',
            'city' => 'required|string|min:2|max:100',
            'postal_code' => 'required|numeric|digits:5', // Perfect for Moroccan zip codes
            'region' => 'nullable|string|max:100',
        ];
    }


    public function messages(): array
    {
        return [
            'postal_code.digits' => 'The postal code must be exactly 5 digits.',
            'street.min' => 'Please provide a more detailed street address.',
        ];
    }
}
