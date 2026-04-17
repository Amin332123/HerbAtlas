<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required_without:items.*.product_id', 'nullable', 'integer', 'distinct', 'exists:products,id'],
            'items.*.product_id' => ['required_without:items.*.id', 'nullable', 'integer', 'distinct', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $items = collect($this->input('items', []))
            ->filter(fn ($item) => is_array($item))
            ->map(function ($item) {
                return [
                    'id' => $item['id'] ?? $item['product_id'] ?? null,
                    'quantity' => $item['quantity'] ?? null,
                ];
            })
            ->filter(function (array $item) {
                return filled($item['id']) && filled($item['quantity']);
            })
            ->values()
            ->all();

        $this->merge(['items' => $items]);
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Your cart is empty.',
            'items.min' => 'Your cart is empty.',
            'items.*.quantity.min' => 'Quantity must be at least 1.',
            'items.*.quantity.integer' => 'Quantity must be an integer.',
            'items.*.id.exists' => 'One or more selected products no longer exist.',
            'items.*.product_id.exists' => 'One or more selected products no longer exist.',
        ];
    }
}
