
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> {{ isset($page_title) ? $page_title : '' }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset ("assets/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>


    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset ("assets/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ asset ("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset ("assets/dist/css/AdminLTE.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset ("assets/dist/css/skins/_all-skins.css") }}" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="{{ asset ("assets/frontend/js/jquery.lazyload.js") }}"></script>
    <![endif]-->

    <!-- bootstrap wysihtml5 - text editor -->

    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}"rel="stylesheet" />

    @yield('page-css')

</head>
<body>

@if(session('success'))

    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ session('success') }}.
    </div>


@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{ session('error') }}
    </div>

@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        {{ session('info') }}.
    </div>



@endif

@yield('content')


@yield('page-js')
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("assets/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("assets/dist/js/app.min.js") }}" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset ("assets/dist/js/pages/dashboard2.js") }}" type="text/javascript"></script>


<script src="{{ asset ("assets/plugins/datatables/jquery.dataTables.js") }}" type="text/javascript"></script>
<script src="{{ asset ("assets/plugins/datatables/dataTables.bootstrap.js") }}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $("img.lazy").lazyload();
    });
</script>
</body>
</html>
