<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<!--[if !IE]> -->
<html>
<!-- <![endif]-->
<!-- Mirrored from byrushan.com/projects/sa/1-0-3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 May 2016 10:42:25 GMT -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>ICL Knowledge Base</title>

    <!-- CSS -->
    <link href="{{asset('assets/external/sa/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/external/sa/css/form.css')}}" rel="stylesheet">
    <link href="{{asset('assets/external/sa/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/external/sa/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/external/sa/css/generics.css')}}" rel="stylesheet">
    <link href="{{asset('assets/internal/css/app.css')}}" rel="stylesheet">
</head>
<body id="skin-cloth">
    <section id="login">
        <header>
            <h1><a href="{{url('/')}}">ICL Knowledge Base</a></h1>
            <p class="login-paragraph">Welcome to ICL Knowledge Base. For better browsing experience, please login to discover more features of this site.</p>
        </header>

        <div class="clearfix"></div>

        <!-- Login -->
        <form class="box tile animated active" id="box-login" action="{{url('login')}}" method="post">
            {!! csrf_field() !!}
            <h2 class="m-t-0 m-b-15">Login</h2>
            <input type="text" name="email" class="login-control m-b-10" placeholder="Email Address">
            <input type="password" name="password" class="login-control" placeholder="Password">
            <div class="checkbox m-b-20">
                <label>
                    <input type="checkbox">
                    Remember Me
                </label>
            </div>
            <button class="btn btn-sm m-r-5" type="submit">Sign In</button>

            <small>
                <a class="box-switcher" data-switch="box-register" href="#">Don't have an Account?</a> or
                <a class="box-switcher" data-switch="box-reset" href="#">Forgot Password?</a>
            </small>
        </form>

        <!-- Register -->
        <form class="box animated tile" id="box-register" action="{{url('register')}}" method="post">
            {!! csrf_field() !!}
            <h2 class="m-t-0 m-b-15">Register</h2>
            <input type="text" name="name" class="login-control m-b-10" placeholder="Full Name">
            <input type="email" name="email" class="login-control m-b-10" placeholder="Email Address">
            <input type="password" name="password" class="login-control m-b-10" placeholder="Password">
            <input type="password" name="password_confirmation" class="login-control m-b-20" placeholder="Confirm Password">

            <button class="btn btn-sm m-r-5" type="submit">Register</button>

            <small><a class="box-switcher" data-switch="box-login" href="#">Already have an Account?</a></small>
        </form>

        <!-- Forgot Password -->
        <form class="box animated tile" id="box-reset">
            <h2 class="m-t-0 m-b-15">Reset Password</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>
            <input type="email" class="login-control m-b-20" placeholder="Email Address">

            <button class="btn btn-sm m-r-5">Reset Password</button>

            <small><a class="box-switcher" data-switch="box-login" href="#">Already have an Account?</a></small>
        </form>
    </section>

    <!-- Javascript Libraries -->
    <!-- jQuery -->
    <script src="{{asset('assets/external/sa/js/jquery.min.js')}}"></script> <!-- jQuery Library -->

    <!-- Bootstrap -->
    <script src="{{asset('assets/external/sa/js/bootstrap.min.js')}}"></script>

    <!--  Form Related -->
    <script src="{{asset('assets/external/sa/js/icheck.js')}}"></script> <!-- Custom Checkbox + Radio -->

    <!-- All JS functions -->
    <script src="{{asset('assets/external/sa/js/functions.js')}}"></script>
</body>

<!-- Mirrored from byrushan.com/projects/sa/1-0-3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 May 2016 10:42:26 GMT -->
</html>
