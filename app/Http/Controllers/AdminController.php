<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Set the site title and admin authorization check.
     */
    function __construct()
    {

        $this->site_title = 'Dashboard';
        $this->middleware('adminAuth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'Login';
        return view('admin.dashboard', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        $data = [];
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'Dashboard';
        $data['products']=Product::all()->count();
        $data['sell']=Order::where('payment_status','complete')->sum('subtotal');
        $data['complete_order']=Order::where('payment_status','complete')->count();
        $data['incomplete_order']=Order::where('payment_status','pending')->count();
        $data['unverified_order']=Order::where('payment_status','verification')->count();
        $data['user']=User::where('role','user')->count();
        return view('admin.dashboard', $data);
    }
}
