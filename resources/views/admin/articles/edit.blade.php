{{--

 * Created by PhpStorm.
 * User: infelicitas
 * Date: 1/20/16
 * Time: 9:09 PM
--}}


@extends('layout.master')

 @section('page-css')

        <!-- bootstrap wysihtml5 - text editor -->
<link href="{{ asset ("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}" rel="stylesheet" type="text/css" />


 @endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Article</a></li>
        <li class="active">Update</li>
    </ol>
</section>
</br>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"> {{ isset($data->type) ? $data->type : '' }}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->



    {{ Form::open(array('url' => '/admin/articles/'.$data->type, 'role'=>'form','method' => 'PATCH','files' => true)) }}

    <input class="form-control" id="id" placeholder="Enter Name" type="hidden" name="id" value="{{ $data->id }}" required>
    <input class="form-control" id="type" placeholder="Enter Name" type="hidden" name="type" value="{{ $data->type }}" required>

    <div class="box-body">


        <div class="form-group">

            {{ Form::label('Title', 'Title') }}

            {{ Form::text('title', $data->title, array('placeholder'=>'Enter title…','class' => 'form-control','required' => 'required')) }}

        </div>


        <div class='box-body pad'>

                                <textarea required="required" class="textarea" id="article_details" name="article_details" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

                                    {{ $data->details }}
                                </textarea>

        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>





</div>

@stop

@section('page-js')

        <!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset ("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>


<script>    $("#article_details").wysihtml5();</script>

@endsection