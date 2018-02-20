<?php

namespace App\Http\Controllers;

use App\CommonSettings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommonSetingsController extends Controller
{
    function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index()
    {
        $data=[];

        $data['page_title']='Common Settings';

        $data['options']=CommonSettings::where('option_key','!=','logo')->get();

        return view('admin.common.index',$data);

    }

    public function create()
    {
        $data=[];

        $data['page_title']='Common Settings';

        return view('admin.common.create',$data);

    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'option_key'=>'required',
            'option_value'=>'required'

        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [

            'option_value' => trim($request->option_value),
            'option_key' => trim($request->option_key)

        ];

        CommonSettings::create($data);
        return redirect(route('common'))->with('success','new option added successfully');




    }

    public function logo()
    {
        $data=[];

        $data['page_title']='Logo Settings';
        $data['options']=CommonSettings::where('option_key','=','logo')->first();

        //dd($data);
        return view('admin.common.logo',$data);

    }

    public function update(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'option_key'=>'required',
            'option_value'=>'required'
        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $target=CommonSettings::where('option_key','=',trim($request->option_key))->first();

        $target->option_value=trim($request->option_value);
        $target->save();

        return redirect(route('common'))->with('success','update successfully');




    }

    public function logoUpdate(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'font_image'=>'required'

        ]);


        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $target=CommonSettings::where('option_key','=','logo')->first();

        $target->option_value=ltrim($request->font_image, '.');
        $target->save();

        return redirect(route('logo'))->with('success','Logo update successfully');




    }
}
