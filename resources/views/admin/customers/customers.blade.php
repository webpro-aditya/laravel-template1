@extends('layouts.user_type.auth')

@section('page_title', __('Customers'))

@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container pt-3">
                @include('components.alert')
                <div class="d-flex justify-content-between mt-4">
                    <h1>Customer List</h1>
                    <button type="button" onclick="window.location.href='{{ route('admin.add.customer') }}'"
                        class="btn btn-primary sb-sidenav-dark border-0 text-white cust--btn">Add Customer</button>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customer List </li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Customer User List
                    </div>
                    <div class="card-body">

                        <div class="filter-form-wrapper mb-5">

                            <form class="form-inline filter-form" method="GET">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="{{ __('Search Name') }}" maxlength="150"
                                            value="{{ $name }}" autocomplete="off">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" name="user_email" id="user_email"
                                            placeholder="{{ __('Search Email') }}" maxlength="150"
                                            value="{{ $email }}" autocomplete="off">
                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="form-group mx-md-3 mb-2">
                                        <button type="submit" class="btn btn-primary mb-2"
                                            value="{{ __('Search') }}">{{ __('Search') }}</button>
                                        <button type="button" class="btn btn-secondary mb-2 reset-btn"
                                            value="{{ __('Reset') }}"
                                            onclick="window.location.href='{{ route('admin.customers') }}'">{{ __('Reset') }}</button>
                                    </div>
                                </div>
                            </form>
                            <hr />
                        </div>
                        <div class="table-responsive ">
                            <table class="table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Stripe Customer ID</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($customers->count() > 0)
                                        @foreach ($customers as $key => $customer)
                                            <tr>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->mobile }}</td>
                                                <td>{{ $customer->stripe_customer_id }}</td>
                                                <td>
                                                    <span
                                                        class="px-4 py-2 badge {{ $customer->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($customer->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5"><span class="">No Customers to show</span></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if ($customers->count() > 0)
                                <div class="pagination_wrapper">
                                    {{ $customers->onEachSide(config('constants.pagination_links_each_side'))->withQueryString()->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection
