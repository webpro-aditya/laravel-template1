@extends('layouts.user_type.auth')

@section('page_title', __('Dashboard'))

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container pt-3">
            @include('components.alert')
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card--sec text-white">
                        <div class="card-body text-black pb-2" style="font-size: 22px;font-weight: 600;"> <i
                                class="fas fa-users"></i></div>
                        <div class="card-body text-black pb-2 pt-2" style="font-size: 22px;font-weight: 600;">1259</div>
                        <div class="card-body pt-0" style="color: #6c757d;">Total Customer</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card--sec text-white">
                        <div class="card-body text-black pb-2" style="font-size: 22px;font-weight: 600;"> <i
                                class="fas fa-money-bill-alt"></i></div>
                        <div class="card-body text-black pb-2 pt-2" style="font-size: 22px;font-weight: 600;">$8000
                        </div>
                        <div class="card-body pt-0" style="color: #6c757d;">Total Payment</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


@endsection
