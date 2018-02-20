<?php

namespace App\Http\Controllers;

use App\City;
use App\Region;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        $data = [];
        $data['page_title'] = 'City';
        return view('admin.city.index',$data);
    }
    public function cityData()
    {
        $citys = City::orderBy('created_at', 'desc')->select('id','title','region_id','created_at');
        return \Datatables::of($citys)
            ->addColumn('Action', function($city){
                $html = '
                <a href="'.route('city_edit', $city->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>';
                return $html;
            })
            ->editColumn('region_id',function($region_id){
                return $region_id->region->title;
            })
            ->make(true);
    }
    public function create()
    {
        $data = [];
        $data['page_title'] = 'City Create';
        $data['region'] = Region::all();
        return view('admin.city.create',$data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'region_id' => 'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'title' => $request->title,
            'region_id' => $request->region_id,
            'slug' => str_slug($request->title, "-"),
        ];
        $insert_data = City::create($data);
        if($insert_data)
        {
            return redirect(route('city'))->with('success','new city added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
    public function edit($id)
    {
        $data = [];
        $details = City::find($id);
        $data['page_title'] = 'City Update';
        $data['region'] = Region::all();
        $data['details'] = $details;
        return view('admin.city.edit',$data);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'region_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $city = City::find($id);
        $city->title = $request->title;
        $city->region_id = $request->region_id;
        $update=$city->save();
        if($update)
        {
            return redirect(route('city'))->with('success',' City update successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
}