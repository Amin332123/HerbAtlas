<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'category_id' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function reports(): HasMany
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