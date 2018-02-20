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

        <a href="{{route('attribute_create')}}" class="btn bg-navy btn-flat margin"><i class="fa fa-plus-square"></i> Add New Attribute</a>

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attribute List</li>
    </ol>
</section>
</br>


    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">Weight Attributes</h3>
        </div>

        <div class="box-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Value</th>
                    <th>Operations</th>

                </tr>
                </thead>
                <tbody>

                    @foreach($all_weight as $all_weight)
                        <tr>
                            <td>{{$all_weight->id}}</td>
                            <td>{{$all_weight->name}}</td>
                            <td>{{$all_weight->value}}</td>
                            <td>
                                @if($all_weight->trashed())

                                    <a href="{{route('attribute_soft_delete_restore', $all_weight->id)}}" class="btn bg-olive margin"><i class="fa fa-fw fa-recycle"></i></i>Enable</a>

                                @else

                                    <a href="{{route('attribute_soft_delete', $all_weight->id)}}" class="btn bg-navy margin"><i class="fa fa-times"></i></i>Disable</a>

                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Length Attributes</h3>
    </div>
    <div class="box-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered  table-hover table-striped dataTable" id="dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Value</th>


                <th>Operations</th>


            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($all_length as $all_length)
                    <tr>
                        <td>{{$all_length->id}}</td>
                        <td>{{$all_length->name}}</td>
                        <td>{{$all_length->value}}</td>
                        <td>

                            @if($all_length->trashed())

                                <a href="{{route('attribute_soft_delete_restore', $all_length->id)}}" class="btn bg-olive margin"><i class="fa fa-fw fa-recycle"></i></i>Enable</a>

                            @else

                                <a href="{{route('attribute_soft_delete', $all_length->id)}}" class="btn bg-navy margin"><i class="fa fa-times"></i></i>Disable</a>

                            @endif





                        </td>
                    </tr>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
</div>




@stop
