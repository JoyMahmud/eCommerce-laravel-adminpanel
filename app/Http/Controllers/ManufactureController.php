<?php

namespace App\Http\Controllers;

use App\Manufacture;
use App\MeasurementAttribute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManufactureController extends Controller
{
    function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index()
    {
        $data=[];

        $data['page_title']='Manufacture';

        return view('admin.manufacture.index',$data);

    }



    public function manufactureData()
    {
        $categories = Manufacture::orderBy('created_at', 'desc')->select('id','name','icon','created_at','deleted_at')->withTrashed();



        return \Datatables::of($categories)

            ->addColumn('Action', function($manufacture){

                $html= '
                <a href="'.route('manufacture_edit', $manufacture->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>

                ';
                if($manufacture->deleted_at !='')

                $html.='<a href="'.route('manufacture_soft_delete_restore', $manufacture->id).'" class="btn bg-olive margin"><i class="fa fa-fw fa-recycle"></i></i>Enable</a>';

                else

                $html.='<a href="'.route('manufacture_soft_delete', $manufacture->id).'" class="btn bg-navy margin"><i class="fa fa-times"></i></i>Disable</a>';



                return $html;
            })

            ->editColumn('icon',function($icon){

                if(empty($icon->icon))
                {
                    $html=' ';
                }
                else
                {

                    $html='<img src=" '.$icon->icon.' " width="70px"/>';
                }

                return $html;
            })



            ->editColumn('created_at', function($creation){
                return $creation->created_at->format('F d, Y h:i A');
            })
            ->remove_column('deleted_at')
            ->make(true);
    }
    public function create()
    {

        $data=[];
        $data['page_title']='Add new manufacture';

        return view('admin.manufacture.create',$data);

    }


    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'name'=>'required',
            'font_image'=>'required'

        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

                    $data = [

                        'name' => $request->name,
                        'icon' => ltrim($request->font_image, '.'),
                        'short_description'=>$request->short_description

                    ];

                    Manufacture::create($data);
                    return redirect(route('manufacture'))->with('success','new manufacture added successfully');




    }




    public function softDelete($id)
    {
        $attribute = Manufacture::find($id);
        $attribute->delete();
        return redirect(route('manufacture'))->with('success','Manufacture disabled successfully');
    }
    public function softDeleteRestore($id)
    {
        $attribute = Manufacture::where('id', $id)->restore();

        return redirect(route('manufacture'))->with('success','Manufacture Enabled successfully');
    }

}