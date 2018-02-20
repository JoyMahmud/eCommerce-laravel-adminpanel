


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
        <h3 class="box-title">       {{ isset($page_title) ? $page_title : '' }}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::open(['route' => array('category_update', $details->id),'role' => 'form']) !!}

    <div class="box-body">

        <input type="hidden" name="root_status" value="{{$details->root}}">
        <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
            <label for="exampleInputEmail1">Title</label>
            <input required type="text" class="form-control" name="title" id="title" value="{{ $details->title }}" placeholder="Title">
            {!! $errors->has('title')? '<p class="text-red">'.$errors->first('title') .'</p>':'' !!}
        </div>


        <div class="form-group {{ $errors->has('icon')? 'has-error':'' }}">
            <label for="exampleInputEmail1">Icon</label>
            <input type="text" class="form-control" name="icon" id="icon" value="{{ $details->icon }}" placeholder="Icon">
            {!! $errors->has('icon')? '<p class="text-red">'.$errors->first('icon') .'</p>':'' !!}
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="main_menu" @if ($details->main_menu==1) checked="checked" @endif> Category Show In Main Menu
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="highlighted" @if ($details->highlighted==1) checked="checked" @endif> Highlighted In Homepage
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="is_group_label" @if ($details->is_group_label==1) checked="checked" @endif> Sub Category Show In Main Menu By Group Label
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="is_tabbed" @if ($details->is_tabbed==1) checked="checked" @endif> Added into new product tab
                </label>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>

@stop