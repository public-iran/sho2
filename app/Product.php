<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Gallery;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function galleries()
    {
        return $this->belongsToMany(Gallery::class);
    }
}
