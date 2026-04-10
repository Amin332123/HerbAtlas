<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request): JsonResponse|RedirectResponse
    {
        $normalizedTitle = $this->normalizeTitle($request->validated('title'));

        $existingCategory = Category::query()
            ->whereRaw('LOWER(title) = ?', [mb_strtolower($normalizedTitle)])
            ->first();

        if ($existingCategory) {
            $message = 'This category already exists.';

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $message,
                    'category' => [
                        'id' => $existingCategory->id,
                        'title' => $existingCategory->title,
                    ],
                ], 200);
            }

            return back()->withInput()->with('error', $message);
        }

        $category = Category::create([
            'title' => $normalizedTitle,
        ]);

        $message = 'Category created successfully.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'category' => [
                    'id' => $category->id,
                    'title' => $category->title,
                ],
            ], 201);
        }

        return back()->with('success', $message);
    }

    protected function normalizeTitle(string $title): string
    {
        $title = trim($title);
        $title = preg_replace('/\s+/', ' ', $title) ?? $title;

        return mb_convert_case($title, MB_CASE_TITLE, 'UTF-8');
    }
}