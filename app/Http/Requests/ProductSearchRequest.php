<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:120'],
            'category' => ['nullable', 'string', 'max:120', Rule::exists('categories', 'title')],
            'ajax' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'search.string' => 'Search text must be a valid string.',
            'search.max' => 'Search text is too long.',
            'category.exists' => 'The selected category is not valid.',
            'category.max' => 'Category name is too long.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'search' => is_string($this->search) ? trim($this->search) : $this->search,
            'category' => is_string($this->category) ? trim($this->category) : $this->category,
        ]);
    }
}
