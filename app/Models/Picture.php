<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    protected $fillable = [
        'user_id',
        'img_path',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function picture()
    {
        return $this->belongsTo(Product::class);
    }
}
