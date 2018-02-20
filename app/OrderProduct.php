<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table ='order_products';
    protected $guarded=[''];

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
    public function Order()
    {
        return $this->hasOne('App\Order');
    }

    public function UserOrderShipping()
    {
        return $this->hasOne('App\UserPreOrderShipping');
    }
}
