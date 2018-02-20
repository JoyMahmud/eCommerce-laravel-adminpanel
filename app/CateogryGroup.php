<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CateogryGroup extends Model
{
    protected $table='category_groups';

    protected $guarded=[''];

    protected $appends = array('items');


    public function getItemsAttribute()
    {
        return Category::where('root',$this->category_id)->where('category_group_id',$this->id)->get();
    }



}
