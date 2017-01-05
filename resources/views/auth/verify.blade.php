<!DOCTYPE html>
<!--[if IE 9 ]>
<html class="ie9"><![endif]-->
<!--[if !IE]> -->
<html>
<!-- <![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">

    <meta name="description" content="Violate Responsive Admin Template">
    <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

    <title>ICL Knowledge Base - Verify Account</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{elixir('css/login.css')}}">
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">
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

    <script src="{{elixir('js/login.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        setTimeout(function () {
            window.location.href = "{{url('/')}}";
        }, 5000);
    </script>
</body>
</html>
