@component('mail::message')
# Email Verification

Please click the button to verify your email.

This mail will expire soon please use the verification link as soon as possible.

@component('mail::button', ['url' => $url])
Verify Email
@endcomponent

If the button does not work, try opening this link <a href="{{$url}}"> {{ $url }} </a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
