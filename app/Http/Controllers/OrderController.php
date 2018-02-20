<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\PaymentActivities;
use App\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class OrderController extends Controller
{
    public  function all()
    {
        $data = [];
        $data['page_title'] = 'All Order';
        return view('admin.order.index',$data);
    }
    public function allData()
    {
        $orders = Order::orderBy('created_at', 'desc')->select('id','user_id','order_no','subtotal','total','shipping_payable','payment','payment_status','shipping_status','created_at');
        return \Datatables::of($orders)
            ->addColumn('Action', function($order){
                $html = '';
                if($order->payment == 'cash')
                {
                    $html = '<div class="btn-group-vertical">
                      <a href = "'.route('cash_pay', $order->id).'" data-remote="false" data-toggle="modal" data-target="#cashPay" class="btn bg-olive margin">
                View Details
                </a>';
                    if($order->payment_status == 'complete')
                    {
                        $html .= '</div>';
                    }
                    else
                    {
                        $html .= '<button class="btn btn-success icon" onclick="cashPay('.$order->id.')">Pay Now</button></div>';
                    }
                }
                else
                {
                    if($order->payment_status == 'pending')
                    {
                        $html = '<span class="label label-info">Pending</span>';
                    }
                    elseif($order->payment_status == 'verification')
                    {
                        $html = '<span class="label label-warning">Not Verified</span>';
                    }
                    elseif($order->payment_status == 'complete')
                    {
                        $html = '<span class="label label-success">Complete</span>';
                    }
                }
                return $html;
            })
            ->editColumn('payment_status', function($payment){
                switch ($payment->payment_status){
                    case "verification":
                        $html = '<span class="label label-danger">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "pending":
                        $html = '<span class="label label-warning">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "complete":
                        $html = '<span class="label label-success">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    default:
                        $html = '<span class="label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('payment', function($payment){
                switch ($payment->payment){
                    case "cash":
                        $html = '<span class="label label-info">'.strtoupper($payment->payment).'</span>';
                        break;
                    case "online":
                        $html = '<span class="label label-success">'.strtoupper($payment->payment).'</span>';
                        break;
                    default:
                        $html = '<span class="label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('shipping_status', function($shipping_status){
                switch ($shipping_status->shipping_status){
                    case "in_progress":
                        $html = '<span class="label label-info">Processing</span>';
                        break;
                    case "delivered":
                        $html = '<span class="label label-success">Delivered</span>';
                        break;
                    default:
                        $html = '<span class="label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->make(true);
    }
    public function cashPay($orderId)
    {
        $data = [];
        $getDetails = Order::find($orderId);
        $data['order'] = $getDetails;
        return view('admin.order.add_cash_pay',$data);
    }
    public function getOrderItems(Request $request)
    {
        $order_id = $request->order_id;
        $items = OrderProduct::select('product_id','order_id','quantity','offer','created_at')
            ->where('order_id', '=', $order_id);
        return \Datatables::of($items)
            ->addColumn('name', function($item){
                $html = $item->product['name'];
                return $html;
            })
            ->editColumn('front_image',function($front_image){
                if(empty($front_image->product['front_image']))
                {
                    $html = ' ';
                }
                else
                {
                    $html = '<a id="single_1"  href="'.$front_image->product['front_image'].'" title=" '.$front_image->product['name'].' "><img src=" '.$front_image->product['front_image'].' " alt="" width="75px"/></a>';
                }
                return $html;
            })
            ->editColumn('', function($creation){
                return $creation->created_at;
            })
            ->make(true);
    }
    public function cashPayPost(Request $request)
    {
        $orderId = $request->order_id;
        $order_id = substr($orderId, 0, -5);
        $find_order = Order::find($orderId);
        $data = array(
            'user_id' => $find_order->user_id,
            'order_id' => $orderId,
            'tran_id' => '',
            'val_id' => '',
            'store_amount' => $find_order->subtotal,
            'error' => '',
            'status' => 'VALID',
            'bank_tran_id' => '',
            'currency' => 'BDT',
            'tran_date' => date("Y-m-d H:i:s"),
            'amount' => $find_order->subtotal,
            'card_type' => '',
            'card_no' => '',
            'card_issuer' => '',
            'card_brand' => '',
            'card_issuer_country' => '',
        );
        $insert = PaymentActivities::create($data);
        $find_order->payment_status = 'complete';
        $find_order->payment_activity_id = $insert->id;
        $find_order->save();
        echo 'true';
    }
    public  function complete()
    {
        $data = [];
        $data['page_title'] = 'Complete Order';
        return view('admin.order.complete',$data);
    }
    public function completeData()
    {
        $orders =Order::where('payment_status','complete')->orderBy('created_at', 'desc')->select('id','user_id','order_no','subtotal','total','shipping_payable','payment','payment_status','shipping_status','created_at');
        return \Datatables::of($orders)
            ->addColumn('Action', function($order){
                $html = '';
                if($order->payment == 'cash')
                {
                    $html = '<div class="btn-group-vertical">
                      <a href = "'.route('cash_pay', $order->id).'" data-remote = "false" data-toggle = "modal" data-target = "#cashPay" class = "btn bg-olive margin">
                View Details
                </a>';
                    if($order->payment_status == 'complete')
                    {
                        $html .= '</div>';
                    }
                    else
                    {
                        $html .= '<button class = "btn btn-success icon" onclick = "cashPay('.$order->id.')">Pay Now</button></div>';
                    }
                }
                else
                {
                    if($order->payment_status == 'pending')
                    {
                        $html = '<span class="label label-info">Pending</span>';
                    }
                    elseif($order->payment_status == 'verification')
                    {
                        $html = '<span class="label label-warning">Not Verified</span>';
                    }
                    elseif($order->payment_status == 'complete')
                    {
                        $html = '<span class="label label-success">Complete</span>';
                    }
                }
                return $html;
            })
            ->editColumn('payment_status', function($payment){
                switch ($payment->payment_status){
                    case "verification":
                        $html = '<span class="label label-danger">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "pending":
                        $html = '<span class="label label-warning">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "complete":
                        $html = '<span class="label label-success">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    default:
                        $html = '<span class="label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('payment', function($payment){
                switch ($payment->payment){
                    case "cash":
                        $html = '<span class = "label label-info">'.strtoupper($payment->payment).'</span>';
                        break;
                    case "online":
                        $html = '<span class = "label label-success">'.strtoupper($payment->payment).'</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('shipping_status', function($shipping_status){
                switch ($shipping_status->shipping_status){
                    case "in_progress":
                        $html = '<span class = "label label-info">Processing</span>';
                        break;
                    case "delivered":
                        $html = '<span class = "label label-success">Delivered</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->make(true);
    }
    public  function cash()
    {
        $data = [];
        $data['page_title'] = 'Cash Pay  Order';
        return view('admin.order.cash',$data);
    }
    public function cashData()
    {
        $orders = Order::where('payment','cash')->orderBy('created_at', 'desc')->select('id','user_id','order_no','subtotal','total','shipping_payable','payment','payment_status','shipping_status','created_at');
        return \Datatables::of($orders)
            ->addColumn('Action', function($order){
                $html = '';
                if($order->payment == 'cash')
                {
                    $html = '<div class = "btn-group-vertical">
                      <a href = "'.route('cash_pay', $order->id).'" data-remote = "false" data-toggle = "modal" data-target = "#cashPay" class = "btn bg-olive margin">
                View Details
                </a>';
                    if($order->payment_status =='complete')
                    {
                        $html .= '</div>';
                    }
                    else
                    {
                        $html .= '<button class = "btn btn-success icon" onclick = "cashPay('.$order->id.')">Pay Now</button></div>';
                    }
                }
                else
                {
                    if($order->payment_status == 'pending')
                    {
                        $html = '<span class = "label label-info">Pending</span>';
                    }
                    elseif($order->payment_status == 'verification')
                    {
                        $html = '<span class = "label label-warning">Not Verified</span>';
                    }
                    elseif($order->payment_status == 'complete')
                    {
                        $html = '<span class = "label label-success">Complete</span>';
                    }

                }
                return $html;
            })
            ->editColumn('payment_status', function($payment){
                switch ($payment->payment_status){
                    case "verification":
                        $html = '<span class = "label label-danger">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "pending":
                        $html = '<span class = "label label-warning">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "complete":
                        $html = '<span class = "label label-success">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    default:
                        $html = '<span class="label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('payment', function($payment){
                switch ($payment->payment){
                    case "cash":
                        $html = '<span class = "label label-info">'.strtoupper($payment->payment).'</span>';
                        break;
                    case "online":
                        $html = '<span class = "label label-success">'.strtoupper($payment->payment).'</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('shipping_status', function($shipping_status){
                switch ($shipping_status->shipping_status){
                    case "in_progress":
                        $html = '<span class = "label label-info">Processing</span>';
                        break;
                    case "delivered":
                        $html = '<span class = "label label-success">Delivered</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->make(true);
    }
    public  function preOrder()
    {
        $data = [];

        $data['page_title'] = 'Pre  Order';
        return view('admin.order.pre_order',$data);
    }
    public function preOrderData()
    {
        $orders = PreOrder::orderBy('created_at', 'desc')->select('id','user_id','order_no','price','pre_order_amount','shipping_payable','booking_payment_status','order_status','created_at');
        return \Datatables::of($orders)
            ->addColumn('Action', function($order){
                $html =' ';
                return $html;
            })
            ->editColumn('booking_payment_status', function($payment){
                switch ($payment->booking_payment_status){
                    case "verification":
                        $html = '<span class = "label label-danger">'.strtoupper($payment->booking_payment_status).'</span>';
                        break;
                    case "pending":
                        $html = '<span class = "label label-warning">'.strtoupper($payment->booking_payment_status).'</span>';
                        break;
                    case "complete":
                        $html = '<span class="label label-success">'.strtoupper($payment->booking_payment_status).'</span>';
                        break;
                    default:
                        $html = '<span class="label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('payment', function($payment){
                switch ($payment->payment){
                    case "cash":
                        $html = '<span class = "label label-info">'.strtoupper($payment->payment).'</span>';
                        break;
                    case "online":
                        $html = '<span class = "label label-success">'.strtoupper($payment->payment).'</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('order_status', function($shipping_status){
                switch ($shipping_status->order_status){
                    case "cancled":
                        $html = '<span class = "label label-danger">Cancled</span>';
                        break;
                    case "booking":
                        $html = '<span class = "label label-info">Booking</span>';
                        break;
                    case "delivered":
                        $html = '<span class = "label label-success">Delivered</span>';
                        break;
                    default:
                        $html = '<span class="label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('user_id',function ($user_id){

                $html = $user_id->user->first_name.' '.$user_id->user->last_name;
                return $html;
            })
            ->make(true);
    }
    public  function pending()
    {
        $data = [];
        $data['page_title'] = 'Online Pending  Order';
        return view('admin.order.pending',$data);
    }
    public function pendingData()
    {
        $orders = Order::where('payment','online')->orderBy('created_at', 'desc')->select('id','user_id','order_no','subtotal','total','shipping_payable','payment','payment_status','shipping_status','created_at');
        return \Datatables::of($orders)
            ->addColumn('Action', function($order){
                $html = '';
                if($order->payment == 'cash')
                {
                    $html = '<div class = "btn-group-vertical">
                      <a href = "'.route('cash_pay', $order->id).'" data-remote = "false" data-toggle = "modal" data-target = "#cashPay" class = "btn bg-olive margin">
                View Details
                </a>';
                    if($order->payment_status == 'complete')
                    {
                        $html .= '</div>';
                    }
                    else
                    {
                        $html .= '<button class = "btn btn-success icon" onclick = "cashPay('.$order->id.')">Pay Now</button></div>';
                    }
                }
                else
                {
                    if($order->payment_status == 'pending')
                    {
                        $html = '<span class = "label label-info">Pending</span>';
                    }
                    elseif($order->payment_status == 'verification')
                    {
                        $html = '<span class = "label label-warning">Not Verified</span>';
                    }
                    elseif($order->payment_status == 'complete')
                    {
                        $html = '<span class = "label label-success">Complete</span>';
                    }
                }
                return $html;
            })
            ->editColumn('payment_status', function($payment){
                switch ($payment->payment_status){
                    case "verification":
                        $html = '<span class = "label label-danger">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "pending":
                        $html = '<span class = "label label-warning">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    case "complete":
                        $html = '<span class="label label-success">'.strtoupper($payment->payment_status).'</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('payment', function($payment){
                switch ($payment->payment){
                    case "cash":
                        $html = '<span class = "label label-info">'.strtoupper($payment->payment).'</span>';
                        break;
                    case "online":
                        $html = '<span class = "label label-success">'.strtoupper($payment->payment).'</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->editColumn('shipping_status', function($shipping_status){
                switch ($shipping_status->shipping_status){
                    case "in_progress":
                        $html = '<span class = "label label-info">Processing</span>';
                        break;
                    case "delivered":
                        $html = '<span class = "label label-success">Delivered</span>';
                        break;
                    default:
                        $html = '<span class = "label label-danger">UNDEFINED</span>';
                }
                return $html;
            })
            ->make(true);
    }
}