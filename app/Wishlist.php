<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table ='user_wish_lists';
    protected $guarded=[''];

    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
