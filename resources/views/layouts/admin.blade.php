<!DOCTYPE html> <html lang="en" > <head>
<meta charset="utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <meta
    name="csrf-token" content="{{ csrf_token() }}">
<!-- <link rel="icon" type="image/icon" href="{{asset('assets/img/favicon.ico')}}"> -->
    <title>@hasSection('page_title')@yield('page_title') | @endif {{__('Admin Dashboard')}}</title>
    <link href="{{ asset('css/styles.css?v1') }}" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
    <script type="text/javascript">
        var baseURL = "{{ route('home') }}";
    </script>
</head>

<body>

  @auth
      @yield('auth')
  @endauth
  @guest
      @yield('guest')
  @endguest
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>