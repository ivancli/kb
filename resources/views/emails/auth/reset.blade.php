<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 4/06/2016
 * Time: 11:48 PM
 */
?>
        <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>ICL Knowledge Base Reset Password</h2>

    <div>
        Your ICL Knowledge Base account has requested to reset password. Please use the following link to change your password.
        <a href="{{ url('reset/' . $email . '/' . $confirmation_code) }}" target="_blank">{{ url('reset/' . $email . '/' . $confirmation_code) }}</a>.<br/>
    </div>
</body>
</html>


