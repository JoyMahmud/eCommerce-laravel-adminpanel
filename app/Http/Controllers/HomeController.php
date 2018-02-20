<?php

namespace App\Http\Controllers;

use App\CustomPagination\CustomPagination;
use App\Area;
use App\Articles;
use App\Category;
use App\CateogryGroup;
use App\Charge;
use App\City;
use App\CommonSettings;
use App\Country;
use App\Manufacture;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\ProductTag;
use App\Ratings;
use App\Region;
use App\Shipping;
use App\Slideshow;
use App\SpecialOffer;
use App\UserOrderShipping;
use App\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    //

    function __construct()
    {
        Session::put('pre_login_url', URL::current());
    }

    public function index()
    {
        $data = [];
        $data['page_title'] = 'Home';
        return view('frontend.welcome', $data);
    }
}
