<?php

namespace App\Http\Controllers;

use App\Category;
use App\CateogryGroup;
use App\Country;
use App\SpecialOffer;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    function __construct()
    {
        if(Auth::check() && Auth::user()->role == 'user')
        {
            redirect(route('dashboard'));
        }
    }
    public function login()
    {
        $data = [];
        $data['page_title'] = 'Customer Login';
        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        return view('frontend.login', $data);
    }
    public function register()
    {
        $data = [];
        $data['page_title'] = 'Create New Customer Account';
        $data['country'] = Country::all();
        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        return view('frontend.register', $data);
    }
    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6|max:30'
        ]);
        $remember = $request->has('remember') ? true : false;
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
            $credential = [
                'email'     => $request->email,
                'password'  => $request->password,
                'role'      => 'user'
            ];
            $auth = Auth::attempt($credential,$remember);
            if($auth)
            {
                Session::flash('message', 'Something Went Wrong.Please Try Again');
                Session::flash('alert-class', 'alert-danger');
                $url = Session::get('pre_login_url');
                Session::forget('pre_login_url');
                //dd($url);
                //return Redirect::to($url);
                return redirect()->intended(route('dashboard'));
            }
            else
            {
                Session::flash('message', "Please check your given email or password");
                return Redirect::back()->withInput();
            }
    }
    public function registerPost(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30',
            'country' => 'required'
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $UserArray = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'country' => $request->country,
            'active_status' => '1',
            'role' => 'user'
        ];
        $create=User::create($UserArray);
        if($create)
        {
            Mail::send('emails.registration',['user' => $create],function($m) use($create){
                $m->from('admin@shoppingzonebd.com','ShoppingZoneBD');
                $m->to($create->email,$create->first_name)->subject('ShoppingZoneBD Account Registration');
            });
            $credential = [
                'email'     => $create->email,
                'password'  => $request->password
            ];
            $auth = Auth::attempt($credential);
            if($auth)
            {
                return redirect()->intended(route('dashboard'));
            }
            else
            {
                return redirect('signin');
            }
        }
        else
        {
            Session::flash('message', "Something went wrong, please try again");
            return Redirect::back();
        }
    }
    /**
     * Get out door here
     */
    public function logout()
    {
        //Now get out please.
        Auth::logout();
        Cart::destroy();
        return redirect(route('home'));
        //return redirect()->back();
    }
}