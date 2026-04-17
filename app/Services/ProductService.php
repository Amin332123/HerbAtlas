<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function storeProduct(array $data, ?array $images): Product
    {
        return DB::transaction(function () use ($data, $images) {
            $category = Category::where('title', $data['category'])->firstOrFail();

            $product = Product::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'category_id' => $category->id,
            ]);

            if ($images) {
                $this->uploadImages($product, $images);
            }

            return $product;
        });
    }

    public function updateProduct(Product $product, array $data, ?array $images, array $deletedPictureIds): Product
    {
        return DB::transaction(function () use ($product, $data, $images, $deletedPictureIds) {
            $category = Category::where('title', $data['category'])->firstOrFail();

            $product->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'category_id' => $category->id,
            ]);

            if (!empty($deletedPictureIds)) {
                $this->deletePictures($product, $deletedPictureIds);
            }

            if ($images) {
                $this->uploadImages($product, $images);
            }

            return $product;
        });
    }

    public function deleteProduct(Product $product): void
    {
        DB::transaction(function () use ($product) {
            $product->delete();
        });
    }

    private function uploadImages(Product $product, array $images): void
    {
        foreach ($images as $image) {
            $path = $image->store('products', 'public');
            Picture::create(['product_id' => $product->id, 'img_path' => $path]);
        }
    }

    private function deletePictures(Product $product, array $ids): void
    {
        $product->pictures()->whereIn('id', $ids)->get()->each(function ($picture) {
            $this->removeImageFile($picture->img_path);
            $picture->delete();
        });
    }

    private function removeImageFile(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}