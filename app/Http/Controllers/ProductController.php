<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Helpers\MainHelper;
use App\Manufacture;
use App\MeasurementAttribute;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index()
    {
        $data=[];

        $data['page_title']='Product';

        return view('admin.product.index',$data);
    }




    public function productData()
    {
        $products =Product::orderBy('created_at', 'desc')->select('id','name','model','sku','front_image','date_available','stock_status','hot_label','is_homepage','created_at','deleted_at')->withTrashed();


        return \Datatables::of($products)

            ->addColumn('Action', function($product){

                $html= '
                <a href="'.route('product_edit', $product->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>

                ';
                if($product->deleted_at !='')

                    $html.='<a href="'.route('product_soft_delete_restore', $product->id).'" class="btn bg-olive margin"><i class="fa fa-fw fa-recycle"></i></i>Enable</a>';

                else

                    $html.='<a href="'.route('product_soft_delete', $product->id).'" class="btn bg-navy margin"><i class="fa fa-times"></i></i>Disable</a>';



                return $html;
            })
            ->addColumn('ProductImage', function($ProductImage){

                $html= '<a  href=" '.route('product_image',$ProductImage->id).' "  class="btn bg-purple margin"><i class="fa fa-eye"></i>View Image</a>
                <a  href=" '.route('add_image',$ProductImage->id).' "  class="btn bg-purple margin"><i class="fa fa-eye"></i>Add Image</a>
                ';


                return $html;
            })

            ->editColumn('front_image',function($front_image){

                if(empty($front_image->front_image))
                {
                    $html=' ';
                }
                else
                {

                    $html='<a id="single_1"  href="'.$front_image->front_image.'" title=" '.$front_image->name.' "><img src=" '.$front_image->front_image.' " alt="" width="75px"/></a>';
                }

                return $html;
            })
            ->editColumn('hot_label', function($hot_label){

                switch($hot_label->hot_label)
                {
                    /*
                     * 0= women, 1 = men, 2=both
                     *
                     */

                    case '0': return '<span class="badge bg-red"><i class="fa fa-times-circle"></i></span>'; break;
                    case '1': return '<span class="badge bg-green"><i class="fa fa-check"></i></span>'; break;
                    default: return '<span class="badge bg-red"><i class="fa fa-times-circle"></i></span>';

                }

            })
            ->editColumn('is_homepage', function($is_homepage){

                switch($is_homepage->is_homepage)
                {
                    /*
                     * 0= women, 1 = men, 2=both
                     *
                     */

                    case '0': return '<span class="badge bg-red"><i class="fa fa-times-circle"></i></span>'; break;
                    case '1': return '<span class="badge bg-green"><i class="fa fa-check"></i></span>'; break;
                    default: return '<span class="badge bg-red"><i class="fa fa-times-circle"></i></span>';

                }

            })
            ->editColumn('date_available', function($creation){
                return $creation->date_available;
            })
            ->remove_column('deleted_at')
            ->make(true);
    }

    public function create()
    {

        $data=[];
        $data['page_title']='Product Create';
        $data['all_length']=MeasurementAttribute::where('type','=','length')->get();
        $data['all_weight']=MeasurementAttribute::where('type','=','weight')->get();
        $data['category']=Category::where('root',0)->orderBy('created_at', 'desc')->get();
        $data['manufacture']=Manufacture::all();
        return view('admin.product.create',$data);
    }

    public function store(Request $request)
    {



        $validator=Validator::make($request->all(),[

            'name'=>'required',
            'description'=>'required',
            'model'=>'required',
            //'sku'=>'required',
            'minimum_quantity'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'font_image'=>'required',
            'quantity'=>'required',
            'inside_dhaka_charge'=>'required',
            'other_charge'=>'required'
        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->has('date_available'))
        {
            $date_available=$request->date_available;
        }
        else
        {
            $date_available=date("Y-m-d");
        }
        if($request->has('hot_label'))
        {
            $hot_label=1;
        }
        else
        {
            $hot_label=0;
        }

        $stock_status=$request->stock_status;

        if($request->has('is_homepage'))
        {
            $is_homepage=1;
        }
        else
        {
            $is_homepage=0;
        }

        if($request->has('is_pre_order'))
        {
            $is_pre_order=1;
            $stock_status='pre_order';
        }
        else
        {
            $is_pre_order=0;
        }

        if($request->has('is_featured'))
        {
            $is_featured=1;
        }
        else
        {
            $is_featured=0;
        }
        if($request->has('is_taxable'))
        {
            $is_taxable=1;
        }
        else
        {
            $is_taxable=0;
        }

        if($request->has('special_deal'))
        {
            $special_deal=1;
        }
        else
        {
            $special_deal=0;
        }


        if($request->has('special_offer'))
        {
            $special_offer=$request->special_offer;
        }
        else
        {
            $special_offer=0;
        }

        if($request->has('pre_order_amount'))
        {
            $pre_order_amount=$request->pre_order_amount;
        }
        else
        {
            $pre_order_amount=500;
        }


/*        if($request->has('color'))
        {
            $color=MainHelper::getColorName($request->color);
        }
        else
        {
            $color='';
        }*/

//$string=ltrim('./product_image/Bollywood/1476813695.jpg', '.');
//substr($string, strpos($string, '/', strpos($string, '/') + 1) + 1);
        $data=[

            'name'=>$request->name,
            'slug'=>str_slug($request->name, "-"),
            'description'=>$request->description,
            'model'=>$request->model,
            'sku'=>$request->sku,
            'upc'=>$request->upc,
            'mpn'=>$request->mpn,
            'isbn'=>$request->isbn,
            'location'=>$request->location,
            'price'=>$request->price,
            'color'=>$request->color,
            'quantity'=>$request->quantity,
            'minimum_quantity'=>$request->minimum_quantity,
            'stock_status'=>$stock_status,
            'front_image'=>substr(ltrim($request->font_image, '.'), strrpos(ltrim($request->font_image, '.'), '/') + 1),
            'secondary_front_image'=>substr(ltrim($request->secondary_front_image, '.'), strrpos(ltrim($request->secondary_front_image, '.'), '/') + 1),
            'details_image'=>substr(ltrim($request->font_image, '.'), strpos(ltrim($request->font_image, '.'), '/', strpos(ltrim($request->font_image, '.'), '/') + 1) + 1),
            'secondary_details_image'=>substr(ltrim($request->secondary_front_image, '.'), strpos(ltrim($request->secondary_front_image, '.'), '/', strpos(ltrim($request->secondary_front_image, '.'), '/') + 1) + 1),
            'date_available'=>$date_available,
            'dimension_length'=>$request->dimension_length,
            'dimension_width'=>$request->dimension_width,
            'dimension_height'=>$request->dimension_height,
            'length_class'=>$request->length_class,
            'weight'=>$request->weight,
            'weight_class'=>$request->weight_class,
            'status'=>1,
            'manufacturer_id'=>$request->manufacturer_id,
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'discount'=>$request->discount,
            'reward_point'=>$request->reward_point,
            'hot_label'=>$hot_label,
            'is_homepage'=>$is_homepage,
            'is_featured'=>$is_featured,
            'is_taxable'=>$is_taxable,
            'is_pre_order'=>$is_pre_order,
            'pre_order_amount'=>$pre_order_amount,
            'tax_amount'=>$request->tax_amount,
            'meta_tag_description'=>$request->meta_tag_description,
            'meta_keyword_description'=>$request->meta_keyword_description,
            'free_of_charge'=>empty($request->free_of_cost) ? 'no' : $request->free_of_cost,
            'inside_dhaka_free_of_charge'=>empty($request->inside_dhaka_free_of_charge) ? 'no' : $request->inside_dhaka_free_of_charge,
            'inside_dhaka_charge'=>$request->inside_dhaka_charge,
            'other_charge'=>$request->other_charge
        ];
        $insert_data=Product::create($data);

        if($insert_data)
        {
            $path_new=str_replace('http://'.$_SERVER['SERVER_NAME'].'/product_image_home_thumbs/','product_image_home_thumbs/',$insert_data->front_image);

            if(!file_exists($path_new))
            {

                $file=$insert_data->front_image;
                $target=substr($file, strrpos($file, '/') + 1);
               // $img=Image::make($insert_data->details_image);
                $img=Image::make(str_replace(' ','%20',$insert_data->details_image));
                //$img->resize(195,243);
                // resize the image to a height of 200 and constrain aspect ratio (auto width)
                $img->resize(182, 243, function ($constraint) {
                    //$constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save('product_image_home_thumbs/'.$target);
            }

            if($request->has('secondary_front_image'))
            {
                $path_newSecondary=str_replace('http://'.$_SERVER['SERVER_NAME'].'/product_image_home_thumbs/','product_image_home_thumbs/',$insert_data->secondary_front_image);

                if(!file_exists($path_newSecondary))
                {

                    $fileSecondary=$insert_data->secondary_front_image;
                    $targetSecondary=substr($file, strrpos($fileSecondary, '/') + 1);
                    // $img=Image::make($insert_data->details_image);
                    $imgSecondary=Image::make(str_replace(' ','%20',$insert_data->secondary_details_image));
                    //$img->resize(195,243);
                    // resize the image to a height of 200 and constrain aspect ratio (auto width)
                    $imgSecondary->resize(182, 243, function ($constraint) {
                        //$constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $imgSecondary->save('product_image_home_thumbs/'.$targetSecondary);
                }
            }
            $product_tag = $request->product_tag;
            $get_product_tag=explode(',',$product_tag);
            foreach($get_product_tag as $single_product_tag)
            {
                if(!empty($single_product_tag))
                {

                    $checkTagExist=Tag::where('title','=',ucfirst($single_product_tag))->first();

                    if($checkTagExist)
                    {
                        //get tag id and check with product tag
                        $checkProductTagExist=ProductTag::where('tag_id','=',$checkTagExist->id)->where('product_id','=',$insert_data->id)->first();

                        if($checkProductTagExist)
                        {

                        }
                        else
                        {

                            $product_tag_data=[
                                'tag_id'=>$checkTagExist->id,
                                'product_id'=>$insert_data->id
                            ];

                            ProductTag::create($product_tag_data);
                        }
                    }
                    else
                    {
                        $crate_tag_data=['title'=>ucfirst($single_product_tag)];
                        $create_tag=Tag::create($crate_tag_data);

                        //add this tag with product

                        $product_tag_data=[
                            'tag_id'=>$create_tag->id,
                            'product_id'=>$insert_data->id
                        ];

                        ProductTag::create($product_tag_data);
                    }

                }


            }




            return redirect(route('product'))->with('success','new product added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }

    }



    public function subCategory(Request $request)
    {
        $data = Category::where('root',$request->id)->get();
        $someJSON = json_encode($data);
        echo $someJSON;
    }

    public function productImage($id)
    {
        $data=[];

        $data['page_title']='Product Images';

        $data['productID']=$id;

        return view('admin.product.images',$data);
    }




    public function productImageData($id)
    {
        $product_images =ProductImage::where('product_id',$id)->orderBy('created_at', 'desc')->select('id','image','created_at');


        return \Datatables::of($product_images)

            ->addColumn('Action', function($product_image){

                $html= '<a href="#" class="btn bg-navy margin"  onClick="destroyFunction(this.id);" id="'.$product_image->id.'"><i class="fa fa-times"></i></i>Disable</a>';

                return $html;
            })

            ->editColumn('image',function($image){

                if(empty($image->image))
                {
                    $html=' ';
                }
                else
                {

                    $html='<a id="single_1"  href="'.$image->image.'" title=" Image"><img src=" '.$image->image.' " alt="" width="75px"/></a>';
                }

                return $html;
            })

            ->editColumn('created_at', function($creation){
                return $creation->created_at->format('F d, Y h:i A');
            })
            ->make(true);
    }


    public function addImage($id)
    {
        $data=[];

        $data['page_title']='Add Images';

        $data['productID']=$id;

        return view('admin.product.add_image',$data);
    }


    public function addImageDialog()
    {


        return view('admin.filemanager.dialog2');
    }

    public function storeImage(Request $request, $id)
    {

       foreach($request->image as $item)
       {
           $data=['product_id'=>$id,'image'=>ltrim($item, '.')];
           
           $insert=ProductImage::create($data);
       }

        return redirect(route('product_image',$id))->with('success','Product Image Added Successfully');
    }

    public function removeImage(Request $request)
    {
        $id=$request->id;
        $image=ProductImage::find($id);
        $image->delete();
        echo 'success';

    }

    public function softDelete($id)
    {
        $attribute = Product::find($id);
        $attribute->delete();
        return redirect(route('product'))->with('success','Product disabled successfully');
    }
    public function softDeleteRestore($id)
    {
        $attribute = Product::where('id', $id)->restore();

        return redirect(route('product'))->with('success','Product Enabled successfully');
    }





    public function edit($id)
    {

        $data=[];
        $details=Product::where('id',$id)->withTrashed()->first();
        //dd($details);
        $data['page_title']='Product Update';
        $data['all_length']=MeasurementAttribute::where('type','=','length')->get();
        $data['all_weight']=MeasurementAttribute::where('type','=','weight')->get();
        $data['category']=Category::where('root',0)->orderBy('created_at', 'desc')->get();
        $data['details']=$details;
        $data['sub_category']=Category::where('id',$details->subcategory_id)->first();
        $data['manufacture']=Manufacture::all();

        return view('admin.product.edit',$data);
    }

    public function update(Request $request,$id)
    {


        $validator=Validator::make($request->all(),[

            'name'=>'required',
            'description'=>'required',
            'model'=>'required',
            //'sku'=>'required',
            'minimum_quantity'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'font_image'=>'required',
            'quantity'=>'required',
            'inside_dhaka_charge'=>'required',
            'other_charge'=>'required'

        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->has('hot_label'))
        {
            $hot_label=1;
        }
        else
        {
            $hot_label=0;
        }



        if($request->has('is_homepage'))
        {
            $is_homepage=1;
        }
        else
        {
            $is_homepage=0;
        }

        if($request->has('is_pre_order'))
        {
            $is_pre_order=1;
        }
        else
        {
            $is_pre_order=0;
        }

        if($request->has('is_featured'))
        {
            $is_featured=1;
        }
        else
        {
            $is_featured=0;
        }
        if($request->has('is_taxable'))
        {
            $is_taxable=1;
        }
        else
        {
            $is_taxable=0;
        }

        if($request->has('special_deal'))
        {
            $special_deal=1;
        }
        else
        {
            $special_deal=0;
        }


        if($request->has('special_offer'))
        {
            $special_offer=$request->special_offer;
        }
        else
        {
            $special_offer=0;
        }

        if($request->has('pre_order_amount'))
        {
            $pre_order_amount=$request->pre_order_amount;
        }
        else
        {
            $pre_order_amount=500;
        }


/*
        if($request->has('color'))
        {
            $color=MainHelper::getColorName($request->color);
        }
        else
        {
            $color='';
        }*/

        $product=Product::where('id',$id)->withTrashed()->first();
        //$product=Product::find($id);
        //dd($product->front_image);
        //dd(substr(ltrim($request->font_image, '.'), strrpos(ltrim($request->font_image, '.'), '/') + 1));
        $product->name=$request->name;
        $product->slug=str_slug($request->name, "-");
        $product->description=$request->description;
        $product->model=$request->model;
        $product->sku=$request->sku;
        $product->upc=$request->upc;
        $product->mpn=$request->mpn;
        $product->isbn=$request->isbn;
        $product->location=$request->location;
        $product->price=$request->price;
        $product->color=$request->color;
        $product->minimum_quantity=$request->minimum_quantity;
        $product->quantity=$request->quantity;
        $product->stock_status=$request->stock_status;

        if(substr(ltrim($product->front_image, '.'), strrpos(ltrim($product->front_image, '.'), '/') + 1) != substr(ltrim($request->font_image, '.'), strrpos(ltrim($request->font_image, '.'), '/') + 1))
        {


            $product->front_image=substr(ltrim($request->font_image, '.'), strrpos(ltrim($request->font_image, '.'), '/') + 1);
            $product->details_image=substr(ltrim($request->font_image, '.'), strpos(ltrim($request->font_image, '.'), '/', strpos(ltrim($request->font_image, '.'), '/') + 1) + 1);
        }
        else
        {

            $path_new=str_replace('http://'.$_SERVER['SERVER_NAME'].'/product_image_home_thumbs/','product_image_home_thumbs/',$product->front_image);
            if(!file_exists($path_new))
            {

                $file=$product->front_image;
                $target=substr($file, strrpos($file, '/') + 1);
                //dd($product->details_image);
                $img=Image::make(str_replace(' ','%20',$product->details_image));

               // $img->resize(195,243);
                $img->resize(182, 243, function ($constraint) {
                    //$constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save('product_image_home_thumbs/'.$target);
            }

        }

        if($request->has('secondary_front_image'))
        {

            if(substr(ltrim($product->secondary_front_image, '.'), strrpos(ltrim($product->secondary_front_image, '.'), '/') + 1) != substr(ltrim($request->secondary_front_image, '.'), strrpos(ltrim($request->secondary_front_image, '.'), '/') + 1))
            {


                $product->secondary_front_image=substr(ltrim($request->secondary_front_image, '.'), strrpos(ltrim($request->secondary_front_image, '.'), '/') + 1);
                $product->secondary_details_image=substr(ltrim($request->secondary_front_image, '.'), strpos(ltrim($request->secondary_front_image, '.'), '/', strpos(ltrim($request->secondary_front_image, '.'), '/') + 1) + 1);

            }
            else
            {

                $path_new=str_replace('http://'.$_SERVER['SERVER_NAME'].'/product_image_home_thumbs/','product_image_home_thumbs/',$product->secondary_front_image);
                if(!file_exists($path_new))
                {

                    $file=$product->secondary_front_image;
                    $target=substr($file, strrpos($file, '/') + 1);
                    //dd($product->details_image);
                    $img=Image::make(str_replace(' ','%20',$product->secondary_details_image));

                    // $img->resize(195,243);
                    $img->resize(182, 243, function ($constraint) {
                        //$constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img->save('product_image_home_thumbs/'.$target);
                }

            }
        }
        else
        {
            $product->secondary_front_image='';
        }


        $product->date_available=$request->date_available;
        $product->dimension_length=$request->dimension_length;
        $product->dimension_width=$request->dimension_width;
        $product->dimension_height=$request->dimension_height;
        $product->length_class=$request->length_class;
        $product->weight=$request->weight;
        $product->weight_class=$request->weight_class;
        $product->manufacturer_id=$request->manufacturer_id;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->discount=$request->discount;
        $product->reward_point=$request->reward_point;
        $product->hot_label=$hot_label;
        $product->is_homepage=$is_homepage;
        $product->is_featured=$is_featured;
        $product->is_taxable=$is_taxable;
        $product->is_pre_order=$is_pre_order;
        $product->pre_order_amount=$pre_order_amount;
        $product->tax_amount=$request->tax_amount;
        $product->meta_tag_description=$request->meta_tag_description;
        $product->meta_keyword_description=$request->meta_keyword_description;
        $product->free_of_charge=empty($request->free_of_cost) ? $product->free_of_charge : $request->free_of_cost;
        $product->inside_dhaka_free_of_charge=empty($request->inside_dhaka_free_of_charge) ? $product->inside_dhaka_free_of_charge : $request->inside_dhaka_free_of_charge;
        $product->inside_dhaka_charge=$request->inside_dhaka_charge;
        $product->other_charge=$request->other_charge;

        //dd($data);
        $update=$product->save();

        if($update)
        {

            if(substr(ltrim($product->front_image, '.'), strrpos(ltrim($product->front_image, '.'), '/') + 1) != substr(ltrim($request->font_image, '.'), strrpos(ltrim($request->font_image, '.'), '/') + 1))
            {
                $file=ltrim($request->font_image, '.');
                $target=substr($file, strrpos($file, '/') + 1);

                $img=Image::make(str_replace('http://'.$_SERVER['SERVER_NAME'].'/product_image//product_image/','http://'.$_SERVER['SERVER_NAME'].'/product_image/',asset('product_image/'.ltrim($request->font_image, '.'))));
                $img->resize(182, 243, function ($constraint) {

                    $constraint->upsize();
                });
                $img->save('product_image_home_thumbs/'.$target);
            }

            else{}
            $delete_current_tag=ProductTag::where('product_id',$product->id)->delete();


            $product_tag = $request->product_tag;
            $get_product_tag=explode(',',$product_tag);
            foreach($get_product_tag as $single_product_tag)
            {
                if(!empty($single_product_tag))
                {

                    $checkTagExist=Tag::where('title','=',ucfirst($single_product_tag))->first();

                    if($checkTagExist)
                    {
                        //get tag id and check with product tag
                        $checkProductTagExist=ProductTag::where('tag_id','=',$checkTagExist->id)->where('product_id','=',$product->id)->first();

                        if($checkProductTagExist)
                        {

                        }
                        else
                        {

                            $product_tag_data=[
                                'tag_id'=>$checkTagExist->id,
                                'product_id'=>$product->id
                            ];

                            ProductTag::create($product_tag_data);
                        }
                    }
                    else
                    {
                        $crate_tag_data=['title'=>ucfirst($single_product_tag)];
                        $create_tag=Tag::create($crate_tag_data);

                        //add this tag with product

                        $product_tag_data=[
                            'tag_id'=>$create_tag->id,
                            'product_id'=>$product->id
                        ];

                        ProductTag::create($product_tag_data);
                    }

                }


            }


            return redirect(route('product'))->with('success',' product update successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }

    }



    public function getColorNameList(Request $request)
    {

        $term      = $request->term;
        $associate = array();
        $search    = DB::table('products')->select('color')->where('color','like','%'.$term.'%')->get();

        foreach ($search as $result) {


            $associate[] = ucwords($result->color);

        }
        //dd($associate);
        return json_encode($associate);

    }
    public function getTagNameList(Request $request)
    {

        $term      = $request->term;
        $associate = array();
        $search    = DB::table('tags')->select('title')->where('title','like','%'.$term.'%')->get();

        foreach ($search as $result) {


            $associate[] = ucwords($result->title);

        }
        //dd($associate);
        return json_encode($associate);

    }





















}
