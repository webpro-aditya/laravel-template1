@extends('layouts.user_type.auth')

@section('page_title', __('Add Customer'))

@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container pt-3">
            @include('components.alert')
            <div class="d-flex justify-content-between mt-4">
                <h1>Add Customer</h1>
                <button type="button" class="btn btn-primary sb-sidenav-dark border-0 text-white cust--btn">Add
                    Customer</button>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Add Customer</li>
            </ol>
            <div class="card mb-4 col-md-10">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Add Customer
                </div>
                <div class="card-body">
              
                    <form action="{{ route('admin.create.customer') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="customer_name" class="form-control-label required">{{ __('Name') }}</label>
                                <div>
                                    <input type="text" name="name" id="customer_name"
                                        class="form-control rounded-0  @error('name') error @enderror"
                                        value="{{ old('name') }}" maxlength="100">
                                    @error('name')
                                        <div class="input-error-box input-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="col-md-6 mb-3">
                                <label for="customer_email" class="form-control-label required">{{ __('Email') }}</label>
                                <div>
                                    <input type="text" name="email" id="customer_email"
                                        class="form-control rounded-0  @error('email') error @enderror"
                                        value="{{ old('email') }}" maxlength="100">
                                    @error('email')
                                        <div class="input-error-box input-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="customer_mobile" class="form-control-label required">{{ __('Mobile') }}</label>
                                <div>
                                    <input type="text" name="mobile" id="customer_mobile"
                                        class="form-control rounded-0  @error('mobile') error @enderror"
                                        value="{{ old('mobile') }}" maxlength="100">
                                    @error('mobile')
                                        <div class="input-error-box input-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-control-label required">Status</label>
                                <select class="form-control rounded-0" type="text" name="status" id="status">
                                    <option value="1" {{ old('status') == '1'  ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ old('status') == '2'  ? 'selected' : '' }}>Inactive</option>
                                </select>

                            </div>
                            <!-- <div class="col-12 mb-3">
                                <label for="">Product Name</label>
                                <input class="form-control rounded-0" type="tel" name="product_name" id="product_name">
                            </div>

                           <div class="col-12 mb-3">
                                <label for="">Product Description</label>
                                <textarea class="form-control rounded-0" type="tel" name="product_description" id="product_description"></textarea>
                           </div> -->

                        </div>
                        
                        <input class="btn btn-warning rounded-0 mt-4" type="submit" value="Save Customer">
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

     
@endsection
