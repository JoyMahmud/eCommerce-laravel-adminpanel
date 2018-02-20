<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Category;
use App\CateogryGroup;
use App\Country;
use App\Order;
use App\OrderProduct;
use App\PreOrder;
use App\Product;
use App\Shipping;
use App\SpecialOffer;
use App\User;
use App\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //


    public function dashboard(){

        $data = [];
        $data['page_title'] = 'Customer Dashboard';

        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        return view('frontend.user.dashboard',$data);
    }

    public function getWishlist()
    {
        $data['page_title'] = 'Wish list';

        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        $data['wishData']=Wishlist::where('user_id',Auth::user()->id)->get();



        return view('frontend.user.wishlist',$data);
    }
    public function myOrders()
    {
        $data['page_title'] = 'My Order list';
        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        $data['orderData']=Order::where('user_id',Auth::user()->id)->orderByRaw("FIELD(payment_status, \"pending\", \"complete\")")->paginate(3);


        return view('frontend.user.orders',$data);
    }

    public function myPreOrders()
    {
        $data['page_title'] = 'My Pre Order list';
        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        $data['orderData']=PreOrder::where('user_id',Auth::user()->id)->orderByRaw("FIELD(order_status, \"booking\", \"cancled\", \"delivered\")")->paginate(3);

        return view('frontend.user.pre_orders',$data);
    }



    public function removeWishlistItem(Request $request)
    {
        $product_slug = $request->product_slug;
        $product_details = Product::where('slug',$product_slug)->first();
        $find_wish_list_product=Wishlist::where('user_id',Auth::user()->id)->where('product_id',$product_details->id)->first();

        $find_wish_list_product->delete();

        return response()->json(['status'=>'success','product_image'=>$product_details->front_image,'product_name'=>$product_details->name,'product_price'=>$product_details->price]);
    }


    public function profile()
    {
        $data['page_title'] = 'Profile';

        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        $data['details']=User::where('id',Auth::user()->id)->first();
        return view('frontend.user.update_profile',$data);
    }

    public function billing(){
        $data = [];
        $data['page_title'] = 'Customer Billing';

        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        $data['country']=Country::all();

        $billing=Billing::where('user_id',Auth::user()->id)->first();

        if($billing)
        {
            $data['billing'] = $billing;
            return view('frontend.user.update_billing',$data);

        }
        else
        {
            return view('frontend.user.new_billing',$data);
        }



    }

    public function shipping(){
        $data = [];
        $data['page_title'] = 'Customer Shipping';

        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        $data['country']=Country::all();

        $shipping=Shipping::where('user_id',Auth::user()->id)->first();

        if($shipping)
        {
            $data['shipping'] = $shipping;
            return view('frontend.user.update_shipping',$data);

        }
        else
        {
            return view('frontend.user.new_shipping',$data);
        }



    }


    public function newBilling(Request $request)
    {

        $validator=Validator::make($request->all(),[

            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'country'     => 'required',
            'address'     => 'required',
            'city'     => 'required',
            'state'     => 'required',
            'zip'     => 'required',
            'mobile'     => array('required','regex:/^(?:\+?88)?01[15-9]\d{8}$/')


        ]);


        if($validator->fails()){

            return Redirect::back()->withErrors($validator)->withInput();
        }


        $BillingArray=[
            'user_id'=>Auth::user()->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'address'=>$request->address,
            'city'=>$request->city,
            'country'=>$request->country,
            'state'=>$request->state,
            'post_code'=>$request->zip,
            'phone'=>$request->mobile,
            'company'=>$request->company,
            'fax'=>$request->fax
        ];

        $create=Billing::create($BillingArray);

        if($create)
        {
            Session::flash('message_type', "alert-success");
            Session::flash('message', "Billing Information Added Successfully");
            return redirect()->intended(route('billing'));
        }
        else
        {
            Session::flash('message_type', "alert-danger");
            Session::flash('message', "Something went wrong, please try again");
            return Redirect::back()->withInput();
        }


    }


    public function updateBilling(Request $request)
    {

        $validator=Validator::make($request->all(),[

            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'country'     => 'required',
            'address'     => 'required',
            'city'     => 'required',
            'state'     => 'required',
            'zip'     => 'required',
            'mobile'     => array('required','regex:/^(?:\+?88)?01[15-9]\d{8}$/')


        ]);


        if($validator->fails()){

            return Redirect::back()->withErrors($validator)->withInput();
        }


        $find=Billing::where('user_id',Auth::user()->id)->first();

        if($find)
        {
            $find->first_name=$request->first_name;
            $find->last_name=$request->last_name;
            $find->email=$request->email;
            $find->address=$request->address;
            $find->city=$request->city;
            $find->country=$request->country;
            $find->state=$request->state;
            $find->post_code=$request->zip;
            $find->phone=$request->mobile;
            $find->company=$request->company;
            $find->fax=$request->fax;

            $update=$find->save();

            if($update)
            {
                Session::flash('message_type', "alert-success");
                Session::flash('message', "Billing Information Update Successfully");
                return redirect()->intended(route('billing'));
            }
            else
            {
                Session::flash('message_type', "alert-danger");
                Session::flash('message', "Something went wrong, please try again");
                return Redirect::back()->withInput();
            }
        }
        else
        {
            Session::flash('message_type', "alert-warning");
            Session::flash('message', "Something went wrong, please try again");
            return Redirect::back()->withInput();
        }

    }




    public function newShipping(Request $request)
    {

        $validator=Validator::make($request->all(),[

            'first_name'=>'required',
            'last_name'=>'required',
            'country'     => 'required',
            'address'     => 'required',
            'city'     => 'required',
            'state'     => 'required',
            'zip'     => 'required',
            'mobile'     => array('required','regex:/^(?:\+?88)?01[15-9]\d{8}$/')


        ]);


        if($validator->fails()){

            return Redirect::back()->withErrors($validator)->withInput();
        }


        $BillingArray=[
            'user_id'=>Auth::user()->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'address'=>$request->address,
            'city'=>$request->city,
            'country'=>$request->country,
            'state'=>$request->state,
            'post_code'=>$request->zip,
            'phone'=>$request->mobile,
            'company'=>$request->company,
            'fax'=>$request->fax
        ];

        $create=Shipping::create($BillingArray);

        if($create)
        {
            Session::flash('message_type', "alert-success");
            Session::flash('message', "Shipping Information Added Successfully");
            return redirect()->intended(route('shipping'));
        }
        else
        {
            Session::flash('message_type', "alert-danger");
            Session::flash('message', "Something went wrong, please try again");
            return Redirect::back()->withInput();
        }


    }


    public function UpdateShipping(Request $request)
    {

        $validator=Validator::make($request->all(),[

            'first_name'=>'required',
            'last_name'=>'required',
            'country'     => 'required',
            'address'     => 'required',
            'city'     => 'required',
            'state'     => 'required',
            'zip'     => 'required',
            'mobile'     => array('required','regex:/^(?:\+?88)?01[15-9]\d{8}$/')


        ]);


        if($validator->fails()){

            return Redirect::back()->withErrors($validator)->withInput();
        }


        $find=Shipping::where('user_id',Auth::user()->id)->first();

        if($find)
        {
            $find->first_name=$request->first_name;
            $find->last_name=$request->last_name;
            $find->address=$request->address;
            $find->city=$request->city;
            $find->country=$request->country;
            $find->state=$request->state;
            $find->post_code=$request->zip;
            $find->phone=$request->mobile;
            $find->company=$request->company;
            $find->fax=$request->fax;

            $update=$find->save();

            if($update)
            {
                Session::flash('message_type', "alert-success");
                Session::flash('message', "Shipping Information Update Successfully");
                return redirect()->intended(route('shipping'));
            }
            else
            {
                Session::flash('message_type', "alert-danger");
                Session::flash('message', "Something went wrong, please try again");
                return Redirect::back()->withInput();
            }
        }
        else
        {
            Session::flash('message_type', "alert-warning");
            Session::flash('message', "Something went wrong, please try again");
            return Redirect::back()->withInput();
        }

    }



    public function changePassword(){
        $data = [];
        $data['page_title'] = 'Change Password';

        $data['subtotal'] = Cart::total();
        $data['totalcount'] = Cart::count();
        $data['contentdata'] = Cart::content();
        return view('frontend.user.change_password',$data);
    }


    public function changePasswordProcess(Request $request){



        $find=User::find(Auth::user()->id);


        $validator=Validator::make($request->all(),[

            'current_password'  =>'required',
            'new_password'      =>'required',
        'confirm_password'      => 'required'


        ]);

        $validator->after(function($validator) use ($request,$find) {
            $check = auth()->validate([
                'email'    => $find->email,
                'password' => $request->current_password
            ]);

            if (!$check):
                $validator->errors()->add('current_password',
                    'Your current password is incorrect, please try again.');
            endif;
        });
        if($validator->fails()){

            return Redirect::back()->withErrors($validator)->withInput();
        }


            $find->password=bcrypt($request->new_password);
            $update=$find->save();

            if($update)
            {
                Session::flash('message_type', "alert-success");
                Session::flash('message', "Authentication Information Update Successfully");
                return redirect()->intended(route('dashboard'));
            }
            else
            {
                Session::flash('message_type', "alert-danger");
                Session::flash('message', "Something went wrong, please try again");
                return Redirect::back()->withInput();
            }


    }


    public function OrderItems($orderId,$type=null)
    {

        $data=[];


        if($type =='pre')
        {
            $type='pre';
            $getDetails=PreOrder::find($orderId);
            $data['order']=$getDetails;
            $data['order_type']=$type;
            return view('frontend.user.pre_order_items',$data);
        }
        else
        {
            $type='regular';
            $getDetails=Order::find($orderId);
            $data['order']=$getDetails;
            $data['order_type']=$type;
            return view('frontend.user.order_items',$data);
        }

    }
    public function getOrderItems(Request $request)
    {

        $order_id=$request->order_id;
        $items = OrderProduct::select('product_id','order_id','quantity','offer','created_at')
            ->where('order_id', '=', $order_id);

        return \Datatables::of($items)

            ->addColumn('name', function($item){


                $html= $item->product['name'];


                return $html;
            })
            ->editColumn('front_image',function($front_image){

                if(empty($front_image->product['front_image']))
                {
                    $html=' ';
                }
                else
                {

                    $html='<a id="single_1"  href="'.$front_image->product['front_image'].'" title=" '.$front_image->product['name'].' "><img src=" '.$front_image->product['front_image'].' " alt="" width="75px"/></a>';
                }

                return $html;
            })

            ->editColumn('', function($creation){
                return $creation->created_at;
            })
            ->make(true);

    }
    public function getPreOrderItems(Request $request)
    {

        $order_id=$request->order_id;
        $items = PreOrder::select('id','order_no','price','pre_order_amount','created_at','product_id')
            ->where('id', '=', $order_id);
        return \Datatables::of($items)

            ->addColumn('name', function($item){


                $html= $item->product->name;


                return $html;
            })
            ->editColumn('front_image',function($front_image){

                if(empty($front_image->product->front_image))
                {
                    $html=' ';
                }
                else
                {

                    $html='<a id="single_1"  href="'.$front_image->product->front_image.'" title=" '.$front_image->product->name.' "><img src=" '.$front_image->product->front_image.' " alt="" width="75px"/></a>';
                }

                return $html;
            })

            ->editColumn('', function($creation){
                return $creation->created_at;
            })

            ->removeColumn('product_id')
            ->make(true);

    }
}
