<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
<h2>Confirm Your Email Address</h2>

<p>
    Please follow the link below to confirm your email address
    {{ env('APP_URL'). '/user/confirm/'. $token }}
</p>
</body>
</html>