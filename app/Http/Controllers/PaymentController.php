<?php

namespace App\Http\Controllers;

use App\Events\Event;
use App\Events\ProductOrder;
use App\Listeners\SendEmail;
use App\Order;
use App\OrderProduct;
use App\PaymentActivities;
use App\PreOrder;
use App\ProcessingFees;
use App\Product;
use App\Shipping;
use App\UserPreOrderShipping;
use App\UserOrderShipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

class PaymentController extends Controller
{
    public function failPay(Request $request)
    {
            $user_id = Auth::user()->id;
            $order_id = substr($request->input('value_a'), 0, -5);
            $tran_id = $request->input('tran_id');
            $error = $request->input('error');
            $status = $request->input('status');
            $bank_tran_id = $request->input('bank_tran_id');
            $currency = $request->input('currency');
            $tran_date = $request->input('tran_date');
            $amount = $request->input('amount');
            $card_type = $request->input('card_type');
            $card_no = $request->input('card_no');
            $card_issuer = $request->input('card_issuer');
            $card_brand = $request->input('card_brand');
            $card_issuer_country = $request->input('card_issuer_country');
        $data=array(
            'user_id' => $user_id,
            'order_id' => $order_id,
            'tran_id' => $tran_id,
            'error' => $error,
            'status' => $status,
            'bank_tran_id' => $bank_tran_id,
            'currency' => $currency,
            'tran_date' => $tran_date,
            'amount' => $amount,
            'card_type' => $card_type,
            'card_no' => $card_no,
            'card_issuer' => $card_issuer,
            'card_brand' => $card_brand,
            'card_issuer_country' => $card_issuer_country,
        );
        $insert = PaymentActivities::create($data);
        Session::flash('message_type', "alert-danger");
        Session::flash('message', $error);
        return redirect()->back();
    }
    public function paySuccess(Request $request)
    {
        $isPreorder = 0;
        $preOrderAmount = 0;
            if($request->value_b == "regular_order")
            {
                $chargeData=session()->get('charge_data');
                $data=[
                    'region_id' => $chargeData['region_id'],
                    'order_no' => self::generate_order_number(),
                    'user_id' => Auth::user()->id,
                    'city_id' => $chargeData['city_id'],
                    'area_id' => $chargeData['area_id'],
                    'processing_fee' => $chargeData['processing_fee'],
                    'subtotal' => Cart::total(),
                    'total' => $chargeData['payable'],
                    'shipping_payable' => $chargeData['charge'],
                    'payment' => 'online'
                ];
                $create = Order::create($data);
                if($create) {
                    $find = Shipping::where('user_id', Auth::user()->id)->first();
                    $InfoArray = [
                        'order_id' => $create['id'],
                        'first_name' => $find->first_name,
                        'last_name' => $find->last_name,
                        'address' => $find->address,
                        'city' => $find->city,
                        'country' => $find->country,
                        'state' => $find->state,
                        'post_code' => $find->post_code,
                        'phone' => $find->phone,
                        'company' => $find->company,
                        'fax' => $find->fax
                    ];
                    $insert = UserOrderShipping::create($InfoArray);
                    foreach (Cart::content() as $cart_item) {
                        // echo $cart_item->id;
                        //dd($create->id);
                        $get_product_id = Product::where('slug', $cart_item->id)->first();
                        if ($get_product_id->is_pre_order == 1) {
                            $isPreorder = 1;
                            $preOrderAmount = $get_product_id->pre_order_amount;
                        }
                        $data = [
                            'order_id' => $create['id'],
                            'product_id' => $get_product_id->id,
                            'offer' => $cart_item->options['offer'],
                            'quantity' => $cart_item->qty,
                            'isPreorder' => $isPreorder,
                            'preOrderAmount' => $preOrderAmount,
                        ];
                        OrderProduct::create($data);
                    }
                    $order_id = $create->id;
                    self::pay_success_action($request,$order_id);
                    self::sendMail($order_id);
                    Cart::destroy();
                    //event(new SendEmail($order_id));
                }
            }
            else
            {
                $order_id = substr($request->input('value_a'), 0, -5);
                self::pay_success_action($request,$order_id);
                //event(new SendEmail($order_id));
                self::sendMail($order_id);
                Cart::destroy();
            }
        return redirect()->intended(route('order'));
    }
    private function sendMail($order_id)
    {
        $getOrderDetails = Order::find($order_id);
        $getOrderProducts = OrderProduct::where('order_id',$order_id)->get();
        $getOrderShippingInformation=UserOrderShipping::where('order_id',$order_id)->first();
        Mail::send('emails.product_order',['orderDetails'=>$getOrderDetails,'OrderProducts'=>$getOrderProducts,'ShippingInformation'=>$getOrderShippingInformation],function($m){
            $m->from('admin@shoppingzonebd.com','ShoppingZoneBD');
            $m->to(Auth::user()->email,Auth::user()->first_name)->subject('New Oder Placed Successfully');
        });
    }
    private function pay_success_action($request,$order_id)
    {
        $val_id = urlencode( $request->input('val_id'));
        $store_id = urlencode("test_shoppingzonebd001");
        $store_passwd = urlencode("test_shoppingzonebd001@ssl");
        $requested_url = "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd;
        $handle=curl_init();
        curl_setopt($handle, CURLOPT_URL,$requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER,false);
        $result = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($code == 200 && !(curl_errno($handle))) {
            $verification = 1;
            $error = '';
            # TO CONVERT AS OBJECT
            $result = json_decode($result);
            $user_id = Auth::user()->id;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $store_amount = $result->store_amount;
            $status = $result->status;
            $bank_tran_id = $result->bank_tran_id;
            $currency = $request->input('currency');
            $tran_date = $result->tran_date;
            $amount = $result->amount;
            $card_type = $result->card_type;
            $card_no = $result->card_no;
            $card_issuer = $result->card_issuer;
            $card_brand = $result->card_brand;
            $card_issuer_country = $result->card_issuer_country;
            $validated_on = $result->validated_on;
        } else {
            //unable to connect
            $verification = 0;
            $user_id = Auth::user()->id;
            $tran_id = $request->input('tran_id');
            $error = $request->input('error');
            $status = $request->input('status');
            $bank_tran_id = $request->input('bank_tran_id');
            $currency = $request->input('currency');
            $tran_date = $request->input('tran_date');
            $amount = $request->input('amount');
            $card_type = $request->input('card_type');
            $card_no = $request->input('card_no');
            $card_issuer = $request->input('card_issuer');
            $card_brand = $request->input('card_brand');
            $card_issuer_country = $request->input('card_issuer_country');
        }
        $data = array(
            'user_id' => $user_id,
            'order_id' => $order_id,
            'tran_id' => $tran_id,
            'val_id' => $val_id,
            'store_amount' => $store_amount,
            'error' => $error,
            'status' => $status,
            'bank_tran_id' => $bank_tran_id,
            'currency' => $currency,
            'tran_date' => $tran_date,
            'amount' => $amount,
            'card_type' => $card_type,
            'card_no' => $card_no,
            'card_issuer' => $card_issuer,
            'card_brand' => $card_brand,
            'card_issuer_country' => $card_issuer_country,
        );
        $insert = PaymentActivities::create($data);
        $find_order = Order::find($order_id);
        if ($verification == 1) {
            $find_order->payment_status = 'complete';
            $find_order->payment_activity_id = $insert->id;
            $find_order->save();
        }
        else
        {
            $find_order->payment_status = 'verification';
            $find_order->payment_activity_id = $insert->id;
            $find_order->save();
        }
        Session::flash('message_type', "alert-success");
        Session::flash('message', 'Your Payment Complete Against Order '.$find_order->order_no.'. Thank You');
    }
    public function generateProcessingList()
    {
        $getData=ProcessingFees::all();
        $html = '<div class = "form-group {{$errors->has(\'processing_methood\') ? \'has-error\' : \'\'}}">
               <label class = "info-title" for="exampleInputPassword1">Bank Process Method<span>*</span></label>
                <select onchange = "generateFee();"data-error="Please choose at least one option" class="form-control   unicase-form-control text-input" required id="processing_method" name="processing_method">
                <option value = "" selected>Please Select One</option>';
        foreach ($getData as $item)
        {
            $html .= '<option value="'.$item->fees.'">'.$item->title.'</option>';
        }
        $html .= '</select><div class="help-block with-errors"></div></div>';
        echo $html;
    }
    public function generatePaymentMethod(Request $request)
    {
        $chargeData = session()->get('charge_data');
        $choice = $request->choice;
        $html = '';
        if($choice == 'cash')
        {
            $html .= '<form id = "payment_gw" name="payment_gw" method="POST" action = "'.route('place_order').'">
            <input type = "hidden" name = "_token"  id = "_token" value="'.csrf_token().'">
                                            <div id = "place_order_area">
                                                <button type="submit" class="flat-butt flat-primary-butt">Place Order</button>
                                            </div></form>';
        }
        else
        {
            $html .= '
            <form id = "payment_gw" name = "payment_gw" method = "POST" action="https://sandbox.sslcommerz.com/gwprocess/v3/process.php">
            <input type = "hidden" name= "total_amount" value = "'.$chargeData['payable'].'" />
                                            <input type = "hidden" name = "store_id" value = "test_shoppingzonebd001" />
                                            <input type = "hidden" name = "tran_id" value = "'.time().str_random(5).'" />
                                            <input type = "hidden" name = "success_url" value = "'.route('pay_success_back').'">
                                            <input type = "hidden" name = "fail_url" value = "'.route('pay_fail_back').'">
                                            <input type = "hidden" name = "cancel_url" value = "'. route('pay_fail_back').'">
                                            <input type = "hidden" name = "value_b" value = "regular_order">
                                            <input type = "hidden" name = "version" value = "2.00" />
                                            <div id = "place_order_area">
                                                <button type = "submit" class = "flat-butt flat-primary-butt">Place Order</button>
                                            </div>
                                            </form>';
        }
        return $html;
    }
    public function generateFinalChargeData(Request $request)
    {
        $choice = $request->choice;
        $subtotal = Cart::total();
        $chargeData = session()->get('charge_data');
        $processing_fee = (($chargeData['payable']*$choice)/100);
        $processing_fee = round($processing_fee);
        session(['charge_data' => ['payable' => $chargeData['payable']+$processing_fee,'processing_fee' => $processing_fee,'charge' => $chargeData['charge'],'region_id' => $chargeData['region_id'],'city_id' => $chargeData['city_id'],'area_id' => $chargeData['area_id']]]);
        $result=array(
            'processing_fee' => $processing_fee,
            'payable' => ($chargeData['payable']+$processing_fee)
        );
        echo json_encode($result);
    }
    public function payPreOrderFail(Request $request)
    {
        $user_id = Auth::user()->id;
        $product_slug = substr($request->input('value_a'), 0, -5);
        $tran_id = $request->input('tran_id');
        $error = $request->input('error');
        $status = $request->input('status');
        $bank_tran_id = $request->input('bank_tran_id');
        $currency = $request->input('currency');
        $tran_date = $request->input('tran_date');
        $amount = $request->input('amount');
        $card_type = $request->input('card_type');
        $card_no = $request->input('card_no');
        $card_issuer = $request->input('card_issuer');
        $card_brand = $request->input('card_brand');
        $card_issuer_country = $request->input('card_issuer_country');
        Session::flash('message_type', "alert-danger");
        Session::flash('message', $error);
        return redirect()->back();
    }
    public function payPreOrderSuccess(Request $request)
    {
        $sessionData = session('charge_data');
        //dd($sessionData);
        $val_id = urlencode( $request->input('val_id'));
        $store_id = urlencode("test_shoppingzonebd001");
        $store_passwd = urlencode("test_shoppingzonebd001@ssl");
        $requested_url = "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd;
        $handle=curl_init();
        curl_setopt($handle, CURLOPT_URL,$requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER,false);
        $result = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($code == 200 && !(curl_errno($handle))) {
            $verification = 1;
            $error = '';
            # TO CONVERT AS OBJECT
            $result = json_decode($result);
            $user_id = Auth::user()->id;
            $product_slug = substr($request->input('value_a'), 0, -5);
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $store_amount = $result->store_amount;
            $status = $result->status;
            $bank_tran_id = $result->bank_tran_id;
            $currency = $request->input('currency');
            $tran_date = $result->tran_date;
            $amount = $result->amount;
            $card_type = $result->card_type;
            $card_no = $result->card_no;
            $card_issuer = $result->card_issuer;
            $card_brand = $result->card_brand;
            $card_issuer_country = $result->card_issuer_country;
            $validated_on = $result->validated_on;
        } else {
            //unable to connect
            $verification = 0;
            $user_id = Auth::user()->id;
            $product_slug = substr($request->input('value_a'), 0, -5);
            $tran_id = $request->input('tran_id');
            $error = $request->input('error');
            $status = $request->input('status');
            $bank_tran_id = $request->input('bank_tran_id');
            $currency = $request->input('currency');
            $tran_date = $request->input('tran_date');
            $amount = $request->input('amount');
            $card_type = $request->input('card_type');
            $card_no = $request->input('card_no');
            $card_issuer = $request->input('card_issuer');
            $card_brand = $request->input('card_brand');
            $card_issuer_country = $request->input('card_issuer_country');
        }
        $find_product = Product::where('slug',$product_slug)->first();
        $find_shipping = Shipping::where('user_id',$user_id)->first();
        $dataOrder = array(
            'user_id' => $user_id,
            'order_no' => self::generate_order_number(),
            'product_id' => $find_product->id,
            'region_id' => $sessionData['region_id'],
            'city_id' => $sessionData['city_id'],
            'area_id' => $sessionData['area_id'],
            'price' => $find_product->price,
            'pre_order_amount' => $sessionData['pre_order_amount'],
            'shipping_payable' => $sessionData['charge'],
            'booking_payment' => 'online',
            'order_status' => 'booking'
        );
        $create_order = PreOrder::create($dataOrder);
        $insertedId = $create_order->id;
        $find_order = PreOrder::find($insertedId);
        $data = array(
            'user_id' => $user_id,
            'order_id' => $insertedId,
            'order_type' => 'pre_order',
            'tran_id' => $tran_id,
            'val_id' => $val_id,
            'store_amount' => $store_amount,
            'error' => $error,
            'status' => $status,
            'bank_tran_id' => $bank_tran_id,
            'currency' => $currency,
            'tran_date' => $tran_date,
            'amount' => $amount,
            'card_type' => $card_type,
            'card_no' => $card_no,
            'card_issuer' => $card_issuer,
            'card_brand' => $card_brand,
            'card_issuer_country' => $card_issuer_country,
        );
        $insert = PaymentActivities::create($data);
        if ($verification == 1) {
            $find_order->booking_payment_status = 'complete';
            $find_order->booking_payment_activity_id = $insert->id;
            $find_order->save();
        }
        else
        {
            $find_order->booking_payment_status = 'verification';
            $find_order->booking_payment_activity_id = $insert->id;
            $find_order->save();
        }
        $InfoArray = [
            'pre_order_id' => $insertedId,
            'first_name' => $find_shipping->first_name,
            'last_name' => $find_shipping->last_name,
            'address' => $find_shipping->address,
            'city' => $find_shipping->city,
            'country' => $find_shipping->country,
            'state' => $find_shipping->state,
            'post_code' => $find_shipping->post_code,
            'phone' => $find_shipping->phone,
            'company' => $find_shipping->company,
            'fax' => $find_shipping->fax
        ];
        $insert = UserPreOrderShipping::create($InfoArray);
        $getOrderDetails = $find_order;
        $getOrderProducts = Product::where('id',$find_order->product_id)->first();
        $getOrderShippingInformation = UserPreOrderShipping::where('id',$insert->id)->first();
        Mail::send('emails.product_pre_order',['orderDetails' => $getOrderDetails,'OrderProducts' => $getOrderProducts,'ShippingInformation' => $getOrderShippingInformation],function($m){
            $m->from('admin@shoppingzonebd.com','ShoppingZoneBD');
            $m->to(Auth::user()->email,Auth::user()->first_name)->subject('New Pre Oder Placed Successfully');
        });
        Session::flash('message_type', "alert-success");
        Session::flash('message', 'Your Pre Order Booking Complete Against Product '.$find_product->name.'. Thank You');
        return redirect()->intended(route('my_pre_order'));
    }
    protected function generate_order_number(){
        $today = date("Ymd");
        $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
        return $unique = $today . $rand;
    }
}