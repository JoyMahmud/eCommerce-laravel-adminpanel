{{--

 * Created by PhpStorm.
 * User: infelicitas
 * Date: 1/20/16
 * Time: 9:09 PM
--}}


@extends('layout.master')

 @section('page-css')

     <script src="{{ asset ("assets/dist/js/select2.min.js") }}" type="text/javascript"></script>
     <link rel="stylesheet" href="https://www.appbajar.com/assets/plugins/select2-4.0.0/dist/css/select2.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
     <!-- InputMask -->
     <script src="{{ asset ("assets/plugins/input-mask/jquery.inputmask.js") }}" type="text/javascript"></script>
     <script src="{{ asset ("assets/plugins/input-mask/jquery.inputmask.date.extensions.js") }}" type="text/javascript"></script>
     <script src="{{ asset ("plugins/input-mask/jquery.inputmask.extensions.js") }}" type="text/javascript"></script>

     <style>
         .img-product{width: 50px;}

     </style>
     <script>
         $(function () {
             //Datemask dd/mm/yyyy
             $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
             $("[data-mask]").inputmask();
         });

     </script>
 @endsection
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


                <div class="form-group  {{ $errors->has('expire_date')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Expiration Date</label>
                    <div class="input-group" >
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input required id="expire_date" name="expire_date" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" {{ old('expire_date') }}>
                        {!! $errors->has('expire_date')? '<p class="text-red">'.$errors->first('expire_date') .'</p>':'' !!}
                    </div>
                    <!-- /.input group -->
                </div>




                <div class="form-group {{ $errors->has('discount')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Discount ( In Percent)</label>
                    <input  required type="text" class="form-control" name="discount" id="discount" value="{{ old('discount') }}" placeholder="Discount ( In Percent)">
                    {!! $errors->has('discount')? '<p class="text-red">'.$errors->first('discount') .'</p>':'' !!}
                </div>

                <div class="form-group">
                    <label class="control-label">Product</label>

                        <select required class="select2 form-control" name="product_id" id="product_id">
                            <option value="" selected>Select Product</option>
                           @foreach($product_list as $product_item)

                                <option value="{{$product_item->id}}" data-image="{{asset($product_item->front_image)}}" > {{$product_item->name}}</option>

                           @endforeach

                        </select>

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



    </script>

@endsection