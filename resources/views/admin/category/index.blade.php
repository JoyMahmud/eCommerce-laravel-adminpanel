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
        <li><a href="#">Category</a></li>
        <li class="active">Category List</li>
    </ol>
</section>
</br>


    <div class="box">
        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Icon</th>
                    <th>Main menu</th>
                    <th>Highlighted</th>
                    <th>Tab menu</th>
                    <th>Sub Category</th>
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
                ajax: '{{route('category_list')}}',
                'aaSorting' : [[0,'asc']],


                columns: [
                    {data: 'row_order', name: 'row_order'},
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'icon', name: 'icon', orderable: false, searchable: false},
                    {data: 'main_menu', name: 'main_menu', orderable: false, searchable: false},
                    {data: 'highlighted', name: 'highlighted', orderable: false, searchable: false},
                    {data: 'is_tabbed', name: 'is_tabbed', orderable: false, searchable: false},
                    {data: 'SubCategory', name: 'SubCategory', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection