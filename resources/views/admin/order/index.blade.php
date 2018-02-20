{{--

 * Created by PhpStorm.
 * User: infelicitas
 * Date: 1/20/16
 * Time: 9:09 PM
--}}


@extends('layout.master')

@section('page-css')
    <script src="https://cdn.datatables.net/plug-ins/1.10.12/api/fnStandingRedraw.js" type="text/javascript"></script>

@endsection

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="cashPay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    ...
                </div>

            </div>
        </div>
    </div>





    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ isset($page_title) ? $page_title : '' }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Order</a></li>
            <li class="active">All Order List</li>
        </ol>
    </section>
    </br>
        <input type="hidden" id="_token" value="{{ csrf_token() }}">

    <div class="box">
        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="OrderdataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ordered User</th>
                    <th>Order No</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Shipping Charge</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Shipment Status</th>
                    <th>Order Date</th>

                    <th colspan=”2”>Operations</th>


                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
        function cashPay(orderID) {




            var _token=$('#_token').val();
            $.ajax({
                type: "POST",
                url: "{{route('cash_pay')}}",
                data: "order_id=" + orderID+ "&_token=" + _token,
                success: function(response){
                    var oTable1 = $('#OrderdataTable').dataTable();
                    oTable1.fnDraw();

                }
            });
        }

        $(function() {
            $("#cashPay").on("show.bs.modal", function(e) {
                $('#message').empty();
                var link = $(e.relatedTarget);
                $(this).find(".modal-body").load(link.attr("href"));
            });
            $('#OrderdataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('all_list')}}',
                'aaSorting' : [[0,'asc']],


                columns: [

                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'order_no', name: 'order_no'},
                    {data: 'subtotal', name: 'subtotal'},
                    {data: 'total', name: 'total'},
                    {data: 'shipping_payable', name: 'shipping_payable'},
                    {data: 'payment', name: 'payment'},
                    {data: 'payment_status', name: 'payment_status'},
                    {data: 'shipping_status', name: 'shipping_status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection