@component('mail::message')
# Verify Your Email Address

Hello {{ $user->name }},

Thank you for registering with {{ config('app.name') }}!
Please click the button below to verify your email address.

@component('mail::button', ['url' => $verificationUrl, 'color' => 'success'])
Verify Email Address
@endcomponent

If you did not create an account, no further action is required.

This verification link will expire in {{ config('auth.verification.expire', 60) }} minutes.

If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
<{{ $verificationUrl }}>

    Thanks,<br>
    The {{ config('app.name') }} Team
    @endcomponent