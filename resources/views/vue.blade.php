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
        $logoImage = "images/hand-peace.png";
    @endphp
    <link rel="icon" href="{{ asset($logoImage) }}" type="image/gif" sizes="32x32">
    <link rel="shortcut icon" href="{{ asset($logoImage) }}">
    <link rel="apple-touch-icon" href="{{ asset($logoImage) }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <title> Title </title>

    <!-- animate css, variables, fonts, root colors are defined in this css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://kit.fontawesome.com/0c7710f8d0.js" crossorigin="anonymous"></script>
    
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

    <script src=" {{ mix('js/app.js') }} "></script>

    <noscript>
        Your browser has JavaScript disabled or your browser does not support JavaScript!
    </noscript>
</body>
</html>