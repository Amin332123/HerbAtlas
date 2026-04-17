<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'status' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function getSubtotalAttribute(): float
    {
        return round($this->products->sum(function ($product) {
            return ((float) data_get($product, 'pivot.price', 0)) * ((int) data_get($product, 'pivot.quantity', 0));
        }), 2);
    }

    public function getTotalQuantityAttribute(): int
    {
        return (int) $this->products->sum(fn ($product) => (int) data_get($product, 'pivot.quantity', 0));
    }

    public function getItemsCountAttribute(): int
    {
        return (int) $this->products->count();
    }
}
