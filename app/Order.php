<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table ='orders';
    protected $guarded=[''];
    public function OrderProduct()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function UserOrderShipping()
    {
        return $this->hasOne('App\UserOrderShipping');
    }
}
