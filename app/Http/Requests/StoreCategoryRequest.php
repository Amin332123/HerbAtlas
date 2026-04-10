<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('title')) {
            $this->merge([
                'title' => is_string($this->title) ? trim(preg_replace('/\s+/', ' ', $this->title)) : $this->title,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\pN][\pL\pN\s\-\&\'\.]*[\pL\pN]$/u',
                Rule::unique('categories', 'title'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Category title is required.',
            'title.string' => 'Category title must be a string.',
            'title.max' => 'Category title may not be greater than 255 characters.',
            'title.regex' => 'Category title contains invalid characters.',
            'title.unique' => 'This category already exists.',
        ];
    }
}