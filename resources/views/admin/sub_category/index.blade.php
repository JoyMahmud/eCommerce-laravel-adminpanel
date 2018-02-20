{{--

 * Created by PhpStorm.
 * User: infelicitas
 * Date: 1/20/16
 * Time: 9:09 PM
--}}


@extends('layout.master')




@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ isset($page_title) ? $page_title : '' }}

        <a href="{{route('new_sub_category', $categoryID)}}" class="btn bg-navy btn-flat margin"><i class="fa fa-plus-square"></i> Add New Subcategory</a>

    </h1>

    <ol class="breadcrumb">
        <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('category')}}">Category</a></li>
        <li class="active">Sub Category</li>
    </ol>
</section>
</br>


    <div class="box">
        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Highlighted</th>
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
                ajax: '{{route('sub_category_list',$categoryID)}}',
                'aaSorting' : [],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'highlighted', name: 'highlighted', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'Action', name: 'Action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection