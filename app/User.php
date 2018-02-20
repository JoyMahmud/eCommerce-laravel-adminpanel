<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = array('user_image_api');


    public function getUserImageApiAttribute(){
        return $this->get_gravatar(100);
    }



    public function get_gravatar( $s = 40, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {

        $email = $this->email;
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";


        if( ! empty($this->image))
        {
            $url = asset('uploads/user/'.$this->image);
        }

        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }

        return $url;
    }

    public function getTotalPurchase()
    {
        return $this->hasMany('App\Order')->where('payment_status','complete')->sum('subtotal');
    }
    public function getTotalOrder()
    {
        return $this->hasMany('App\Order')->get();
    }
    public function getTotalPreOrder()
    {
        return $this->hasMany('App\PreOrder')->get();
    }
}
