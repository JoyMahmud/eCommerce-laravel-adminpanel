<?php

namespace App\Http\Controllers;

use App\Area;
use App\Charge;
use App\City;
use App\Product;
use App\Region;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ChargeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['page_title'] = 'Charge';
        return view('admin.charge.index',$data);
    }
    public function chargeData()
    {
        $areas = Charge::orderBy('created_at', 'desc')->select('id','value','region_id','city_id','area_id','created_at');
        return \Datatables::of($areas)
            ->addColumn('Action', function($area){
                $html = '
                <a href="'.route('charge_edit', $area->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>';
                return $html;
            })
            ->editColumn('region_id',function($region_id){
                return $region_id->region->title;
            })
            ->editColumn('city_id',function($city_id){
                return $city_id->city->title;
            })
            ->editColumn('area_id',function($area_id){
                return $area_id->area->title;
            })
            ->make(true);
    }
    public function create()
    {
        $data = [];
        $data['page_title'] = 'Charge Create';
        $data['region'] = Region::all();
        return view('admin.charge.create',$data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'value' => 'required',
            'region_id' => 'required',
            'area_id' => 'required',
            'city_id' => 'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'value' => $request->value,
            'region_id' => $request->region_id,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id
        ];
        $insert_data = Charge::create($data);
        if($insert_data)
        {
            return redirect(route('charge'))->with('success','new charge added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
    public function generateCityData(Request $request)
    {
        $choice = $request->choice;
        $result = '<option value =" ">Select</option>';
        $getData=City::where('region_id',$choice)->get();
        foreach ($getData as $data)
        {
            $result .= '<option value="'.$data['id'].'">'.$data['title'].'</option>';
        }
        echo json_encode($result);
    }
    public function generateAreaData(Request $request)
    {
        $choice = $request->choice;
        $result = '<option value =" ">Select</option>';
        $getData = Area::where('city_id',$choice)->get();
        foreach ($getData as $data)
        {
            $result .= '<option value="'.$data['id'].'">'.$data['title'].'</option>';
        }
        echo json_encode($result);
    }
    public function generateChargeDataOld(Request $request)
    {
        $choice = $request->choice;
        $getCharge = Charge::where('area_id',$choice)->first();
        if(empty($getCharge))
        {
            $getChargeValue = 0;
        }
        else
        {
            $getChargeValue = $getCharge->value;
        }
        $subtotal = Cart::total();
        $result = array(
            'charge' => $getChargeValue,
            'payable' => ($getChargeValue+$subtotal)
        );
        echo json_encode($result);
    }
    public function generateChargeData(Request $request)
    {
        $choice = $request->choice;
        $isInsideDhaka = Area::find($choice);
        $getChargeValue = 0;
        $subtotal = Cart::total();
        $contentdata = Cart::content();
        foreach($contentdata as $item)
        {
            $getItemInfo = Product::where('slug',$item->id)->first();
            if($getItemInfo->free_of_charge == 'yes'){
                $getChargeValue = ($getChargeValue+0);
            }
            else
            {
                if($isInsideDhaka->is_inside_dhaka == 'yes')
                {
                        if($getItemInfo->inside_dhaka_charge == 'yes'){
                            $getChargeValue = ($getChargeValue+0);
                        }
                        else
                        {
                            $getChargeValue = ($getChargeValue+$getItemInfo->inside_dhaka_charge);
                        }
                }
                else
                {
                        $getChargeValue = ($getChargeValue+$getItemInfo->other_charge);
                }
            }
        }
        $payable = $getChargeValue+$subtotal;
        $result = array(
            'charge' => $getChargeValue,
            'payable' => $payable
        );
        session(['charge_detail' => ['charge' => $getChargeValue,'payable' => $payable]]);
        echo json_encode($result);
    }
    public function generatePreOrderChargeData(Request $request)
    {
        $choice = $request->choice;
        $preorder_amount = $request->preorder_amount;
        $isInsideDhaka = Area::find($choice);
        $getChargeValue = 0;
        $subtotal = Cart::total();
        $contentdata = Cart::content();
        foreach($contentdata as $item)
        {
            $getItemInfo = Product::where('slug',$item->id)->first();
            if($getItemInfo->free_of_charge == 'yes'){
                $getChargeValue = ($getChargeValue+0);
            }
            else
            {
                if($isInsideDhaka->is_inside_dhaka == 'yes')
                {
                    if($getItemInfo->inside_dhaka_charge == 'yes'){
                        $getChargeValue = ($getChargeValue+0);
                    }
                    else
                    {
                        $getChargeValue = ($getChargeValue+$getItemInfo->inside_dhaka_charge);
                    }
                }
                else
                {
                    $getChargeValue = ($getChargeValue+$getItemInfo->other_charge);

                }
            }
        }
        $payable = ($getChargeValue+$subtotal+$preorder_amount);
        $result = array(
            'charge' => $getChargeValue,
            'payable' => $payable
        );
        session(['charge_detail' => ['charge' => $getChargeValue,'payable' => $payable]]);
        echo json_encode($result);
    }
    public function generatePreOrderChargeDataOld(Request $request)
    {
        $choice = $request->choice;
        $preorder_amount = $request->preorder_amount;
        $getCharge = Charge::where('area_id',$choice)->first();
        $result = array(
            'charge' => $getCharge->value,
            'payable' => ($getCharge->value + $preorder_amount)
        );
        echo json_encode($result);

    }
    public function edit($id)
    {
        $data = [];
        $details = Charge::find($id);
        $data['page_title'] = 'Charge Update';
        $data['region'] = Region::all();
        $data['city'] = City::where('id',$details->city_id)->first();
        $data['area'] = Area::where('id',$details->area_id)->first();
        $data['details'] = $details;
        return view('admin.charge.edit',$data);
    }
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'value' => 'required',
            'region_id' => 'required',
            'area_id' => 'required',
            'city_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $charge = Charge::find($id);
        $charge->value = $request->value;
        $charge->region_id = $request->region_id;
        $charge->area_id = $request->area_id;
        $charge->city_id = $request->city_id;
        $update=$charge->save();
        if($update)
        {
            return redirect(route('charge'))->with('success',' Charge update successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
}