<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    //
    use SoftDeletes;
    protected $table='categories';

    protected $guarded=[''];

/*    protected $appends = array('sub_category');


    public function getSubCategoryAttribute()
    {
        return $this->belongsTo('App\SubCategory','id','root')->get();
    }*/


    public function product()
    {

        if($this->root =='0')
        {
            return $this->hasMany('App\Product','category_id','id')->select('id');
        }
        else
        {
            return $this->hasMany('App\Product','category_id','root')->select('id');
        }


    }

}
