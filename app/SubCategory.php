<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='categories';

    protected $guarded=[''];


/*
    public function getCategoryGroupIdAttribute($value)
    {
        $data=CateogryGroup::where('id',$value)->select('title')->first();
        if(empty($data))
        {
            return 0;
        }
        else
        {
            return $data->title;
        }


    }*/
}
