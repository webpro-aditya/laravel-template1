<!DOCTYPE html>
<html>
<head>
	<title>@hasSection('page_title')@yield('page_title') | @endif Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Auctus Growth">
  <link rel="icon" type="image/png" href="{{asset('assets/frontend/images/fevicon.png')}}">
  <link href="{{asset('assets/frontend/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/frontend/css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Quicksand:400,500" rel="stylesheet">
  <link href="{{asset('assets/frontend/css/havecookies.css')}}" rel="stylesheet" />
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165690206-1"></script>
</head>
<body>

    @yield('guest')
    
  <script src="{{asset('assets/frontend/js/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/frontend/js/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/jquery.ihavecookies.js')}}" type="text/javascript"></script> 
</body>
</html>
