<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table ='citys';
    protected $guarded=[''];


    public function region()
    {
        return $this->belongsTo(Region::class);

    }
}
