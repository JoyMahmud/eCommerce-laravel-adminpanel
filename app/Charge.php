<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $table ='charges';
    protected $guarded=[''];


    public function region()
    {
        return $this->belongsTo(Region::class);

    }

    public function city()
    {
        return $this->belongsTo(City::class);

    }

    public function area()
    {
        return $this->belongsTo(Area::class);

    }
}
