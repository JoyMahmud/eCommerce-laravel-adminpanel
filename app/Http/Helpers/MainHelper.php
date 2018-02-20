<?php
namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;
use  App\Http\Helpers\ColorName;
use Intervention\Image\Facades\Image;

class MainHelper    {

    /**
     * @param null $slug_vlaue
     * @return string
     *
     *
     */
    public static function getHomeImage($path, $alt=null)
    {

        $path_new=str_replace('http://'.$_SERVER['SERVER_NAME'].'/product_image_home_thumbs/','product_image_home_thumbs/',$path);
        if(file_exists($path_new))
        {
            return asset($path);

        }
        else
        {
            $file=$path;
            $target=substr($file, strrpos($file, '/') + 1);
            $img=Image::make(asset($alt));

            $img->resize(195,243);
            $img->save('product_image_home_thumbs/'.$target);
            return asset($path);
        }

    }
    public static function getColorName($colorCode)
    {
        return  $colorInfo = ColorName::GetInfo($colorCode);
    }


    public static function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }



    public static function makeSlug($string)
    {
        $LNSH = '/[^\-\s\pN\pL]+/u';
        $SADH   = '/[\-\s]+/';

        $string = preg_replace($LNSH, '', mb_strtolower($string, 'UTF-8'));
        $string = preg_replace($SADH, '-', $string);
        $string = trim($string, '-');

        $time_start = self::microtime_float();

    // Sleep for a while
        usleep(100);

        $time_end = self::microtime_float();
        $time = $time_end - $time_start;


        $string=$string.'-'.$time;
        return $string;
    }

    public static function getIdFromSlug($slug,$table)
    {
        $getData=DB::table($table)->select('id')->where('slug',$slug)->first();


        return $getData->id;

    }
    public static function generateRating($ratings)
    {
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



}