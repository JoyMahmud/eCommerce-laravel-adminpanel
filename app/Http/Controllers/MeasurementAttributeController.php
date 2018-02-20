<?php

namespace App\Http\Controllers;

use App\MeasurementAttribute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MeasurementAttributeController extends Controller
{
    function __construct()
    {
        $this->middleware('adminAuth');
    }
    public function index()
    {
        $data = [];
        $data['page_title'] = 'Measurement Attribute';
        $data['all_length'] = MeasurementAttribute::where('type','=','length')->withTrashed()->get();
        $data['all_weight'] = MeasurementAttribute::where('type','=','weight')->withTrashed()->get();
        return view('admin.attribute.index',$data);
    }
    public function create()
    {
        $data = [];
        $data['page_title'] = 'Create Measurement Attribute';
        return view('admin.attribute.create',$data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'type' => 'required',
            'value' => 'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'value' => $request->value
        ];
        $insert_data=MeasurementAttribute::create($data);
        if($insert_data)
        {
            return redirect(route('attribute'))->with('success','new attribute added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
    public function softDelete($id)
    {
        $attribute = MeasurementAttribute::find($id);
        $attribute->delete();
        return redirect(route('attribute'))->with('success','Attribute disabled successfully');
    }
    public function softDeleteRestore($id)
    {
        $attribute = MeasurementAttribute::where('id', $id)->restore();
        return redirect(route('attribute'))->with('success','Attribute Enabled successfully');
    }
}