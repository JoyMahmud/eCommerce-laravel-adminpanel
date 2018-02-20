<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table='slideshows';

    protected $guarded=[''];

    public function getProduct()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function getImageAttribute($value)
    {
        if($value)
        {
            return asset($value);
        }
    }
}
