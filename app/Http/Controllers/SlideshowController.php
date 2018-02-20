<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slideshow;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class SlideshowController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('adminAuth');
    }


    public function index()
    {
        $data=[];

        $data['page_title']='Slideshow';

        return view('admin.slideshow.index',$data);


    }


    public function create()
    {

        $data=[];
        $data['page_title']='Slideshow Create';
        $data['product_list']=Product::select('id','name','front_image')->get();
        $data['category_list']=Category::where('root','!=',0)->get();

        return view('admin.slideshow.create',$data);

    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'text_line_one' => 'required',
            'font_image' => 'required'

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $data=[
            'text_line_one'=>trim($request->text_line_one),
            'text_line_two'=>trim($request->text_line_two),
            'text_line_three'=>trim($request->text_line_three),
            'text_line_one_color'=>trim($request->text_line_one_color),
            'text_line_two_color'=>trim($request->text_line_two_color),
            'text_line_three_color'=>trim($request->text_line_three_color),
            'image'=>$request->font_image,
            'product_id'=>$request->product_id,
            'category_id'=>$request->category_id
        ];

        $insert_data=Slideshow::create($data);

        if($insert_data)
        {
            return redirect(route('slideshow'))->with('success','new slide added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }

    }

    public function slideshowData()
    {


        $slideshows = Slideshow::orderBy('created_at', 'DESC');


        return \Datatables::of($slideshows)

            ->addColumn('Type', function($Type){

                if($Type->product_id == 0)
                {
                    $html= '<span class="label label-info">Category</span>';
                }
                else
                {
                    $html= '<span class="label label-info">Product</span>';
                }


                return $html;
            })
            ->addColumn('Action', function($slideshow){

                $html= '<a href="'.route('slideshow_delete',$slideshow->id).'" class="btn bg-navy margin"><i class="fa fa-times"></i></i>Delete</a>';


                return $html;
            })

            ->addColumn('product_name', function($product_name){


                if(empty($product_name->getProduct->name))
                {
                    $html=' ';
                }
                else
                {
                    $html= $product_name->getProduct->name;
                }
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

            ->editColumn('created_at', function($creation){
                return $creation->created_at->format('F d, Y h:i A');
            })
            ->editColumn('image', function($image){
                $html='<a id="single_1"  href="'.$image->getImage.'" title=" '.$image->getImage.' "><img src=" '.$image->getImage.' " alt="" width="75px"/></a>';
                return $html;
            })
            ->make(true);
    }




    
    public function delete($id)
    {
        $slideshow=Slideshow::find($id);

        $slideshow->delete();
        return redirect(route('slideshow'))->with('success','Slideshow removed successfully');

    }




}
