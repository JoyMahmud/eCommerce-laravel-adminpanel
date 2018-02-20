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

<script src="{{ asset ("assets/plugins/datatables/jquery.dataTables.js") }}" type="text/javascript"></script>
<script src="{{ asset ("assets/plugins/datatables/dataTables.bootstrap.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("assets/dist/js/fnStandingRedraw.js") }}" type="text/javascript"></script>


@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ isset($page_title) ? $page_title : '' }}
        <a href="{{route('add_image',$productID)}}" class="btn bg-navy btn-flat margin"><i class="fa fa-plus-square"></i> Add Images</a>


    </h1>
    <ol class="breadcrumb">
        <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('product')}}">Product</a></li>
        <li class="active">Product Image List</li>
    </ol>
</section>
</br>


    <div class="box">
        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Upload Date</th>
                    <th colspan=”2”>Operations</th>

                </tr>
                </thead>
                <tbody>
                <tr>
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
                ajax: '{{route('product_image_list',$productID)}}',
                'aaSorting' : [],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
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

        function destroyFunction(id){
            $.ajax({
                url: "{{route('remove_image')}}",
                type: "post",
                data: { id:id, _token : '{{ csrf_token() }}' },
                success: function (msg) {
                    //$("#result").html(responseText);

                    if(msg=='success')
                    {

                        var table = $('#dataTable').dataTable()
                        table.fnStandingRedraw();
                    }





                }
            });
        }

    </script>
@endsection