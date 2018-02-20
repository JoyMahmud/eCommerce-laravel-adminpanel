<header class="main-header">
        <!-- Logo -->
        <a href="{{route('admin_dashboard')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>E</b>commerce</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>E</b>commerce</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- Notifications: style can be found in dropdown.less -->

              <!-- Tasks: style can be found in dropdown.less -->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img width="18" src="{{Auth::check() ? Auth::user()->user_image_api :''}}" class="img-circle" alt="{{Auth::check() ? ''.Auth::user()->first_name.'' : 'Admin'}}">
                  <span class="hidden-xs">{{Auth::check() ? ''.Auth::user()->first_name.'  '.Auth::user()->last_name.'' : 'Admin'}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{Auth::check() ? Auth::user()->user_image_api :''}}" class="img-circle" alt="{{Auth::check() ? ''.Auth::user()->first_name.'' : 'Admin'}}">
                    <p>
                      {{Auth::check() ? ''.Auth::user()->first_name.'  '.Auth::user()->last_name.'' : 'Admin'}}
                      <small>{{Auth::check() ? date('F d, Y', strtotime(Auth::user()->created_at)) :''}}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->

            </ul>
          </div>
        </nav>
      </header>