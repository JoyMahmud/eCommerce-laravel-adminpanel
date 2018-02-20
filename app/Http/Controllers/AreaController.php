<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data=[];
        $data['page_title']='Area';
        return view('admin.area.index',$data);
    }

    /**
     * @return mixed
     */
    public function areaData()
    {
        $areas =Area::orderBy('created_at', 'desc')->select('id','title','city_id','is_inside_dhaka','created_at');
        return \Datatables::of($areas)
            ->addColumn('Action', function($area){
                $html= '
                <a href="'.route('area_edit', $area->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>

                ';
                return $html;
            })
            ->editColumn('city_id',function($city_id){
                return $city_id->city->title;
            })
            ->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data=[];
        $data['page_title']='Area Create';
        $data['city']=City::all();
        return view('admin.area.create',$data);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'city_id'=>'required',
            'is_inside_dhaka'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data=[

            'title'=>$request->title,
            'city_id'=>$request->city_id,
            'is_inside_dhaka'=>$request->is_inside_dhaka,
            'slug'=>str_slug($request->title, "-"),

        ];
        $insert_data=Area::create($data);
        if($insert_data)
        {
            return redirect(route('area'))->with('success','new area added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data=[];
        $details=Area::find($id);
        $data['page_title']='Area Update';
        $data['city']=City::all();
        $data['details']=$details;
        return view('admin.area.edit',$data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'city_id'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $area=Area::find($id);
        $area->title=$request->title;
        $area->city_id=$request->city_id;
        $update=$area->save();
        if($update)
        {
            return redirect(route('area'))->with('success',' Area update successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
}
