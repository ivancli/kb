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

    <title>ICL Knowledge Base</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{elixir('css/login.css')}}">
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">
</head>
<body id="skin-cloth">
<section id="login">
    <header>
        <h1><a href="{{url('/')}}">ICL Knowledge Base</a></h1>

        <p class="login-paragraph">Welcome to ICL Knowledge Base. For better browsing experience, please login to
            discover more features of this site.</p>
    </header>

    <div class="clearfix"></div>

    <!-- Login -->
    <form class="box tile animated active" id="box-login">
        {!! csrf_field() !!}
        <h2 class="m-t-0 m-b-15">Login</h2>

        <div class="error-msgs">
            <ul></ul>
        </div>
        <input type="text" name="email" class="login-control m-b-10" placeholder="Email Address">
        <input type="password" name="password" class="login-control" placeholder="Password">

        <div class="checkbox m-b-20">
            <label>
                <input type="checkbox" name="remember" value="1">
                Remember Me
            </label>
        </div>
        <button class="btn btn-sm m-r-5" id="btn-login" onclick="login(); return false;">Login</button>

        <small>
            <a class="box-switcher" data-switch="box-register" href="#">Don't have an Account?</a> or
            <a class="box-switcher" data-switch="box-forgot" href="#">Forgot Password?</a>
        </small>
    </form>

    <!-- Register -->
    <form class="box animated tile" id="box-register">
        {!! csrf_field() !!}
        <h2 class="m-t-0 m-b-15">Register</h2>

        <div class="error-msgs">
            <ul></ul>
        </div>
        <input type="text" name="name" class="login-control m-b-10" placeholder="Full Name">
        <input type="email" name="email" class="login-control m-b-10" placeholder="Email Address">
        <input type="password" name="password" class="login-control m-b-10" placeholder="Password">
        <input type="password" name="password_confirmation" class="login-control m-b-20" placeholder="Confirm Password">

        <button class="btn btn-sm m-r-5" id="btn-register" onclick="register(); return false;">Register</button>

        <small><a class="box-switcher" data-switch="box-login" href="#">Already have an Account?</a></small>
    </form>

    <!-- Forgot Password -->
    <form class="box animated tile" id="box-forgot">
        {!! csrf_field() !!}
        <h2 class="m-t-0 m-b-15">Forgot Password</h2>

        <div class="error-msgs">
            <ul></ul>
        </div>
        <p>Please provide your email address. A confirmation email will be sent to your mailbox.</p>
        <input type="email" class="login-control m-b-20" name="email" placeholder="Email Address">

        <button class="btn btn-sm m-r-5" id="btn-forgot" onclick="forgot()">Forgot Password</button>

        <small><a class="box-switcher" data-switch="box-login" href="#">Already have an Account?</a></small>
    </form>
</section>

<script src="{{elixir('js/login.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    function login() {
        $("#btn-login").prop("disabled", true);
        var $loginBox = $("#box-login");
        hideLoginErrMsg(function () {
            $loginBox.find(".error-msgs ul").empty();
            $.ajax({
                "url": "{{url('login')}}",
                "data": $loginBox.serialize(),
                "method": "post",
                "dataType": "json",
                "success": function (response) {
                    console.info('response', response);
                    if (response.status == true) {
                        $loginBox.fadeOut(function () {
                            $(this).empty().append(
                                    $("<h2>").addClass("m-t-0 m-b-15").text("Welcome back"),
                                    $("<p>").append(
                                            "You will be redirected in 5 seconds. Alternatively, ",
                                            $("<a>").text("click here to start browsing ICL Knowledge Base").attr("href", response.redirectPath),
                                            "."
                                    )
                            ).fadeIn();
                            setTimeout(function () {
                                window.location.href = response.redirectPath;
                            }, 5000);
                        })
                    } else {
                        $("#btn-login").prop("disabled", false);
                        if (response.responseJSON) {
                            try {
                                var $error = response.responseJSON;
                                $.each($error, function (index, error) {
                                    $loginBox.find(".error-msgs ul").append(
                                            $("<li>").text(error)
                                    );
                                });
                                showLoginErrMsg();
                            } catch (e) {
                                $loginBox.find(".error-msgs ul").append(
                                        $("<li>").text("Unable to proceed authentication, please contact Ivan for more detail.")
                                );
                                showLoginErrMsg();
                            }
                        }
                    }
                },
                "error": function (xhr, status, error) {
                    console.info('xhr', xhr);
                    console.info('status', status);
                    console.info('error', error);
                    $("#btn-login").prop("disabled", false);
                    if (xhr.responseJSON) {
                        try {
                            var $error = xhr.responseJSON;
                            $.each($error, function (index, error) {
                                $loginBox.find(".error-msgs ul").append(
                                        $("<li>").text(error)
                                );
                            });
                            showLoginErrMsg();
                        } catch (e) {
                            $loginBox.find(".error-msgs ul").append(
                                    $("<li>").text("Unable to proceed authentication, please contact Ivan for more detail.")
                            );
                            showLoginErrMsg();
                        }
                    }
                }
            });
        });
    }

    function register() {
        $("#btn-register").prop("disabled", true);
        var $registerBox = $("#box-register");
        hideRegisterErrMsg(function () {
            $registerBox.find(".error-msgs ul").empty();
            $.ajax({
                "url": "{{url('register')}}",
                "data": $registerBox.serialize(),
                "method": "post",
                "dataType": "json",
                "success": function (response) {
                    $("#btn-register").prop("disabled", false);
                    console.info('response', response);
                    if (response.status == true) {
                        $registerBox.fadeOut(function () {
                            $(this).empty().append(
                                    $("<h2>").addClass("m-t-0 m-b-15").text("Thank you for your registration"),
                                    $("<p>").text("A confirmation email has been sent to your mailbox. Please follow the instruction to activate your account."),
                                    $("<p>").append(
                                            "Enjoy browsing ",
                                            $("<a>").text("ICL Knowledge Base").attr("href", response.redirecPath),
                                            "."
                                    )
                            ).fadeIn();
                        })
                    }
                },
                "error": function (xhr, status, error) {
                    console.info('xhr', xhr);
                    console.info('status', status);
                    console.info('error', error);
                    $("#btn-register").prop("disabled", false);
                    if (xhr.responseText) {
                        try {
                            var $error = JSON.parse(xhr.responseText);
                            $.each($error, function (index, error) {
                                $registerBox.find(".error-msgs ul").append(
                                        $("<li>").text(error)
                                );
                            });
                            showRegisterErrMsg();
                        } catch (e) {
                            $registerBox.find(".error-msgs ul").append(
                                    $("<li>").text("Unable to proceed registration, please contact Ivan for more detail.")
                            );
                            showRegisterErrMsg();
                        }
                    }
                }
            });
        });
    }

    function forgot() {
        $("#btn-forgot").prop("disabled", true);
        var $forgotBox = $("#box-forgot");
        hideForgotPasswordErrMsg(function () {
            $forgotBox.find(".error-msgs ul").empty();
            $.ajax({
                "url": "{{url('forgot')}}",
                "data": $forgotBox.serialize(),
                "method": "post",
                "dataType": "json",
                "success": function (response) {
                    $("#btn-forgot").prop("disabled", false);
                    console.info('response', response);
                    if (response.status == true) {
                        $forgotBox.fadeOut(function () {
                            $(this).empty().append(
                                    $("<h2>").addClass("m-t-0 m-b-15").text("Forgot Password"),
                                    $("<p>").text("An email has been sent to your mailbox. Please follow the instruction to reset your password.")
                            ).fadeIn();
                        })
                    }
                },
                "error": function (xhr, status, error) {
                    $("#btn-forgot").prop("disabled", false);
                    if (xhr.responseText) {
                        try {
                            var $error = JSON.parse(xhr.responseText);
                            $.each($error, function (index, error) {
                                $forgotBox.find(".error-msgs ul").append(
                                        $("<li>").text(error)
                                );
                            });
                            showForgotPasswordErrMsg();
                        } catch (e) {
                            $forgotBox.find(".error-msgs ul").append(
                                    $("<li>").text("Unable to proceed, please contact Ivan for more detail.")
                            );
                            showForgotPasswordErrMsg();
                        }
                    }
                }
            });
        });
    }

    function showLoginErrMsg(callback) {
        $("#box-login").find(".error-msgs").slideDown(function () {
            if ($.isFunction(callback)) {
                callback();
            }
        });
    }

    function hideLoginErrMsg(callback) {
        $("#box-login").find(".error-msgs").slideUp(function () {
            if ($.isFunction(callback)) {
                callback();
            }
        });
    }

    function showRegisterErrMsg(callback) {
        $("#box-register").find(".error-msgs").slideDown(function () {
            if ($.isFunction(callback)) {
                callback();
            }
        });
    }

    function hideRegisterErrMsg(callback) {
        $("#box-register").find(".error-msgs").slideUp(function () {
            if ($.isFunction(callback)) {
                callback();
            }
        });
    }

    function showForgotPasswordErrMsg(callback) {
        $("#box-forgot").find(".error-msgs").slideDown(function () {
            if ($.isFunction(callback)) {
                callback();
            }
        });
    }

    function hideForgotPasswordErrMsg(callback) {
        $("#box-forgot").find(".error-msgs").slideUp(function () {
            if ($.isFunction(callback)) {
                callback();
            }
        });
    }
</script>
</body>
</html>
