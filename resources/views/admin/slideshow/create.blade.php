@extends('layout.master')
 @section('page-css')

     <script src="{{ asset ("assets/dist/js/select2.min.js") }}" type="text/javascript"></script>
     <link rel="stylesheet" href="{{ asset ("assets/plugins/select2-4.0.0/dist/css/select2.css") }}">
     <style>
         .img-product{width: 50px;}

     </style>
 @endsection
@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Slideshow</a></li>
        <li class="active">Create</li>
    </ol>
</section>
</br>

    <div class="box box-primary" >
        <div class="box-header with-border">
            <h3 class="box-title"> {{ isset($page_title) ? $page_title : '' }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['role' => 'form']) !!}
            <div class="box-body col-md-11 ">



                <div class="form-group {{ $errors->has('text_line_one')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Text Line One</label>
                    <input  required type="text" class="form-control" name="text_line_one" id="text_line_one" value="{{ old('text_line_one') }}" placeholder="Text Line One">
                    {!! $errors->has('text_line_one')? '<p class="text-red">'.$errors->first('text_line_one') .'</p>':'' !!}
                </div>

                <div class="form-group {{ $errors->has('text_line_one_color')? 'has-error':'' }}">
                    <label>Color Of Text Line One:</label>

                    <div class="input-group my-colorpicker2 colorpicker-element">
                        <input required name="text_line_one_color" class="form-control" type="text">
                        {!! $errors->has('text_line_one_color')? '<p class="text-red">'.$errors->first('text_line_one_color') .'</p>':'' !!}
                        <div class="input-group-addon">
                            <i style="background-color: rgb(147, 45, 45);"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>


                <div class="form-group {{ $errors->has('text_line_two')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Text Line Two</label>
                    <input   type="text" class="form-control" name="text_line_two" id="text_line_two" value="{{ old('text_line_two') }}" placeholder="Text Line Two">
                    {!! $errors->has('text_line_two')? '<p class="text-red">'.$errors->first('text_line_two') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('text_line_two_color')? 'has-error':'' }}">
                    <label>Color Of Text Line Twoe:</label>

                    <div class="input-group my-colorpicker2 colorpicker-element">
                        <input  name="text_line_two_color" class="form-control" type="text">
                        {!! $errors->has('text_line_two_color')? '<p class="text-red">'.$errors->first('text_line_two_color') .'</p>':'' !!}
                        <div class="input-group-addon">
                            <i style="background-color: rgb(147, 45, 45);"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group {{ $errors->has('text_line_three')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Text Line Three</label>
                    <input   type="text" class="form-control" name="text_line_three" id="text_line_three" value="{{ old('text_line_three') }}" placeholder="Text Line Three">
                    {!! $errors->has('text_line_three')? '<p class="text-red">'.$errors->first('text_line_three') .'</p>':'' !!}
                </div>
                <div class="form-group {{ $errors->has('text_line_three_color')? 'has-error':'' }}">
                    <label>Color Of Text Line Three:</label>

                    <div class="input-group my-colorpicker2 colorpicker-element">
                        <input  name="text_line_three_color" class="form-control" type="text">
                        {!! $errors->has('text_line_three_color')? '<p class="text-red">'.$errors->first('text_line_three_color') .'</p>':'' !!}
                        <div class="input-group-addon">
                            <i style="background-color: rgb(147, 45, 45);"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>


                <div class="form-group">
                    <label class="control-label">Product/Category</label>


                </div>

                <div class="form-group">

                    <select class="form-control" name="product_id" id="product_id">
                        <option value="" selected>Select Product</option>
                        @foreach($product_list as $product_item)

                            <option value="{{$product_item->id}}" data-image="{{asset($product_item->front_image)}}" > {{$product_item->name}}</option>

                        @endforeach

                    </select>


                </div>
                <div class="form-group">
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="" selected>Select Category</option>
                        @foreach($category_list as $category_list)

                            <option value="{{$category_list->id}}" > {{$category_list->title}}</option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group {{ $errors->has('font_image')? 'has-error':'' }}">

                    <label class="control-label " for="exampleInputEmail1">Image</label>

                    <input required  type="text" class="form-control" name="font_image" id="font_image" value="" >

                    <a class="btn bg-orange btn-flat margin" data-toggle="modal"  href="javascript:;" data-target="#myModal" class="btn" type="button">Select Image From Image Manager</a>

                    {!! $errors->has('font_image')? '<p class="text-red">'.$errors->first('font_image') .'</p>':'' !!}
                    <p class="help-block"> Only JPG,JPEG,PNG format supported </p>
                </div>


            </div>





            <!-- /.box-body -->

            <div class="box-footer col-md-12 ">
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

@section('page-js')

    <script>

        function formatState (state) {
            if (!state.id) { return state.text; }

            var optimage = $(state).attr('data-image');

            var $state = $(
                    '<span><img src="' + $(state.element).data("image") + '" class="img-product" /> ' + state.text + '</span>'
            );
            return $state;
        };

        $("select.select2").select2({
            templateResult: formatState
        });

        $(function () {
        //color picker with addon
            $(".my-colorpicker2").colorpicker();
        });
    </script>

@endsection