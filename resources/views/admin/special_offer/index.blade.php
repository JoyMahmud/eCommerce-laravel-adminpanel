{{--

 * Created by PhpStorm.
 * User: infelicitas
 * Date: 1/20/16
 * Time: 9:09 PM
--}}


@extends('layout.master')

@section('page-css')
        <!-- Add fancyBox -->

<link href="{{ asset ("assets/source/jquery.fancybox.css?v=2.1.5") }}" rel="stylesheet" type="text/css" />
<script src="{{ asset ("assets/source/jquery.fancybox.pack.js?v=2.1.5") }}" type="text/javascript"></script>


@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ isset($page_title) ? $page_title : '' }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Offer List</li>
    </ol>
</section>
</br>


    <div class="box">
        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Discount</th>
                    <th>Original Price</th>
                    <th>Expiration Date</th>
                    <th>Added</th>



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

                </tr>
                </tbody>
            </table>
        </div>
    </div>

@stop


@section('page-js')

    <script>
        $(function() {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('offer_list')}}',
                'aaSorting' : [[0,'asc']],


                columns: [

                    {data: 'id', name: 'id'},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'product_image', name: 'product_image', orderable: false, searchable: false},
                    {data: 'discount', name: 'discount', orderable: false, searchable: false},
                    {data: 'price', name: 'price', orderable: false, searchable: false},
                    {data: 'expire_date', name: 'expire_date', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ]
            });
        });

        $(document).ready(function() {
            $("#single_1").fancybox({
                helpers: {
                    title : {
                        type : 'float'
                    }
                }
            });
        });
    </script>
@endsection