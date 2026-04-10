<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:40480',
            'deleted_pictures' => 'sometimes|array',
            'deleted_pictures.*' => 'integer|exists:pictures,id',
        ];
    }

    public function messages(): array
    {
        return [
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Only jpeg, png, jpg, gif are allowed.',
            'images.*.max' => 'Each image may not be larger than 2MB.',
            'deleted_pictures.*.exists' => 'One or more selected pictures no longer exist.',
        ];
    }
}
