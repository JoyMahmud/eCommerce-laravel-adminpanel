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
        <li><a href="{{route('common')}}">Logo Setings</a></li>
        <li class="active">Update</li>
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

                <div class="form-group {{ $errors->has('font_image')? 'has-error':'' }}">

                    <label class="control-label " for="exampleInputEmail1">Image</label>
                    <input  type="hidden" class="form-control" name="option_key" id="option_key" value="{{$options->option_key}}" placeholder="Option Key">
                    <input required  type="text" class="form-control" name="font_image" id="font_image" value="{{$options->option_value}}" >

                    <a class="btn bg-orange btn-flat margin" data-toggle="modal"  href="javascript:;" data-target="#myModal" class="btn" type="button">Select Image From Image Manager</a>

                    {!! $errors->has('font_image')? '<p class="text-red">'.$errors->first('font_image') .'</p>':'' !!}
                    <p class="help-block"> Only JPG,JPEG,PNG format supported </p>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>


        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content" style="min-width: 731px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-light-blue">Image Manager</h4>
                    </div>
                    <div class="modal-body">
                        <iframe width="700" height="400" src="dialog?type=2&field_id=font_image'&fldr=" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


    </div>

@stop
