


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
        <h3 class="box-title">        {{ isset($page_title) ? $page_title : '' }}</h3>
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


        <div class="form-group">
            <label> Category</label>
            <select class="form-control" id="categoryID" name="categoryID" required>
                <option value=" ">Please Select One</option>
                @foreach($categoryList as $item)
                    <option value="{{$item->id}}" @if($item->id==$details->root)selected @endif >{{$item->title}}</option>

                @endforeach

            </select>
            {!! $errors->has('type')? '<p class="text-danger">'.$errors->first('type') .'</p>':'' !!}


        </div>

        @if($details->is_group_label ==1)

            @if(is_null($groupDetails))
                <div class="form-group {{ $errors->has('group_title')? 'has-error':'' }}">
                    <label for="exampleInputEmail1">Add New Group (Ex:men,women,kids)</label>
                    <input required type="text" class="form-control" name="group_title" id="group_title" value="" placeholder="Group Title">
                    {!! $errors->has('group_title')? '<p class="text-red">'.$errors->first('group_title') .'</p>':'' !!}
                </div>

            @else

                <div class="form-group">
                    <label> Group</label>
                    <select required class="form-control" id="category_group_id" name="category_group_id">
                        <option value="">Please Select One</option>

                        @foreach($groupDetails as $item)
                            <option value="{{$item->id}}" {{ $details->category_group_id == $item->id ? 'selected' : ' ' }}> {{$item->title}}</option>

                        @endforeach

                    </select>
                    {!! $errors->has('category_group_id')? '<p class="text-danger">'.$errors->first('category_group_id') .'</p>':'' !!}


                </div>
            @endif

        @endif
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="highlighted" @if ($details->highlighted==1) checked="checked" @endif> Highlighted In Homepage
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