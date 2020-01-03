<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Free Social Interaction">
    <meta name="keywords" content="HTML,CSS, JavaScript, Laravel, VueJS, SPA">
    <meta name="author" content="Jonas Paquibot">
    <meta name="theme-color" content="#1d4d4f">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="google-site-verification" content="UN7mJejqYi-sb5EMWh0Y0_LEea4iTuFuW7v_cvE7MRI" />
    
    <link rel="preconnect" href="http://pusher.com">
    <link rel="preconnect" href="https://stats.pusher.com">
    <link rel="preconnect" href="http://dashboard.pusher.com/">
    <link rel="preconnect" href="https://kit-free.fontawesome.com">

    <link rel="dns-prefetch" href="http://pusher.com">
    <link rel="dns-prefetch" href="https://stats.pusher.com">
    <link rel="dns-prefetch" href="http://dashboard.pusher.com/">
    <link rel="dns-prefetch" href="https://kit-free.fontawesome.com">
    
    @includeWhen( config('environment.APP_ENV')=='local' , 'includes.header.development-assets')

    @includeWhen( config('environment.APP_ENV')=='production' || config('environment.APP_ENV')=='staging' , 'includes.header.production-assets')
    
    @include('includes.header.default')
</head>
<body>
    
    <div class="container-fluid vh-100 p-0 m-0" id="app">
    </div>

    @includeWhen( config('environment.APP_ENV')=='local' , 'includes.footer.development-scripts')

    @includeWhen( config('environment.APP_ENV')=='production' || config('environment.APP_ENV')=='staging' , 'includes.footer.production-scripts')

    <noscript>
        Your browser has JavaScript disabled or your browser does not support JavaScript!
    </noscript>
</body>
</html>