@extends('layout.modal_master')
@section('page-css')
    <link href="{{ asset ("assets/dist/css/order_custom.css") }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')


<div class="orderRow" style="box-shadow: none ! important;">
    <div class="left_first col-xs-6 col-sm-3">
        <p class="orderNum">Order No. {{ $order->order_no }}</p>
        <p class="orderNum">{{ count($order->OrderProduct) }} items</p>
        <p class="shipment">Shipment: <span class="orderInPro"> {{$order->shipping_status =='in_progress' ? strtoupper('In Progress')  :  strtoupper('Delivered')}}</span></p>

    </div>
    <div class="left_second col-xs-6 col-sm-3">
        <p class="shipment">Order Date: <strong>{{ date('F d, Y', strtotime($order->created_at)) }}</strong></p>
        <p class="shipment">Order Total: <strong>{{ $order->total }} (BDT)</strong></p>
        <p class="shipment">Order Shipping: <strong>{{ $order->shipping_payable }} (BDT)</strong></p>
        <p class="shipment">Order Subtotal: <strong>{{ $order->subtotal }} (BDT)</strong></p>

    </div>
    <div class="left_third col-xs-6 col-sm-3">
        <p class="shipment">Order Shipping</p>
        <address>
            <strong>{{$order->UserOrderShipping['first_name']}} {{$order->UserOrderShipping['last_name']}}</strong><br>
            {{$order->UserOrderShipping['address']}}<br>
            {{$order->UserOrderShipping['city']}}, {{$order->UserOrderShipping['state']}}<br>
            {{$order->UserOrderShipping['post_code']}}<br>
            <abbr title="Phone">P:</abbr> {{$order->UserOrderShipping['phone']}}
        </address>

    </div>
    <div class="left_last col-xs-6 col-sm-3">
        <p class="shipment">Payment Type: <span class="label label-info">{{strtoupper($order->payment)}}</span></p>
        <p class="shipment">Payment Status: <span class="orderInPro">{{strtoupper($order->payment_status)}}</span> </p>
        <p class="shipment">Customer Payable: <strong>{{$order->payment_status =='pending' ? $order->total  : '0'}} (BDT)</strong></p>

    </div>
</div>



<div class="box">
    <div class="box-header">
        <h3 class="box-title">Order Product Items</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="orderItems" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Offer</th>
                <th>Date</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

    </div>


</div>

@stop

@section('page-js')
    <script>
        $(function() {

            $('#orderItems').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    url: "{{route('get_order_items')}}",
                    data: {
                        "order_id": {{$order->id}}
                    }
                },
                'aaSorting' : [],
                "bScrollCollapse": true,
                "sScrollX": "100%",
                columns: [

                    {data: 'name', name: 'name'},
                    {data: 'front_image', name: 'front_image'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'offer', name: 'offer'},
                    {data: 'created_at', name: 'created_at', orderable: false, searchable: false}
                ]
            });
        });

    </script>
@endsection