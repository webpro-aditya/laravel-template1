<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
  <link rel="icon" type="image/ico" href="{{asset('assets/img/favicon.ico')}}">
  <title>@hasSection('page_title')@yield('page_title') | @endif {{__('Two Tails')}}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/styles.css?v1')}}" rel="stylesheet" type="text/css" />
</head>

<body class="@if(auth()->user()){{'g-sidenav-show bg-gray-100 fixed-header'}}@endif">
  @auth
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
      @yield('auth')
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
  @endauth
  @guest
    @yield('guest')
  @endguest
  
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/scripts.js')}}" type="text/javascript"></script>
  @stack('dashboard')
</body>

</html>
