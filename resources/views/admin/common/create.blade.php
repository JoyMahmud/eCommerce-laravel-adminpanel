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
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['role' => 'form']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Option Key</label>
                    <input required type="text" class="form-control" name="option_key" id="option_key" value="{{ old('option_key') }}" placeholder="Option Key">
                    {!! $errors->has('option_key')? '<p class="text-red">'.$errors->first('option_key') .'</p>':'' !!}
                </div>
                <div class="form-group {{ $errors->has('value')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Option Value</label>
                    <input  type="text" class="form-control" name="option_value" id="option_value" value="{{ old('option_value') }}" placeholder="Option Value">
                    {!! $errors->has('option_value')? '<p class="text-red">'.$errors->first('option_value') .'</p>':'' !!}
                </div>


            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>





    </div>

@stop
