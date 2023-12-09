@extends('layouts.admin')

@section('auth')

    @include('layouts.navbars.auth.nav')    
    <div id="layoutSidenav">        
        @include('layouts.navbars.auth.sidebar')
        @yield('content')
    </div>
    {{-- @include('layouts.footers.auth.footer') --}}

@endsection