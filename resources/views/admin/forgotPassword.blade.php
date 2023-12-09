<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Project | Admin System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Auctus</b><br>Admin System</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Forgot Password</p>
        <div class="row">
            <div class="col-md-12">
               @include('components.alert')
            </div>
        </div>
          
        <form action="{{ route('admin.resetPasswordUser') }}" method="post" novalidate>
            @csrf
          <div class="form-group has-feedback">
            <input type="email" class="form-control @error('login_email') error @enderror" placeholder="Email" name="login_email" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('login_email')
                <div class="error">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Submit" />
            </div><!-- /.col -->
          </div>
        </form>
        <a href="{{ url('/admin') }}">Login</a><br>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="{{ asset('assets/js/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
  </body>
</html>