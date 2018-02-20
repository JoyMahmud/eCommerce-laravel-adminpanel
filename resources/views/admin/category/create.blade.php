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
        <li><a href="#">Category</a></li>
        <li class="active">Create</li>
    </ol>
</section>
</br>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"> {{ isset($page_title) ? $page_title : '' }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['role' => 'form']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Title</label>
                    <input required type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Title">
                    {!! $errors->has('title')? '<p class="text-red">'.$errors->first('title') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('icon')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Icon</label>
                    <input type="text" class="form-control" name="icon" id="icon" value="{{ old('icon') }}" placeholder="Icon">
                    {!! $errors->has('icon')? '<p class="text-red">'.$errors->first('icon') .'</p>':'' !!}
                </div>

                <div class="form-group">
                    {{ Form::checkbox('main_menu', 1, 0) }}
                    {{ Form::label('Main menu', 'Category Show In Main Menu')}}
                    {{ $errors->first('main_menu') }}
                </div>

                <div class="form-group">
                    {{ Form::checkbox('highlighted', 1, 0) }}
                    {{ Form::label('Highlighted', 'Highlighted In Homepage')}}
                    {{ $errors->first('highlighted') }}
                </div>

                <div class="form-group">
                    {{ Form::checkbox('is_group_label', 1, 0) }}
                    {{ Form::label('Grouped Sub System', 'Sub Category Show In Main Menu By Groupe Label')}}
                    {{ $errors->first('is_group_label') }}
                </div>

                <div class="form-group">
                    {{ Form::checkbox('is_tabbed', 1, 0) }}
                    {{ Form::label('New product Tab', 'Added into new product tab')}}
                    {{ $errors->first('is_tabbed') }}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@stop