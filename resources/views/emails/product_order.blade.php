{{--*/ $logo = \App\CommonSettings::where('option_key','logo')->select('option_value')->first() /*--}}


<style>

    #information p { margin: 0 !important; }
    #order { border-collapse: collapse; }
    #order tr { border-bottom: 1px #DEDEDE solid; }
    .right{}
    .left{}
    .center{}
</style>
<div id="main_area" style="width: 100%;height: 100%;text-align:center;background-color:#f3f3f3;font-family:roboto,sans-serif;font-size:14px;margin:0;color:#444;padding:20px;">

    <div class="top_area" style="width: 95%;height: 70%;padding-top: 5%;border-radius:5px;background-color:#ffffff;">
        <div class="header"><img src="{{asset($logo->option_value)}}" style="width: 29%;height: auto;margin: 0 auto;/*! text-align: center; */display: block;"></div>
        <div class="content">

            <h3>Thank you for ordering on shoppingZoneBD.</h3>
            <h5>Your order details below here</h5>


            <table  style="width: 85%;margin: 0 auto;">
                <tr>

                    <td style="text-align: left;width: 50%;padding-right: 52px;"> <p><b>Customer Details :</b><p></td>
                    <td style="text-align: left;width: 50%;padding-left: 52px;"><p><b>Shipping Details :</b></p></td>

                </tr>
                <tr id="information">
                    <td style="text-align: left;width: 50%;padding-right: 52px;vertical-align: top;">

                        <p><span class="left">Full Name</span> 			<span class="center">: </span>		<span class="right">{{$ShippingInformation->first_name .' '. $ShippingInformation->last_name }}</span></p>
                        <p><span class="left">Phone</span>   			<span class="center">: </span> 		<span class="right">{{$ShippingInformation->phone }}</span></p>
                        <p></p>
                        <p></p>
                        <p></p>
                    </td>
                    <td style="text-align: left;width: 50%;padding-left: 52px;vertical-align: top;">

                        <p><span class="left">Address</span>   		<span class="center">:</span> 		<span class="right">{{$ShippingInformation->address }}</span></p>
                        <p><span class="left">State</span>   		<span class="center">:</span>  		<span class="right">{{$ShippingInformation->state }}</span></p>
                        <p><span class="left">City</span>   		<span class="center">: </span> 		<span class="right">{{$ShippingInformation->city }}</span></p>
                        <p><span class="left">Post Code</span>   	<span class="center">:</span>  		<span class="right">{{$ShippingInformation->post_code }}</span></p>
                        <p><span class="left">Country </span>  		<span class="center">: </span> 		<span class="right">{{$ShippingInformation->country }}</span></p>
                    </td>

                </tr>

            </table>


            <table  id="order" style="width: 85%;margin: 0 auto;padding-top: 13px;margin-top: 14px;">

                <tr>

                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;">Description</td>
                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;">Quantity</td>
                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;">Unit Price</td>
                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;">Total Amount</td>

                </tr>

                @foreach($OrderProducts as $item)
                <tr>

                    <td >{{$item->product->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td >{{$item->product->price}}</td>
                    <td >{{(($item->product->price)*($item->quantity))}}</td>

                </tr>
                @endforeach
                <tr>

                    <td style="color: black;font-weight: bolder;">Shipping Charge</td>
                    <td></td>
                    <td ></td>
                    <td >{{$orderDetails->shipping_payable}}</td>

                </tr>
                <tr>

                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;">Total</td>
                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;"></td>
                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;"></td>
                    <td style="background-color: #ABD07E;padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;">{{$orderDetails->total}}</td>

                </tr>
                <tr>

                    <td style="padding: 6px;font-size: 15px;font-weight: bolder;color: #fffffff;">Total Paid</td>
                    <td style="padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;"></td>
                    <td style="padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;"></td>
                    <td style="background-color:hsla(120,100%,75%,0.3);padding: 6px;font-size: 15px;font-weight: bolder;color: #fffffff;">{{$orderDetails->payment =='cash' ? '0.00' : $orderDetails->payment_status =='complete' ? $orderDetails->total : 'Verification Unsuccessful' }}</td>

                </tr>
                <tr>

                    <td style="padding: 6px;font-size: 15px;font-weight: bolder;color: #fffffff;">Total Due</td>
                    <td style="padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;"></td>
                    <td style="padding: 6px;font-size: 15px;font-weight: bolder;color: #ffffff;"></td>
                    <td style="background-color:hsla(120,100%,75%,0.3);padding: 6px;font-size: 15px;font-weight: bolder;color: #fffffff;">{{$orderDetails->payment =='cash' ? $orderDetails->total : $orderDetails->payment_status =='complete' ? '0.00' : $orderDetails->total }}</td>

                </tr>
            </table>

        </div>
    </div>
    <div class="bottom_area" style="width: 95%;height: 20%;">
        <div style="font-size:14px;/*! width:624px; *//*! margin:0px auto; */padding:23px 0px;background-image:url('{{asset('assets/frontend/images/email-template/footer.png')}}');background-color:rgb(243,243,243);background-size:initial;background-origin:initial;background-clip:initial;background-position:50% 100%;background-repeat:no-repeat;background-repeat:no-repeat;background-repeat: no-repeat;background-size: contain;background-position: center;">
            <ul style="font-size:0;margin-top:0;list-style:none;padding:0;line-height:1">
                <li style="display:inline-block;vertical-align:middle;padding:5px">
                    <p style="font-size:25px;font-style:italic;font-weight:300;line-height:1;margin:0">Stay in touch</p>
                </li>
                <li style="display:inline-block;vertical-align:middle;padding:5px">
						<span class="m_4929081088826337892sg-image" style="float:none;display:block;text-align:center">
							<a href="https://www.facebook.com/shoppingzonebd1" target="_blank">
								<img alt="facebook" src="{{asset('assets/frontend/images/email-template/facebook.png')}}" style="border:0px;width:32px;height:32px" class="CToWUd" width="32" height="32">
							</a>
						</span>
                </li>
            </ul>

            <p style="color:#8f9495;font-size:13px;line-height:1;margin:15px 0 20px">Thank You For Being With Us </p>
        </div>

    </div>



</div>