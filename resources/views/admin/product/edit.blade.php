{{--

 * Created by PhpStorm.
 * User: infelicitas
 * Date: 1/20/16
 * Time: 9:09 PM
--}}


@extends('layout.master')

@section('page-css')

    <link href="{{ asset ("assets/dist/css/custom.css") }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <link rel="stylesheet" href="http://aehlke.github.io/tag-it/css/jquery.tagit.css">


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script src="http://aehlke.github.io/tag-it/js/tag-it.js"></script>

@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{Request::segment(0)}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('product')}}">Product</a></li>
            <li class="active">Create</li>
        </ol>
    </section>
    </br>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">     {{ isset($page_title) ? $page_title : '' }}</h3>
        </div>
        <!-- /.box-header -->






        <div class="stepwizard col-md-offset-3">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>General</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Data</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>View</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p>Tax</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                    <p>Other</p>
                </div>


            </div>
        </div>

        {!! Form::open(['route' => array('product_update', $details->id),'role' => 'form','method' => 'post']) !!}
        <div class="row setup-content" id="step-1">
            <div class="col-xs-7 col-md-offset-3">
                <div class="box-body">


                    <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                        <label class="control-label" for="exampleInputEmail1">Product name</label>
                        <input required="required"  type="text" class="form-control" name="name" id="name" value="{{$details->name}}" placeholder="Product name">
                        {!! $errors->has('name')? '<p class="text-red">'.$errors->first('name') .'</p>':'' !!}
                    </div>


                    <div class="form-group {{ $errors->has('meta_tag_description')? 'has-error':'' }}">
                        <label class="control-label" for="exampleInputEmail1">Meta tag Description</label>

                        <textarea    name="meta_tag_description" id="meta_tag_description" class="form-control" rows="3" placeholder="Enter Meta Tag Description">{{$details->meta_tag_description}}</textarea>

                        {!! $errors->has('meta_tag_description')? '<p class="text-red">'.$errors->first('meta_tag_description') .'</p>':'' !!}
                    </div>

                    <div class="form-group {{ $errors->has('meta_keyword_description')? 'has-error':'' }}">
                        <label class="control-label" for="exampleInputEmail1">Meta Keyword Description</label>

                        <textarea  name="meta_keyword_description" id="meta_keyword_description" class="form-control" rows="3" placeholder="Enter Meta Keyword Description">{{$details->meta_keyword_description}}</textarea>

                        {!! $errors->has('meta_keyword_description')? '<p class="text-red">'.$errors->first('meta_keyword_description') .'</p>':'' !!}
                    </div>

                    <div class="form-group {{ $errors->has('description')? 'has-error':'' }}">
                        <label class="control-label" for="exampleInputEmail1">Description</label>

                        <textarea  required name="description" id="description" class="form-control" rows="3" placeholder="Enter  Description">{{$details->description}}</textarea>

                        {!! $errors->has('description')? '<p class="text-red">'.$errors->first('description') .'</p>':'' !!}
                    </div>


                    <div class="form-group {{ $errors->has('product_tag')? 'has-error':'' }}">
                        <label class="control-label" for="exampleInputEmail1">Product Tag <span class="label-hint">( enter, comma, tab )</span></label>

                        <input   type="text" class="form-control" name="product_tag" id="product_tag" value="@foreach($details->getTag as $item) {{$item->getTagName->title}}, @endforeach" placeholder="Product Tag">
                        {!! $errors->has('product_tag')? '<p class="text-red">'.$errors->first('product_tag') .'</p>':'' !!}
                    </div>






                    <button class="btn bg-olive margin nextBtn pull-right" type="button" >Next</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-xs-7 col-md-offset-3">





                <div class="form-group {{ $errors->has('model')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Product Model</label>
                    <input required="required"  type="text" class="form-control" name="model" id="model" value="{{$details->model}}" placeholder="Product Model">
                    {!! $errors->has('model')? '<p class="text-red">'.$errors->first('model') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('sku')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">SKU <span class="label-hint">(Stock Keeping Unit)</span> </label>
                    <input  type="text" class="form-control" name="sku" id="sku" value="{{$details->sku}}" placeholder="SKU">
                    {!! $errors->has('sku')? '<p class="text-red">'.$errors->first('sku') .'</p>':'' !!}
                </div>




                <div class="form-group {{ $errors->has('upc')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">UPC <span class="label-hint">(Universal Product Code)</span> </label>
                    <input   type="text" class="form-control" name="upc" id="upc" value="{{$details->upc}}" placeholder="UPC">
                    {!! $errors->has('upc')? '<p class="text-red">'.$errors->first('upc') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('mpn')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">MPN <span class="label-hint">(Manufacture Part Number)</span></label>
                    <input   type="text" class="form-control" name="mpn" id="mpn" value="{{$details->mpn}}" placeholder="MPN">
                    {!! $errors->has('upc')? '<p class="text-red">'.$errors->first('upc') .'</p>':'' !!}
                </div>



                <div class="form-group {{ $errors->has('isbn')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">ISBN <span class="label-hint">(International Standard Book Number)</span></label>


                    <input   type="text" class="form-control" name="isbn" id="isbn" value="{{$details->isbn}}" placeholder="ISBN">

                    {!! $errors->has('isbn')? '<p class="text-red">'.$errors->first('isbn') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('location')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Location</label>
                    <input   type="text" class="form-control" name="location" id="location" value="{{$details->location}}" placeholder="Location">
                    {!! $errors->has('location')? '<p class="text-red">'.$errors->first('location') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('price')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">price</label>
                    <input required  type="text" class="form-control" name="price" id="price" value="{{$details->price}}" placeholder="Price">
                    {!! $errors->has('price')? '<p class="text-red">'.$errors->first('price') .'</p>':'' !!}
                </div>


                <div class="form-group {{ $errors->has('color')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">color</label>
                    <input  type="text" class="form-control auto" name="color" id="color" value="{{$details->color}}" placeholder="color">
                    {!! $errors->has('color')? '<p class="text-red">'.$errors->first('color') .'</p>':'' !!}
                </div>



                <div class="form-group {{ $errors->has('minimum_quantity')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Minimum Quantity</label>
                    <input required  type="text" class="form-control" name="minimum_quantity" id="minimum_quantity" value="{{$details->minimum_quantity}}" placeholder="Minimum Quantity">
                    {!! $errors->has('minimum_quantity')? '<p class="text-red">'.$errors->first('minimum_quantity') .'</p>':'' !!}
                </div>
                <div class="form-group {{ $errors->has('quantity')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Stock Quantity</label>
                    <input required  type="text" class="form-control" name="quantity" id="quantity" value="{{$details->quantity}}" placeholder="Stock Quantity">
                    {!! $errors->has('quantity')? '<p class="text-red">'.$errors->first('quantity') .'</p>':'' !!}
                </div>

                <div class="form-group  {{ $errors->has('date_available')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Date Available</label>
                    <div class="input-group" >
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="date_available" name="date_available" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" value="{{$details->date_available}}">
                        {!! $errors->has('date_available')? '<p class="text-red">'.$errors->first('date_available') .'</p>':'' !!}
                    </div>
                    <!-- /.input group -->
                </div>


                <div class="form-group">
                    <label class="control-label" for="exampleInputEmail1">Dimension</label>
                    <div class="row">
                        <div class="col-xs-3">
                            <label class="control-label" for="exampleInputEmail1">Length</label>

                            <input id="dimension_length" name="dimension_length" class="form-control" placeholder="Length" type="text" value="{{$details->dimension_length}}">
                            {!! $errors->has('dimension_length')? '<p class="text-red">'.$errors->first('dimension_length') .'</p>':'' !!}
                        </div>
                        <div class="col-xs-3">
                            <label class="control-label" for="exampleInputEmail1">Width</label>
                            <input id="dimension_width" width="dimension_width" class="form-control" placeholder="Width" type="text" value="{{$details->dimension_width}}">
                            {!! $errors->has('dimension_width')? '<p class="text-red">'.$errors->first('dimension_width') .'</p>':'' !!}
                        </div>
                        <div class="col-xs-3">
                            <label class="control-label" for="exampleInputEmail1">Height</label>
                            <input id="dimension_height" name="dimension_height" class="form-control" placeholder="Height" type="text" value="{{$details->dimension_height}}">
                            {!! $errors->has('dimension_height')? '<p class="text-red">'.$errors->first('dimension_height') .'</p>':'' !!}
                        </div>
                    </div>

                </div>

                <div class="form-group  {{ $errors->has('length_class')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">Length Class</label>
                    <select id="length_class" name="length_class" class="form-control">
                        <option value="">Select</option>

                        @foreach($all_length as $all_length_item)

                            <option value="{{$all_length_item->value}} @if ($details->length_class == $all_length_item->value) selected @endif">{{$all_length_item->name}}</option>

                        @endforeach

                    </select>
                    {!! $errors->has('length_class')? '<p class="text-red">'.$errors->first('length_class') .'</p>':'' !!}
                </div>


                <div class="form-group  {{ $errors->has('weight_class')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">Weight Class</label>
                    <select  id="weight_class" name="weight_class" class="form-control">
                        <option value=" ">Select</option>
                        @foreach($all_weight as $all_weight_item)

                            <option value="{{$all_weight_item->value}} @if ($details->weight_class == $all_weight_item->value) selected @endif">{{$all_weight_item->name}}</option>

                        @endforeach
                    </select>
                    {!! $errors->has('weight_class')? '<p class="text-red">'.$errors->first('weight_class') .'</p>':'' !!}
                </div>



                <div class="form-group {{ $errors->has('weight')? 'has-error':'' }}">
                    <label class="control-label " for="exampleInputEmail1">Weight</label>
                    <input   type="text" class="form-control" name="weight" id="weight" value="{{$details->weight}}" placeholder="Weight">
                    {!! $errors->has('weight')? '<p class="text-red">'.$errors->first('weight') .'</p>':'' !!}
                </div>

                <div class="form-group  {{ $errors->has('stock_status')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">Stock Status</label>
                    <select id="stock_status" name="stock_status" class="form-control">
                        <option value="">Select</option>
                        <option value="in_stock"  @if ($details->stock_status == 'in_stock') selected @endif >In Stock</option>
                        <option value="out_of_stock"  @if ($details->stock_status == 'out_of_stock') selected @endif >Out Of Stock</option>
                        <option value="pre_order"  @if ($details->stock_status == 'pre_order') selected @endif >Pre Order</option>

                    </select>
                    {!! $errors->has('stock_status')? '<p class="text-red">'.$errors->first('stock_status') .'</p>':'' !!}
                </div>

{{--                <div class="form-group  {{ $errors->has('status')? 'has-error':'' }}">
                    <label class="control-label" for="exampleInputEmail1">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="">Select</option>
                        <option value="1"  @if ($details->status == '1') selected @endif >Enable</option>
                        <option value="0"  @if ($details->status == '0') selected @endif >Disable</option>

                    </select>
                    {!! $errors->has('status')? '<p class="text-red">'.$errors->first('status') .'</p>':'' !!}
                </div>--}}


                <button class="btn bg-olive margin nextBtn pull-right" type="button" >Next</button>


            </div>
        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">




                    <div class="form-group {{ $errors->has('hot_label')? 'has-error':'' }}">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="hot_label" id="hot_label" @if ($details->hot_label == '1') checked @endif>
                                Is Hot Label
                            </label>
                        </div>
                        {!! $errors->has('hot_label')? '<p class="text-red">'.$errors->first('hot_label') .'</p>':'' !!}
                    </div>



                    <div class="form-group {{ $errors->has('special_deal')? 'has-error':'' }}">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="special_deal" id="special_deal" @if ($details->special_deal == '1') checked @endif >
                                Is Special Deal
                            </label>
                        </div>
                        {!! $errors->has('special_deal')? '<p class="text-red">'.$errors->first('special_deal') .'</p>':'' !!}
                    </div>

                    <div class="form-group {{ $errors->has('is_homepage')? 'has-error':'' }}">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_homepage" id="is_homepage"  @if ($details->is_homepage == '1') checked @endif >
                                Is Show In Homepage
                            </label>
                        </div>
                        {!! $errors->has('is_homepage')? '<p class="text-red">'.$errors->first('is_homepage') .'</p>':'' !!}
                    </div>



                    <div class="form-group {{ $errors->has('is_featured')? 'has-error':'' }}">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_featured" id="is_featured"   @if ($details->is_featured == '1') checked @endif >
                                Is Featured Product
                            </label>
                        </div>
                        {!! $errors->has('is_featured')? '<p class="text-red">'.$errors->first('is_featured') .'</p>':'' !!}
                    </div>



                    <div class="form-group {{ $errors->has('is_pre_order')? 'has-error':'' }}">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_pre_order" id="is_pre_order"   @if ($details->is_pre_order == '1') checked @endif >
                                Is Pre-Order Product
                            </label>
                        </div>
                        {!! $errors->has('is_pre_order')? '<p class="text-red">'.$errors->first('is_pre_order') .'</p>':'' !!}
                    </div>


                    <div class="form-group {{ $errors->has('pre_order_amount')? 'has-error':'' }}">
                        <label class="control-label " for="exampleInputEmail1">Pre Order Amount ( In TK)</label>
                        <input   type="text" class="form-control" name="pre_order_amount" id="pre_order_amount" value="{{$details->pre_order_amount}}" placeholder="Pre Order Amount ( In TK)">
                        {!! $errors->has('pre_order_amount')? '<p class="text-red">'.$errors->first('pre_order_amount') .'</p>':'' !!}
                    </div>




                    <button class="btn bg-olive margin nextBtn pull-right" type="button" >Next</button>

                </div>
            </div>
        </div>



        <div class="row setup-content" id="step-4">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">

                    <fieldset>


                        <div class="form-group {{ $errors->has('is_taxable')? 'has-error':'' }}">

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_taxable" id="is_taxable">
                                    Is Taxable
                                </label>
                            </div>
                            {!! $errors->has('hot_label')? '<p class="text-red">'.$errors->first('hot_label') .'</p>':'' !!}
                        </div>


                        <div class="form-group {{ $errors->has('tax_amount')? 'has-error':'' }}">
                            <label class="control-label " for="exampleInputEmail1">Tax Amount ( In Percent)</label>
                            <input   type="text" class="form-control" name="tax_amount" id="tax_amount" value="{{$details->tax_amount}}" placeholder="Tax Amount ( In Percent)">
                            {!! $errors->has('tax_amount')? '<p class="text-red">'.$errors->first('tax_amount') .'</p>':'' !!}
                        </div>

                    </fieldset>

                    <button class="btn bg-olive margin nextBtn pull-right" type="button" >Next</button>

                </div>
            </div>
        </div>

        <div class="row setup-content" id="step-5">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">

                    <fieldset>


                        <div class="form-group  {{ $errors->has('category_id')? 'has-error':'' }}">
                            <label class="control-label" for="exampleInputEmail1" for="category_id">Category</label>
                            <select required id="category_id" name="category_id" class="form-control">
                                <option value="">Select</option>

                                @foreach($category as $category_item)

                                    <option value="{{$category_item->id}}"  @if ($details->category_id == $category_item->id) selected @endif>{{$category_item->title}}</option>

                                @endforeach

                            </select>
                            {!! $errors->has('category_id')? '<p class="text-red">'.$errors->first('category_id') .'</p>':'' !!}
                        </div>


                        <div class="form-group  {{ $errors->has('subcategory_id')? 'has-error':'' }}">
                            <label class="control-label" for="exampleInputEmail1">Sub Category</label>
                            <select id="subcategory_id" name="subcategory_id" class="form-control">
                                <option value="">Select</option>

                                @if(!empty($sub_category))

                                    <option value="{{$sub_category->id}}"  selected>{{$sub_category->title}}</option>
                                @endif


                            </select>
                            {!! $errors->has('subcategory_id')? '<p class="text-red">'.$errors->first('subcategory_id') .'</p>':'' !!}
                        </div>


                        <div class="form-group  {{ $errors->has('	manufacturer_id')? 'has-error':'' }}">
                            <label class="control-label" for="exampleInputEmail1">Manufacture</label>
                            <select id="manufacturer_id" name="manufacturer_id" class="form-control">
                                <option value="">Select</option>

                                @foreach($manufacture as $manufacture_item)

                                    <option value="{{$manufacture_item->id}}" @if ($details->manufacturer_id == $manufacture_item->id) selected @endif>{{$manufacture_item->name}}</option>

                                @endforeach
                            </select>
                            {!! $errors->has('manufacturer_id')? '<p class="text-red">'.$errors->first('manufacturer_id') .'</p>':'' !!}
                        </div>


                        <div class="form-group {{ $errors->has('tax_amount')? 'has-error':'' }}">
                            <label class="control-label " for="exampleInputEmail1">Reward Point</label>
                            <input   type="text" class="form-control" name="reward_point" id="reward_point" value="{{$details->reward_point}}" placeholder="Reward Point">
                            {!! $errors->has('reward_point')? '<p class="text-red">'.$errors->first('reward_point') .'</p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('discount')? 'has-error':'' }}">
                            <label class="control-label " for="exampleInputEmail1">Discount ( In Percent)</label>
                            <input   type="text" class="form-control" name="discount" id="discount" value="{{$details->discount}}" placeholder="Discount ( In Percent)">
                            {!! $errors->has('discount')? '<p class="text-red">'.$errors->first('discount') .'</p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('inside_dhaka_charge')? 'has-error':'' }}">
                            <label class="control-label " for="exampleInputEmail1">Inside Dhaka Shipping Charge</label>
                            <input required  type="text" class="form-control" name="inside_dhaka_charge" id="inside_dhaka_charge" value="{{ $details->inside_dhaka_charge}}" placeholder="Inside Dhaka Shipping Charge">
                            {!! $errors->has('inside_dhaka_charge')? '<p class="text-red">'.$errors->first('inside_dhaka_charge') .'</p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('other_charge')? 'has-error':'' }}">
                            <label class="control-label " for="exampleInputEmail1">Other Shipping Charge</label>
                            <input  required type="text" class="form-control" name="other_charge" id="other_charge" value="{{ $details->other_charge }}" placeholder="Other Shipping Charge">
                            {!! $errors->has('other_charge')? '<p class="text-red">'.$errors->first('other_charge') .'</p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('inside_dhaka_free_of_charge')? 'has-error':'' }}">
                            <label class="control-label " for="exampleInputEmail1"></label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="inside_dhaka_free_of_charge" id="inside_dhaka_free_of_charge" value="yes"  @if($details->inside_dhaka_free_of_charge =='yes') checked="chacked" @endif>
                                    Inside Dhaka Free Shipment
                                </label>
                            </div>

                            {!! $errors->has('inside_dhaka_free_of_charge')? '<p class="text-red">'.$errors->first('inside_dhaka_free_of_charge') .'</p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('free_of_charge')? 'has-error':'' }}">
                            <label class="control-label " for="exampleInputEmail1"></label>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="free_of_charge" id="free_of_charge" value="yes" @if($details->free_of_charge =='yes') checked="chacked" @endif >
                                        Free Shipment
                                    </label>
                                </div>


                            {!! $errors->has('free_of_charge')? '<p class="text-red">'.$errors->first('free_of_charge') .'</p>':'' !!}
                        </div>
                        <div class="form-group {{ $errors->has('font_image')? 'has-error':'' }}">

                            <label class="control-label " for="exampleInputEmail1">Front Image</label>

                            <input required  type="text" class="form-control" name="font_image" id="font_image" value="{{$details->front_image}}" >

                            <a class="btn bg-orange btn-flat margin" data-toggle="modal"  href="javascript:;" data-target="#myModal" class="btn" type="button">Select Image From Image Manager</a>

                            {!! $errors->has('font_image')? '<p class="text-red">'.$errors->first('font_image') .'</p>':'' !!}

                        </div>

                        <div class="form-group {{ $errors->has('secondary_front_image')? 'has-error':'' }}">

                            <label class="control-label " for="exampleInputEmail1">Secondary Front Image</label>

                            <input   type="text" class="form-control" name="secondary_front_image" id="secondary_front_image" value="{{$details->secondary_front_image}}" >

                            <a class="btn bg-orange btn-flat margin" data-toggle="modal"  href="javascript:;" data-target="#myModalSecondary" class="btn" type="button">Select Image From Image Manager</a>

                            {!! $errors->has('secondary_front_image')? '<p class="text-red">'.$errors->first('secondary_front_image') .'</p>':'' !!}

                        </div>
                    </fieldset>

                    <button type="submit" class="btn bg-olive margin nextBtn pull-right" type="button" >Submit</button>

                </div>
            </div>
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
                        <iframe width="700" height="400" src="{{url('admin/product/dialog?type=2&field_id=font_image&fldr=')}}" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="myModalSecondary">
            <div class="modal-dialog">
                <div class="modal-content" style="min-width: 731px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-light-blue">Image Manager</h4>
                    </div>
                    <div class="modal-body">
                        <iframe width="700" height="400" src="{{url('admin/product/dialog?type=2&field_id=secondary_front_image&fldr=')}}" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


    </div>

@stop

@section('page-js')

    <script src="{{ asset ("assets/dist/js/product_validation.js") }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <!-- InputMask -->
    <script src="{{ asset ("assets/plugins/input-mask/jquery.inputmask.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("assets/plugins/input-mask/jquery.inputmask.date.extensions.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("plugins/input-mask/jquery.inputmask.extensions.js") }}" type="text/javascript"></script>

    <script>

        $(function () {

            $('#product_tag').tagit();
        });
        $(function () {

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
            $("[data-mask]").inputmask();
        });

    </script>
    <script type="text/javascript">
        $(function() {

            //autocomplete
            $("#color").autocomplete({
                source: "{{route('add_to_color_name')}}",
                minLength: 1
            });

        });
    </script>
    <script>
        $.ajaxSetup({ cache: false });
        $('#product_tag').tagit({
            tagSource:function( request, response ) {
                $.ajax({
                    url: "{{route('add_to_tag_name')}}",
                    dataType: "json",
                    data: {
                        txt: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            triggerKeys:['enter', 'comma', 'tab'],
            allowNewTags: true
        });

        $("#category_id").on("change", function () {
            $.ajax({
                type: "GET",
                data: {
                    "id": $("#category_id").val()
                },
                url: "{{route('sub_category_by_category')}}",
                dataType: "JSON",
                success: function (JSONObject) {
                    var peopleHTML = "";

                    // Loop through Object and create peopleHTML

                    for (var key in JSONObject) {

                        if (JSONObject.hasOwnProperty(key)) {

                            peopleHTML += "<option value=" + JSONObject[key]["id"] + ">";

                            peopleHTML += JSONObject[key]["title"];
                            peopleHTML += "</option>";

                        }

                    }

                    // Replace table’s tbody html with peopleHTML

                    $("#subcategory_id").html(peopleHTML);

                }

            });

        });

    </script>
@endsection