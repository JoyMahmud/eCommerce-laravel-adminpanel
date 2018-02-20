<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use SoftDeletes;
    //
    protected $table='products';

    protected $guarded=[''];
    protected $dates = ['deleted_at'];
    public function getFrontImageAttribute($value)
    {
        if($value)
        {

            return asset('product_image_home_thumbs/'.$value);
        }
    }
    public function getSecondaryFrontImageAttribute($value)
    {
        if($value)
        {

            return asset('product_image_home_thumbs/'.$value);
        }
    }
    public function getDetailsImageAttribute($value)
    {
        if($value)
        {
            return asset('product_image/'.$value);
        }
    }
    public function getProductImage()
    {

        return $this->hasMany('App\ProductImage', 'product_id')->get();
    }

    public function getReview()
    {

        return $this->hasMany('App\Ratings', 'product_id')->get();
    }



    public function rating()
    {
        return $this->hasMany('App\Ratings', 'product_id');
    }


    public function getTotalRating()
    {

        $ratings=$this->hasMany('App\Ratings', 'product_id')->get();

        $value=0;
        $quality=0;
        $price=0;
        if(count($ratings) >0)
        {
            foreach($ratings as $rating)
            {

                $value+=$rating->value;
                $quality+=$rating->quality;
                $price+=$rating->price;


            }

            $rating=(($value+$quality+$price)/(count($ratings)*3));
        }
        else
        {
            $rating=0;
        }

        return $rating;
    }


    public function SimilerProduct()
    {
        return $this->hasMany('App\Product', 'category_id','category_id')->where('id', '!=', $this->id)->where('date_available', '<=', date('Y-m-d'))->orderBy(DB::raw('RAND()'))->with('rating','SpecialOffer')->limit(20);

    }

/*    public function getOfferDetails()
    {


        return $this->belongsTo('App\SpecialOffer','special_offer_id','id')->where('expire_date', '>=', strftime('%F'));


    }*/
    public function SpecialOffer()
    {


        return $this->belongsTo('App\SpecialOffer','special_offer_id','id')->where('expire_date', '>=', strftime('%F'));


    }

    public function getTag()
    {
        return $this->hasMany('App\ProductTag','product_id');
    }



}
