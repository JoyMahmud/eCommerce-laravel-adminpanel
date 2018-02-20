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

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('common')}}">Common Setings</a></li>
        <li class="active">Create</li>
    </ol>
</section>
</br>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($page_title) ? $page_title : '' }}</h3>

        <a href="{{route('new_option')}}"class="btn bg-navy margin">Add New Option</a>

    </div>
    <!-- /.box-header -->
    <!-- form start -->






    @foreach($options as $options)
            <!-- Horizontal Form  Email Address Update-->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{$options->option_key}}</h3>
        </div>
        <!-- /.box-header -->

        <!-- form start -->
        {!! Form::open(['role' => 'form','class'=>'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">{{$options->option_key}}</label>

                <div class="col-sm-10">
                    <input type="hidden" name="option_key" id="option_key" value="{{$options->option_key}}">
                    <input value="{{$options->option_value}}"  name="option_value" class="form-control" id="inputEmail3" placeholder="{{$options->option_value}}" type="text">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

            <button type="submit" class="btn btn-info pull-right">Update</button>
        </div>
        <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box -->

    @endforeach





</div>

@stop
