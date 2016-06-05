<!DOCTYPE html>
<!--[if IE 9 ]>
<html class="ie9"><![endif]-->
<!--[if !IE]> -->
<html>
<!-- <![endif]-->
<!-- Mirrored from byrushan.com/projects/sa/1-0-3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 May 2016 10:42:25 GMT -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>ICL Knowledge Base - Verify Account</title>

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

        <form class="box tile animated active" id="box-login" action="{{url('login')}}" method="post">
            <h2 class="m-t-0 m-b-15">{{$msgHeading}}</h2>

            <p>{{$msg}}</p>

            <p>You will be redirected in 5 seconds. Alternatively
                <a href="{{url('/')}}">click here to start browsing ICL Knowledge Base</a>.</p>
        </form>
    </section>

    <!-- Javascript Libraries -->
    <!-- jQuery -->
    <script src="{{asset('assets/external/sa/js/jquery.min.js')}}"></script> <!-- jQuery Library -->

    <!-- Bootstrap -->
    <script src="{{asset('assets/external/sa/js/bootstrap.min.js')}}"></script>

    <!-- All JS functions -->
    <script src="{{asset('assets/external/sa/js/functions.js')}}"></script>
    <script type="text/javascript">
        setTimeout(function () {
            window.location.href = "{{url('/')}}";
        }, 5000);
    </script>
</body>

<!-- Mirrored from byrushan.com/projects/sa/1-0-3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 May 2016 10:42:26 GMT -->
</html>
