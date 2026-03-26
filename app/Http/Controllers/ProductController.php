<?php

namespace App\Http\Controllers;

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


    public function show($id) {
        $product = Product::where('id' , $id)->first();

        return view('productDetails', compact('product'));
    }


}
