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
            <h3 class="box-title">{{ isset($page_title) ? $page_title : '' }}</h3>
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


                <div class="form-group">
                    <label> Category</label>
                    <select class="form-control" id="categoryID" name="categoryID" required>
                        <option value="">Please Select One</option>

                            <option value="{{$categoryDetails->id}}" selected>{{$categoryDetails->title}}</option>



                    </select>
                    {!! $errors->has('categoryID')? '<p class="text-danger">'.$errors->first('categoryID') .'</p>':'' !!}


                </div>

                @if($categoryDetails->is_group_label ==1)

                    @if(is_null($groupDetails))
                        <div class="form-group {{ $errors->has('group_title')? 'has-error':'' }}">
                            <label for="exampleInputEmail1">Add New Group (Ex:men,women,kids)</label>
                            <input required type="text" class="form-control" name="group_title" id="group_title" value="" placeholder="Group Title">
                            {!! $errors->has('group_title')? '<p class="text-red">'.$errors->first('group_title') .'</p>':'' !!}
                        </div>

                    @else

                        <div class="form-group">
                            <label> Select Group</label>
                            <select class="form-control" id="category_group_id" name="category_group_id">
                                <option value="">Please Select One</option>
                                @foreach($groupDetails as $item)
                                    <option value="{{$item->id}}" {{ $categoryDetails->category_group_id==$item->id ? 'selected' : ' ' }}>{{$item->title}}</option>

                                @endforeach

                            </select>
                            {!! $errors->has('category_group_id')? '<p class="text-danger">'.$errors->first('category_group_id') .'</p>':'' !!}


                        </div>

                        <div class="form-group {{ $errors->has('group_title')? 'has-error':'' }}">
                            <label for="exampleInputEmail1">Or,Create New Group (Ex:men,women,kids)</label>
                            <input  type="text" class="form-control" name="group_title" id="group_title" value="" placeholder="Group Title">
                            {!! $errors->has('group_title')? '<p class="text-red">'.$errors->first('group_title') .'</p>':'' !!}
                        </div>
                    @endif

                 @endif

                <div class="form-group">
                    {{ Form::checkbox('highlighted', 1, 0) }}
                    {{ Form::label('Highlighted', 'Highlighted In Homepage')}}
                    {{ $errors->first('highlighted') }}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@stop