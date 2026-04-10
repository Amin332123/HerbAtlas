<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(ProductSearchRequest $request)
    {
        $validated = $request->validated();
        $search = $validated['search'] ?? null;
        $category = $validated['category'] ?? null;
        $isAjax = $request->boolean('ajax') || $request->wantsJson() || $request->ajax();

        $query = Product::with(['category', 'pictures'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($category, function ($query) use ($category) {
                $query->whereHas('category', function ($categoryQuery) use ($category) {
                    $categoryQuery->where('title', $category);
                });
            });

        $products = $query->latest()->get();
        $categories = Category::all();

        if ($isAjax) {
            return response()->json([
                'products' => $products->map(function ($product) {
                    $picture = $product->pictures->first();
                    $imagePath = $picture?->img_path;

                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'description_excerpt' => str($product->description)->limit(110),
                        'stock' => $product->stock,
                        'price' => $product->price,
                        'category' => optional($product->category)->title,
                        'image' => $imagePath ? asset('storage/' . $imagePath) : null,
                        'details_url' => route('product.show', $product->id),
                        'edit_url' => route('products.edit', $product->id),
                        'delete_url' => route('products.destroy', $product->id),
                    ];
                })->values(),
                'message' => $products->isEmpty() ? 'No products matched your search.' : null,
            ]);
        }

        return view('products', compact('products', 'categories'));
    }

    public function edit($id)
    {
        $product = Product::with(['pictures', 'category'])->findOrFail($id);
        $categories = Category::all();

        return view('productEdit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::with('pictures')->findOrFail($id);
        $category = Category::where('title', $request->category)->firstOrFail();

        DB::transaction(function () use ($request, $product, $category) {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $category->id,
            ]);

            $deletedPictures = $request->input('deleted_pictures', []);
            if (!empty($deletedPictures)) {
                $picturesToDelete = $product->pictures()->whereIn('id', $deletedPictures)->get();

                foreach ($picturesToDelete as $picture) {
                    if (Storage::disk('public')->exists($picture->img_path)) {
                        Storage::disk('public')->delete($picture->img_path);
                    }
                    $picture->delete();
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    Picture::create([
                        'product_id' => $product->id,
                        'img_path' => $path,
                    ]);
                }
            }
        });

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function store(StoreProductRequest $request)
    {
        $category = Category::where('title', $request->category)->firstOrFail();

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $category->id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                Picture::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function show($id)
    {
        $product = Product::with(['category', 'pictures'])->findOrFail($id);

        return view('productDetails', compact('product'));
    }



    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->load(['pictures', 'feedbacks', 'reports', 'orders']);

            foreach ($product->pictures as $picture) {
                if (Storage::disk('public')->exists($picture->img_path)) {
                    Storage::disk('public')->delete($picture->img_path);
                }
                $picture->delete();
            }

            $product->orders()->detach();
            $product->feedbacks()->delete();
            $product->reports()->delete();

            $product->delete();
        });

        return redirect()->route('products.index')->with('success', 'Product and all associated images removed successfully.');
    }


}
