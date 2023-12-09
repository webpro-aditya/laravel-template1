@extends('layouts.frontend')

@section('guest')
    @include('layouts.navbars.guest.nav')
    @yield('content')
    @include('layouts.footers.guest.footer')
@endsection