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
        <li><a href="{{route('area')}}">Area</a></li>
        <li class="active">Update</li>
    </ol>
</section>
</br>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">   {{ isset($page_title) ? $page_title : '' }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route' => array('area_update', $details->id),'role' => 'form']) !!}
            <div class="box-body">


                <div class="form-group  {{ $errors->has('city_id')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">City</label>
                    <select id="city_id" name="city_id" class="form-control">
                        <option value="">Select</option>

                        @foreach($city as $city)

                            <option value="{{$city->id}}" @if ($details->city_id == $city->id) selected @endif >{{$city->title}}</option>

                        @endforeach

                    </select>
                    {!! $errors->has('city_id')? '<p class="text-red">'.$errors->first('city_id') .'</p>':'' !!}
                </div>



                <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Title</label>
                    <input required type="text" class="form-control" name="title" id="title" value="{{$details->title }}" placeholder="Title">
                    {!! $errors->has('title')? '<p class="text-red">'.$errors->first('title') .'</p>':'' !!}
                </div>

                <div class="form-group  {{ $errors->has('city_id')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">Inside Dhaka City</label>
                    <select id="is_inside_dhaka" name="is_inside_dhaka" class="form-control">
                        <option value="">Select</option>

                        <option value="yes" @if ($details->is_inside_dhaka == 'yes') selected @endif >YES</option>
                        <option value="no" @if ($details->is_inside_dhaka == 'no') selected @endif >NO</option>


                    </select>
                    {!! $errors->has('is_inside_dhaka')? '<p class="text-red">'.$errors->first('is_inside_dhaka') .'</p>':'' !!}
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@stop