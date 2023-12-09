@extends('layouts.user_type.auth')

@section('page_title', __('Dashboard'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Change Password') }}
        <small>{{ __('Set new password for your account') }}</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('Enter Details') }}</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.changePassword') }}" method="post" novalidate>
                        @csrf
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">{{ __('Old Password') }}</label>
                                        <input type="password" class="form-control @error('oldPassword') error @enderror" id="inputOldPassword" placeholder="Old password" name="oldPassword" maxlength="10" required>
                                        @error('oldPassword')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">{{ __('New Password') }}</label>
                                        <input type="password" class="form-control @error('newPassword') error @enderror" id="inputPassword1" placeholder="New password" name="newPassword" maxlength="10" required>
                                        @error('newPassword')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword2">{{ __('Confirm New Password') }}</label>
                                        <input type="password" class="form-control @error('cNewPassword') error @enderror" id="inputPassword2" placeholder="Confirm new password" name="cNewPassword" maxlength="10" required>
                                        @error('cNewPassword')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
               @include('components.alert')
            </div>
        </div>
    </section>
</div>


@endsection
