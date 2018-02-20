      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{Auth::check() ? Auth::user()->user_image_api :''}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{Auth::check() ? ''.Auth::user()->first_name.'  '.Auth::user()->last_name.'' : 'Admin'}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>





            <li class="treeview {{ Request::is(Request::segment(1).'/slide*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Slideshow</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is(Request::segment(1).'/slide/create')? 'active' :''  }}"><a href="{{ route('new_slideshow') }}"><i class="fa fa-circle-o"></i> New Slideshow</a></li>

                <li class="{{ Request::is(Request::segment(1).'/slide/slideshow')? 'active' :''  }}"><a href="{{ route('slideshow') }}"><i class="fa fa-circle-o"></i>Slideshow List</a></li>

              </ul>
            </li>





            <li class="treeview {{ Request::is(Request::segment(1).'/category*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Category</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is(Request::segment(1).'/category/create')? 'active' :''  }}"><a href="{{ route('new_category') }}"><i class="fa fa-circle-o"></i> New Category</a></li>

                <li class="{{ Request::is(Request::segment(1).'/category/category')? 'active' :''  }}"><a href="{{ route('category') }}"><i class="fa fa-circle-o"></i>Category List</a></li>

              </ul>
            </li>



            <li class="treeview {{ Request::is(Request::segment(1).'/product*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Product</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is(Request::segment(1).'/product/create')? 'active' :''  }}"><a href="{{ route('product_create') }}"><i class="fa fa-circle-o"></i> New Product</a></li>
                <li class="{{ Request::is(Request::segment(1).'/product')? 'active' :''  }}"><a href="{{ route('product') }}"><i class="fa fa-circle-o"></i>Product</a></li>


              </ul>
            </li>


            <li class="treeview {{ Request::is(Request::segment(1).'/special*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Special Offer</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is(Request::segment(1).'/special/create')? 'active' :''  }}"><a href="{{ route('new_offer') }}"><i class="fa fa-circle-o"></i> New Offer</a></li>

                <li class="{{ Request::is(Request::segment(1).'/special/offer')? 'active' :''  }}"><a href="{{ route('offer') }}"><i class="fa fa-circle-o"></i>Offer List</a></li>

              </ul>
            </li>





            <li class="treeview {{ Request::is(Request::segment(1).'/settings*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-share"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul style="display: block;" class="treeview-menu menu-open">


                <li class="">
                  <a href="#"><i class="fa fa-circle-o"></i> Region <i class="fa fa-angle-left pull-right"></i></a>
                  <ul style="display: none;" class="treeview-menu">
                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/region/region-create')? 'active' :''  }}"><a href="{{ route('region_create') }}"><i class="fa fa-circle-o"></i>New Region</a></li>

                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/region/region')? 'active' :''  }}"><a href="{{ route('region') }}"><i class="fa fa-circle-o"></i>Region List</a></li>


                  </ul>
                </li>

                <li class="">
                  <a href="#"><i class="fa fa-circle-o"></i> City <i class="fa fa-angle-left pull-right"></i></a>
                  <ul style="display: none;" class="treeview-menu">
                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/city/city-create')? 'active' :''  }}"><a href="{{ route('city_create') }}"><i class="fa fa-circle-o"></i>New City</a></li>

                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/city/city')? 'active' :''  }}"><a href="{{ route('city') }}"><i class="fa fa-circle-o"></i>City List</a></li>


                  </ul>
                </li>


                <li class="">
                  <a href="#"><i class="fa fa-circle-o"></i> Area <i class="fa fa-angle-left pull-right"></i></a>
                  <ul style="display: none;" class="treeview-menu">
                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/area/area-create')? 'active' :''  }}"><a href="{{ route('area_create') }}"><i class="fa fa-circle-o"></i>New area</a></li>

                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/area/area')? 'active' :''  }}"><a href="{{ route('area') }}"><i class="fa fa-circle-o"></i>area List</a></li>


                  </ul>
                </li>


                <li class="">
                  <a href="#"><i class="fa fa-circle-o"></i> Measurement Attribute <i class="fa fa-angle-left pull-right"></i></a>
                  <ul style="display: none;" class="treeview-menu">
                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/attribute/create')? 'active' :''  }}"><a href="{{ route('attribute_create') }}"><i class="fa fa-circle-o"></i>New Attribute</a></li>

                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/attribute/attribute')? 'active' :''  }}"><a href="{{ route('attribute') }}"><i class="fa fa-circle-o"></i>Attribute List</a></li>


                  </ul>
                </li>



                <li class="">
                  <a href="#"><i class="fa fa-circle-o"></i> Manufacture <i class="fa fa-angle-left pull-right"></i></a>
                  <ul style="display: none;" class="treeview-menu">
                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/manufacture/create')? 'active' :''  }}"><a href="{{ route('manufacture_create') }}"><i class="fa fa-circle-o"></i>New Manufacture</a></li>

                    <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/manufacture/attribute')? 'active' :''  }}"><a href="{{ route('manufacture') }}"><i class="fa fa-circle-o"></i>Manufacture List</a></li>


                  </ul>
                </li>

                <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/common/common')? 'active' :''  }}"><a href="{{ route('common') }}"><i class="fa fa-circle-o"></i>Common Settings</a></li>
                <li class="{{ Request::is(Request::segment(1).'/'.Request::segment(2).'/common/logo')? 'active' :''  }}"><a href="{{ route('logo') }}"><i class="fa fa-circle-o"></i>Logo Settings</a></li>


              </ul>
            </li>



            <li class="treeview {{ Request::is(Request::segment(1).'/articles*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Articles</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is(Request::segment(1).'/about/edit')? 'active' :''  }}"><a href="{{ URL::to('/admin/articles/about/edit') }}"><i class="fa fa-circle-o"></i> About Us</a></li>
                <li class="{{ Request::is(Request::segment(1).'/buy/edit')? 'active' :''  }}"><a href="{{ URL::to('/admin/articles/buy/edit') }}"><i class="fa fa-circle-o"></i> How To Buy</a></li>
                <li class="{{ Request::is(Request::segment(1).'/terms/edit')? 'active' :''  }}"><a href="{{ URL::to('/admin/articles/terms/edit') }}"><i class="fa fa-circle-o"></i> Terms of Use</a></li>
                <li class="{{ Request::is(Request::segment(1).'/policy/edit')? 'active' :''  }}"><a href="{{ URL::to('/admin/articles/policy/edit') }}"><i class="fa fa-circle-o"></i> Privacy Policy</a></li>
                <li class="{{ Request::is(Request::segment(1).'/pre_order/edit')? 'active' :''  }}"><a href="{{ URL::to('/admin/articles/pre_order/edit') }}"><i class="fa fa-circle-o"></i> Pre Order</a></li>
                <li class="{{ Request::is(Request::segment(1).'/request/edit')? 'active' :''  }}"><a href="{{ URL::to('/admin/articles/request/edit') }}"><i class="fa fa-circle-o"></i> Product Request</a></li>

              </ul>
            </li>




            <li class="treeview {{ Request::is(Request::segment(1).'/charge*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Charge</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li class="{{ Request::is(Request::segment(1).'/charge/create')? 'active' :''  }}"><a href="{{ route('charge_create') }}"><i class="fa fa-circle-o"></i> New Charge</a></li>
                <li class="{{ Request::is(Request::segment(1).'/charge/charge')? 'active' :''  }}"><a href="{{ route('charge') }}"><i class="fa fa-circle-o"></i>Charge List</a></li>


              </ul>
            </li>




            <li class="treeview {{ Request::is(Request::segment(1).'/order*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Order</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Request::is(Request::segment(1).'/order/all')? 'active' :''  }}"><a href="{{ route('all') }}"><i class="fa fa-circle-o"></i>All Order</a></li>
                <li class="{{ Request::is(Request::segment(1).'/order/complete')? 'active' :''  }}"><a href="{{ route('complete') }}"><i class="fa fa-circle-o"></i>Complete</a></li>
                <li class="{{ Request::is(Request::segment(1).'/order/cash')? 'active' :''  }}"><a href="{{ route('cash') }}"><i class="fa fa-circle-o"></i> Cash On Delivery</a></li>
                <li class="{{ Request::is(Request::segment(1).'/order/pending')? 'active' :''  }}"><a href="{{ route('pending') }}"><i class="fa fa-circle-o"></i>Online Pending</a></li>
                <li class="{{ Request::is(Request::segment(1).'/order/pre_order')? 'active' :''  }}"><a href="{{ route('pre_order') }}"><i class="fa fa-circle-o"></i>Pre Order</a></li>


              </ul>
            </li>



            <li class="treeview {{ Request::is(asset('log-viewer*'))? 'active' :''  }}">
              <a href="{{ asset('log-viewer') }}" target="_blank">
                <i class="fa fa-th"></i>
                <span>Error Log</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
