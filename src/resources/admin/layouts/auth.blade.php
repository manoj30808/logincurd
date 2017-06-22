<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/plugins/images/favicon.png')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    
    <link href="{{asset('admin/css/custom.css')}}" id="theme" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset('admin/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
   
    @yield('content')
        
    <script src="{{asset('admin/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('admin/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
</body>

</html>