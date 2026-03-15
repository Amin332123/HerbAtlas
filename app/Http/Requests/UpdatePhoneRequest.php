<?php



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Keep this true as long as you have 'auth' middleware on the route
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
                'string',
                
               'regex:/^\+?[0-9]{7,15}$/', 
                'unique:users,phone_number,' . $this->user()->id,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.required' => 'Please provide a phone number.',
            'phone_number.regex' => 'The phone number format is invalid (use international format).',
            'phone_number.unique' => 'This phone number is already in use by another account.',
        ];
    }
}