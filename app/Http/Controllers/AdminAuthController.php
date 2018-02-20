<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Redirect;

class AdminAuthController extends Controller
{
    function __construct()
    {
        $this->site_title = 'Laravel E-commerce Admin';

    }

    public function login()
    {
        $this->middleware('adminAuth');
        if(Auth::check() ){
            return redirect()->intended(route('admin_dashboard'));
        }
        $data = [];
        $data['site_title'] = $this->site_title;
        $data['page_title'] = 'Login';
        return view('admin.login', $data);

    }


    public function signIn(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $this->validate($request, $rules);

        $email = $request->input('email');
        $password = $request->input('password');

        $credential = [
            'email'     => $email,
            'password'  => $password
        ];

        $auth = Auth::attempt($credential);

        if($auth)
        {
            return redirect()->intended(route('admin_dashboard'));
        }
        else
        {
            return redirect()->back()->withInput()->with('message', 'Login Failed');

        }

    }
    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function logout()
    {
        Auth::logout();

        // Logs out the user...
        session()->flash('message', 'You have been logged out.');
        return redirect()->route('login');
    }


}
