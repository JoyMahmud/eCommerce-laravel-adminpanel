<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $table='product_images';

    protected $guarded=[''];


    public function getImageAttribute($value)
    {
        if($value)
        {
            return asset($value);
        }
    }
}
