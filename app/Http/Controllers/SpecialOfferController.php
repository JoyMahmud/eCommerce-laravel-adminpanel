<?php

namespace App\Http\Controllers;

use App\Product;
use App\SpecialOffer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SpecialOfferController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index()
    {
        $data=[];

        $data['page_title']='Special Offer';

        return view('admin.special_offer.index',$data);


    }

    /*
     * New Category create form page view
     *
     */
    public function create()
    {

        $data=[];
        $data['page_title']='Offer Create';
        $data['product_list']=Product::select('id','name','front_image')->get();

        return view('admin.special_offer.create',$data);

    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'expire_date' => 'required',
            'discount' => 'required',
            'product_id' => 'required'

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $data=[
            'expire_date'=>$request->expire_date,
            'discount'=>$request->discount,
            'product_id'=>$request->product_id
        ];

        $insert_data=SpecialOffer::create($data);

        if($insert_data)
        {
            $find=Product::find($request->product_id);

            $find->special_offer_id=$insert_data->id;
            $find->save();
            
            return redirect(route('offer'))->with('success','new offer added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }

    }





    public function offerData()
    {


        $offers = SpecialOffer::orderBy('expire_date', 'DESC');


        return \Datatables::of($offers)


            ->addColumn('Action', function($offer){

                $html= '';

                return $html;
            })

            ->addColumn('product_name', function($product_name){

                $html= $product_name->getProduct->name;

                return $html;
            })
            ->addColumn('product_image', function($product_image){

                if(empty($product_image->getProduct->front_image))
                {
                    $html=' ';
                }
                else
                {

                    $html='<a id="single_1"  href="'.$product_image->getProduct->front_image.'" title=" '.$product_image->getProduct->name.' "><img src=" '.$product_image->getProduct->front_image.' " alt="" width="75px"/></a>';
                }

                return $html;
            })
            ->addColumn('price', function($price){

                $html= $price->getProduct->price;

                return $html;
            })
            ->editColumn('created_at', function($creation){
                return $creation->created_at->format('F d, Y h:i A');
            })
            ->make(true);
    }
















}
