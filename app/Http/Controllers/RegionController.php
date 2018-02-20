<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class RegionController extends Controller
{
    public function index()
    {
        $data=[];

        $data['page_title']='Region';

        return view('admin.region.index',$data);
    }


    public function regionData()
    {
        $regions =Region::orderBy('created_at', 'desc')->select('id','title','created_at');


        return \Datatables::of($regions)

            ->addColumn('Action', function($region){

                $html= '
                <a href="'.route('region_edit', $region->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>

                ';


                return $html;
            })

            ->make(true);
    }

    public function create()
    {

        $data=[];
        $data['page_title']='Region Create';
        return view('admin.region.create',$data);
    }

    public function store(Request $request)
    {


        $validator=Validator::make($request->all(),[

            'title'=>'required'

        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }




        $data=[

            'title'=>$request->title,
            'slug'=>str_slug($request->title, "-"),

        ];


        //dd($data);
        $insert_data=Region::create($data);

        if($insert_data)
        {
            return redirect(route('region'))->with('success','new region added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }

    }
    public function edit($id)
    {

        $data=[];
        $details=Region::find($id);
        $data['page_title']='Region Update';
        $data['details']=$details;
        return view('admin.region.edit',$data);
    }

    public function update(Request $request,$id)
    {


        $validator = Validator::make($request->all(), [

            'title' => 'required'

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $region=Region::find($id);


        $region->title=$request->title;
        $update=$region->save();

        if($update)
        {
            return redirect(route('region'))->with('success',' Region update successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
}
