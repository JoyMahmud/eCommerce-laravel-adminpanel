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
        <li><a href="{{route('charge')}}">Charge</a></li>
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
        {!! Form::open(['route' => array('charge_update', $details->id),'role' => 'form','autocomplete'=>'off']) !!}
            <div class="box-body">

                <input type="hidden" name="_token"  id="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_route_city_list"  id="_route_city_list" value="{{ URL::to('admin/charge/generate-city-list')}}">
                <input type="hidden" name="_route_area_list"  id="_route_area_list" value="{{ URL::to('admin/charge/generate-area-list')}}">
                <div class="form-group  {{ $errors->has('region_id')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">Region</label>
                    <select id="region_id" name="region_id" class="form-control" required>

                        <option value=" ">Select</option>
                        @foreach($region as $region)

                            <option value="{{$region->id}}"   @if ($details->region_id == $region->id) selected @endif >{{$region->title}}</option>

                        @endforeach

                    </select>
                    {!! $errors->has('region_id')? '<p class="text-red">'.$errors->first('region_id') .'</p>':'' !!}
                </div>



                <div class="form-group  {{ $errors->has('city_id')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">City</label>
                    <select id="city_id" name="city_id" class="form-control" required>

                        <option value="{{$city->id}}" selected>{{$city->title}}</option>

                    </select>
                    {!! $errors->has('city_id')? '<p class="text-red">'.$errors->first('city_id') .'</p>':'' !!}
                </div>



                <div class="form-group  {{ $errors->has('area_id')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">Area</label>
                    <select id="area_id" name="area_id" class="form-control" required>
                        <option value="">Select</option>

                        <option value="{{$area->id}}"selected>{{$area->title}}</option>
                    </select>
                    {!! $errors->has('area_id')? '<p class="text-red">'.$errors->first('area_id') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('value')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Value</label>
                    <input required type="text" class="form-control" name="value" id="value" value="{{$details->value }}" placeholder="value">
                    {!! $errors->has('value')? '<p class="text-red">'.$errors->first('value') .'</p>':'' !!}
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

    <script src="{{ asset ("assets/dist/js/PopulateList.js") }}" type="text/javascript"></script>

@stop