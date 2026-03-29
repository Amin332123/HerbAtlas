<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'pictures')->get();
        $categories = Category::all();
        return view('products', compact('products', 'categories'));
    }

    public function edit($id)
    {
        $product = Product::with('pictures')->findOrFail($id);
        $categories = Category::all();
        return view('productEdit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $category = Category::where('title', $request->category)->first();

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $category->id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                Picture::create(['product_id' => $product->id, 'img_path' => $path]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function store(StoreProductRequest $request)
    {



        $category = Category::where('title', $request->category)->first();


        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $category->id,
        ]);
        $product->refresh();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                Picture::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                ]);
            }
        }


        return back();



    }


    public function show($id)
    {
        $product = Product::with(['category', 'pictures'])->findOrFail($id);

        return view('productDetails', compact('product'));
    }



    public function destroy(Product $product)
    {

        foreach ($product->pictures as $picture) {
          
            if (Storage::disk('public')->exists($picture->img_path)) {
                Storage::disk('public')->delete($picture->img_path);
            }
            $picture->delete();
        }
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product and all associated images removed successfully.');
    }


}
