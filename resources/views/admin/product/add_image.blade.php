@extends('layout.master')

@section('page-css')

    <script>




        fields = 1;

        function addInput() {
            var div = document.getElementById('text');

            //div.innerHTML = div.innerHTML + "<div class='form-group'><label class='col-md-4 control-label' for='textinput'>Image "+(fields+1)+"</label><div class='col-md-4'><input  required type='text' class='form-control input-md' name='image[]' id='font_image"+(fields+1)+"' value=''></div><div class='col-md-4'><a data-field='font_image"+(fields+1)+"' class='open-AddBookDialog btn bg-maroon' data-toggle='modal'  href='javascript:;' data-target='#myModals' class='btn' type='button'>Select Image From Image Manager</a></div></div>";

            $('#text').append("<div class='form-group'><label class='col-md-4 control-label' for='textinput'>Image "+(fields+1)+"</label><div class='col-md-4'><input  required type='text' class='form-control input-md' name='image[]' id='font_image"+(fields+1)+"' value=''></div><div class='col-md-4'><a data-field='font_image"+(fields+1)+"' class='open-AddBookDialog btn bg-maroon' data-toggle='modal' href='javascript:;' data-target='#myModals' class='btn' type='button'>Select From Image Manager</a> <a href='javascript:;' class='removeImg btn bg-navy margin'>Remove</a> </div></div>");

            //div.innerHTML =div.innerHTML + "<div class='form-group'><label for='exampleInputEmail1'>Image "+(fields+1)+"</label><label><a data-field='font_image"+(fields+1)+"' class='open-AddBookDialog btn bg-orange btn-flat margin' data-toggle='modal'  href='javascript:;' data-target='#myModals' class='btn' type='button'>Select Image From Image Manager</a></label><input required type='text' class='form-control' name='image[]' id='font_image"+(fields+1)+"'  value=''></div>";


            fields = fields+ 1;

        }






        function RemoveLastDirectoryPartOf(the_url)
        {
            var the_arr = the_url.split('/');
            the_arr.pop();
            return( the_arr.join('/') );
        }
        $(document).on("click", ".open-AddBookDialog", function () {




            var currentFieldID = $(this).data('field');
            var currentRoute=window.location.href;
            currentRoute=RemoveLastDirectoryPartOf(currentRoute);
            currentRoute=RemoveLastDirectoryPartOf(currentRoute);

            $('.modal-body').empty();
            $('.modal-body').append('<iframe width="700" height="400" src="'+currentRoute+'/add-image-dialog?type=2&field_id='+currentFieldID+'" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>');
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
            <li><a href="{{route('product')}}">Product</a></li>
            <li><a href="{{route('product_image',$productID)}}">Product Images</a></li>
            <li class="active">Add Image</li>
        </ol>
    </section>
    </br>


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"> {{ isset($page_title) ? $page_title : '' }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['role' => 'form','class'=>'form-horizontal']) !!}
        <div class="box-body">


            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Image</label>
                <div class="col-md-4">
                    <input  required type="text" class="form-control input-md" name="image[]" id="font_image" value="">
                </div>
                <div class="col-md-4">
                    <a data-field="font_image" class="open-AddBookDialog btn bg-maroon" data-toggle="modal"  href="javascript:;" data-target="#myModals" class="btn" type="button">Select From Image Manager</a>

                </div>
            </div>


            <div id="text">

            </div>
            <div class="box-footer pull-right">

                <input id="addmore" type="button" class="add btn bg-purple margin" onclick="addInput();" name="add" value="Add More" />
                <button type="submit" class="btn bg-olive margin">Submit</button>


            </div>



        </div>
        <!-- /.box-body -->


        </form>
    </div>




    <div class="modal fade" id="myModals">
        <div class="modal-dialog">
            <div class="modal-content" style="min-width: 731px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title text-light-blue">Image Manager</h4>
                </div>
                <div class="modal-body">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('page-js')

    <script>
        $('body').on('click', '.removeImg', function(){
            $(this).closest('div.form-group').html('').hide();
        });

    </script>
@endsection