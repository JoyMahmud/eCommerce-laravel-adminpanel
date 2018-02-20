<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    protected $table ='pre_orders';
    protected $guarded=[''];
    public function UserOrderShipping()
    {
        return $this->hasOne('App\UserPreOrderShipping');
    }

    public function Product()
    {

        //return $this->hasOne('App\Product','id','product_id');

        return $this->belongsTo('App\Product','product_id');
    }


    public function User()
    {
        return $this->belongsTo('App\User');
    }

}
