<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{

    //
    protected $table='product_tags';

    protected $guarded=[''];


    public function getTagName()
    {
        return $this->belongsTo('App\Tag','tag_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }



}
