<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function pictures() {
        return $this->hasMany(Picture::class);
    }
     
    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }


    public function orders()
    {
      return $this->belongsToMany(Order::class)
                ->withPivot('quantity', 'price')
                ->withTimestamps();
    }



    public function reports() {
        return $this->hasMany(Report::class);
    }

}
