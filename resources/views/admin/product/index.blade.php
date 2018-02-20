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
        <li class="active">Product List</li>
    </ol>
</section>
</br>


    <div class="box">
        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
                <thead>
                <tr>

                    <th>Name</th>
                    <th>Front Image</th>
                    <th>model</th>
                    <th>SKU</th>
                    <th>Date Available</th>
                    <th>Stock Status</th>
                    <th>Hot Label</th>
                    <th>Show Hompage</th>
                    <th>Added</th>
                    <th>Product Image</th>
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
        $(function() {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('product_list')}}',
                'aaSorting' : [],
                "bScrollCollapse": true,
                "sScrollX": "100%",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'front_image', name: 'front_image', orderable: false, searchable: false},
                    {data: 'model', name: 'model'},
                    {data: 'sku', name: 'sku', orderable: false, searchable: false},
                    {data: 'date_available', name: 'date_available'},
                    {data: 'stock_status', name: 'stock_status'},
                    {data: 'hot_label', name: 'hot_label', orderable: false, searchable: false},
                    {data: 'is_homepage', name: 'is_homepage', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at', orderable: true, searchable: false},
                    {data: 'ProductImage', name: 'ProductImage', orderable: false, searchable: false},
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