<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 1/06/2016
 * Time: 9:54 PM
 */
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Welcome to ICL Knowledge Base</h2>

    <div>
        Thanks for joining us. Please follow the link below to verify your email address
        <a href="{{ url('register/verify/' . $confirmation_code) }}" target="_blank">{{ url('register/verify/' . $confirmation_code) }}</a>.<br/>
    </div>
</body>
</html>

