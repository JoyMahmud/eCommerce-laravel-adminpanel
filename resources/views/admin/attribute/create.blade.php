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
        <li><a href="{{route('attribute')}}">Attribute</a></li>
        <li class="active">Create</li>
    </ol>
</section>
</br>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">   {{ isset($page_title) ? $page_title : '' }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['role' => 'form']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Title</label>
                    <input required type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Title">
                    {!! $errors->has('name')? '<p class="text-red">'.$errors->first('name') .'</p>':'' !!}
                </div>
                <div class="form-group {{ $errors->has('value')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Measurement Value</label>
                    <input required type="text" class="form-control" name="value" id="value" value="{{ old('value') }}" placeholder="Measurement Value">
                    {!! $errors->has('value')? '<p class="text-red">'.$errors->first('value') .'</p>':'' !!}
                </div>

                <div class="form-group">
                    <label>Select Attribute Type</label>
                    <select required class="form-control" id="type" name="type">
                        <option value=" ">Select</option>
                        <option value="weight">Weight</option>
                        <option value="length">Length</option>
                    </select>
                    {!! $errors->has('type')? '<p class="text-red">'.$errors->first('type') .'</p>':'' !!}
                </div>


            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@stop