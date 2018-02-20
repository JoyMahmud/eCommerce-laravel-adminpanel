<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table ='areas';
    protected $guarded=[''];


    public function city()
    {
        return $this->belongsTo(City::class);

    }
}
