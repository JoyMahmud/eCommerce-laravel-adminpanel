<?php

namespace App\Listeners;

use App\Events\ProductOrder;
use App\Order;
use App\OrderProduct;
use App\UserOrderShipping;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        $this->order_id=$order_id;
    }

    /**
     * Handle the event.
     *
     * @param  ProductOrder  $event
     * @return void
     */
    public function handle(ProductOrder $event)
    {
        $getOrderDetails=Order::find($event->order_id);
        $getOrderProducts=OrderProduct::where('order_id',$event->order_id)->get();
        $getOrderShippingInformation=UserOrderShipping::where('order_id',$event->order_id)->first();


        dd($getOrderDetails);

        Mail::send('emails.order',['orderDetails'=>$getOrderDetails,'OrderProducts'=>$getOrderProducts,'ShippingInformation'=>$getOrderShippingInformation],function($m){

            $m->from('admin@shoppingzonebd.com','ShoppingZoneBD');
            $m->to(Auth::user()->email,Auth::user()->first_name)->subject('New Oder Placed Successfully');

        });
    }
}
