<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Verification Email</title>
</head>
<body>
    <p>Dear {{ $user->name }}</p>
    <p>Your account has been created. Place click flowing link to active account</p>
    <a href="{{ route('verify', $user->email_verified_token) }}">
        {{ route('verify', $user->email_verified_token) }}
    </a>
    <br>
    <p>Thanks!</p>
</body>
</html>
