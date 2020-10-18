<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>Email Confirmation</h2>
    <p>Hey {{$name}}, thank you for registering your account with us. You are almost ready to start enjoying our platform.
    Simply click the link below to verify your email address.
    </p>

    <a href="{{$confirmation_link}}">Confirm Email</a>
  </body>
</html>