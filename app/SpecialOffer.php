<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    protected $table='special_offers';

    protected $guarded=[''];

    public function getProduct()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
