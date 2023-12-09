<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title> Admin System Log in</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" />
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<body class="login-page">

<section class="container-fluid grey-bg">
        <row class="row">
            <div class="wrapper">
                <div class="inner-wrapper">
                    <div class="login-section">
                        <img src="assets/img/logo.webp">
                        @include('components.alert')
                        <form action="{{ route('admin.login') }}" method="post">
                            @csrf
                            <div class="container gfeilds">
                                <div>
                                    <label for="uname"><b>Username or Email Address</b></label>
                                    <input type="text" placeholder="Enter Username" name="email" required>
                                </div>
                                <div>
                                    <label for="psw"><b>Password</b></label>
                                    <input type="password" placeholder="Enter Password" name="password" required>
                                </div>
                                <button type="submit">Login</button>

                            </div><br>

                            <!-- <div class="container flex-2">
                                <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label>
                                <span class="psw">Forgot <a href="#">password?</a></span>
                            </div> -->
                        </form>

                    </div>
                </div>
            </div>
        </row>
    </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>

</html>