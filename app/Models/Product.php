<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Product $product) {
            DB::transaction(function () use ($product) {
                $product->loadMissing(['pictures', 'feedbacks', 'reports', 'orders']);

                $product->orders()->detach();

                foreach ($product->pictures as $picture) {
                    if (Storage::disk('public')->exists($picture->img_path)) {
                        Storage::disk('public')->delete($picture->img_path);
                    }
                    $picture->delete();
                }

                $product->feedbacks()->delete();
                $product->reports()->delete();
            });
        });
    }
}
