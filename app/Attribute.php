<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class Attribute extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function attribute_values()
    {
        return $this->hasMany(Attribute_value::class);
    }

}
