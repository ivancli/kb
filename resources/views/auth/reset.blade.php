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

        <form class="box animated tile active" id="box-reset">
            {!! csrf_field() !!}
            <h2 class="m-t-0 m-b-15">Reset Password</h2>

            <div class="error-msgs">
                <ul></ul>
            </div>
            <input type="hidden" name="encrypted_email" value="{{$encrypted_email}}">
            <input type="hidden" name="confirmation_code" value="{{ $confirmation_code }}">
            <input type="password" name="password" class="login-control m-b-10" placeholder="Password">
            <input type="password" name="password_confirmation" class="login-control m-b-20" placeholder="Confirm Password">

            <button class="btn btn-sm m-r-5" id="btn-reset" onclick="resetPassword(); return false;">Reset Password</button>
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

    <script type="text/javascript">
        function resetPassword() {
            $("#btn-reset").prop("disabled", true);
            var $resetBox = $("#box-reset");
            hideResetErrMsg(function () {
                $resetBox.find(".error-msgs ul").empty();
                $.ajax({
                    "url": "{{url('reset')}}",
                    "data": $resetBox.serialize(),
                    "method": "post",
                    "dataType": "json",
                    "success": function (response) {
                        $("#btn-reset").prop("disabled", false);
                        console.info('response', response);
                        if (response.status == true) {
                            $resetBox.fadeOut(function () {
                                $(this).empty().append(
                                        $("<h2>").addClass("m-t-0 m-b-15").text("Password Updated"),
                                        $("<p>").text("Your password has been updated successfully."),
                                        "You will be redirected in 5 seconds. Alternatively, ",
                                        $("<a>").text("click here to start browsing ICL Knowledge Base").attr("href", "{{url('/')}}"),
                                        "."
                                ).fadeIn();
                                setTimeout(function(){
                                    window.location.href = "{{url('/')}}";
                                }, 5000);
                            })
                        }
                    },
                    "error": function (xhr, status, error) {
                        $("#btn-reset").prop("disabled", false);
                        if (xhr.responseText) {
                            try {
                                var $error = JSON.parse(xhr.responseText);
                                $.each($error, function (index, error) {
                                    $resetBox.find(".error-msgs ul").append(
                                            $("<li>").text(error)
                                    );
                                });
                                showResetErrMsg();
                            } catch (e) {
                                $resetBox.find(".error-msgs ul").append(
                                        $("<li>").text("Unable to proceed, please contact Ivan for more detail.")
                                );
                                showResetErrMsg();
                            }
                        }
                    }
                });
            });

        }

        function showResetErrMsg(callback) {
            $("#box-reset").find(".error-msgs").slideDown(function () {
                if ($.isFunction(callback)) {
                    callback();
                }
            });
        }

        function hideResetErrMsg(callback) {
            $("#box-reset").find(".error-msgs").slideUp(function () {
                if ($.isFunction(callback)) {
                    callback();
                }
            });
        }
    </script>
</body>
</html>
