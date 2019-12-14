<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Free Social Interaction">
    <meta name="keywords" content="HTML,CSS, JavaScript, Laravel, VueJS, SPA">
    <meta name="author" content="Jonas Paquibot">
    <meta name="theme-color" content="#273746">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php 
    $static_logoImage = "images/hand-peace.png"; 
    $servedImage = "https://jonaspaq.github.io/vuespa/public/images/hand-peace.png";
    $servedManifest = "https://jonaspaq.github.io/vuespa/public/manifest.json";
    @endphp
    <link rel="icon" href="{{ $servedImage }}" type="image/gif" sizes="32x32">
    <link rel="shortcut icon" href="{{ $servedImage }}">
    <link rel="apple-touch-icon" href="{{ $servedImage }}">
    <link rel="manifest" href="{{ $servedManifest }}">
    <title> Title </title>

    <!-- animate css, variables, fonts, root colors are defined in this css -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="https://jonaspaq.github.io/vuespa/public/css/app.css">
    
    <style>
    *{
        margin:0;
        padding:0;
    }
    html{
        scroll-behavior: smooth;
    }
    body{
        /* background-image: linear-gradient(#0F2027, #203A43, #2C5364); */
        background-image: linear-gradient(#ECE9E6, #FFFFFF);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    </style>
</head>
<body>
    
    <div class="container-fluid vh-100 p-0 m-0" id="app">
        <App />
    </div>

    <script src="https://jonaspaq.github.io/vuespa/public/js/app.js"></script>
    <script src="https://kit.fontawesome.com/0c7710f8d0.js" crossorigin="anonymous"></script>

    <noscript>
        Your browser has JavaScript disabled or your browser does not support JavaScript!
    </noscript>
</body>
</html>