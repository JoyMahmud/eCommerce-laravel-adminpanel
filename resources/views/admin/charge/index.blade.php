{{--

 * Created by PhpStorm.
 * User: infelicitas
 * Date: 1/20/16
 * Time: 9:09 PM
--}}


@extends('layout.master')

@section('page-css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ isset($page_title) ? $page_title : '' }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Area</a></li>
            <li class="active">Area List</li>
        </ol>
    </section>
    </br>


    <div class="box">
        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Value</th>
                    <th>Region</th>
                    <th>City</th>
                    <th>Area</th>
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
                ajax: '{{route('charge_list')}}',
                'aaSorting' : [[0,'asc']],


                columns: [

                    {data: 'id', name: 'id'},
                    {data: 'value', name: 'value'},
                    {data: 'region_id', name: 'region_id'},
                    {data: 'city_id', name: 'city_id'},
                    {data: 'area_id', name: 'area_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection