<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(ProductSearchRequest $request): \Illuminate\Http\JsonResponse|\Illuminate\View\View
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

        $products = $query->latest()->paginate(20);
        $categories = Category::all();
        $isAdmin = auth()->check() && auth()->user()->role?->status === 'admin';

        if ($isAjax) {
            return response()->json([
                'products' => $products->map(function ($product) use ($isAdmin) {
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
                        'edit_url' => $isAdmin ? route('products.edit', $product->id) : null,
                        'delete_url' => $isAdmin ? route('products.destroy', $product->id) : null,
                    ];
                })->values(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'links' => $products->links()->toHtml(),
                ],
                'message' => $products->isEmpty() ? 'No products matched your search.' : null,
            ]);
        }

        return view('products', compact('products', 'categories'));
    }

    public function edit(int $id): \Illuminate\View\View
    {
        $product = Product::with(['pictures', 'category'])->findOrFail($id);
        $categories = Category::all();

        return view('productEdit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $product = Product::findOrFail($id);

        $deletedPictureIds = $request->input('deleted_pictures', []);
        if (! empty($deletedPictureIds)) {
            $ownedPictureIds = $product->pictures()->pluck('id')->toArray();
            $deletedPictureIds = array_intersect($deletedPictureIds, $ownedPictureIds);
        }

        $this->productService->updateProduct(
            $product,
            $request->validated(),
            $request->file('images'),
            $deletedPictureIds
        );

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->storeProduct(
            $request->validated(),
            $request->file('images')
        );

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function show(int $id): \Illuminate\View\View
    {
        $product = Product::with(['category', 'pictures'])->findOrFail($id);

        return view('productDetails', compact('product'));
    }



    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        $message = 'Product and all associated images removed successfully.';

        if (request()->expectsJson()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->route('products.index')->with('success', 'Product and all associated images removed successfully.');
    }
}
