<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'photo.required' => 'Please select an image to upload.',
            'photo.image' => 'The file must be an image (jpeg, png, bmp, gif, svg, or webp).',
            'photo.mimes' => 'Only JPEG, PNG, JPG, and WEBP files are allowed.',
            'photo.max' => 'The image is too large! Please upload a photo smaller than 2MB.',
        ];
    }
}
