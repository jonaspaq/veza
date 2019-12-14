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
<<<<<<< HEAD
    <link rel="icon" href="{{ secure_asset($logoImage) }}" type="image/gif" sizes="32x32">
    <link rel="shortcut icon" href="{{ secure_asset($logoImage) }}">
    <link rel="apple-touch-icon" href="{{ secure_asset($logoImage) }}">
    <link rel="manifest" href="{{ secure_asset('manifest.json') }}">
    <title> Title </title>

    <!-- Cutomized colors. Defined in root css -->
    <link rel="stylesheet" href="{{ secure_asset('css/myRootColors.css') }}">

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ secure_asset('css/animate.css') }}">

    <script src="https://kit.fontawesome.com/0c7710f8d0.js" crossorigin="anonymous"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
=======
    <link rel="icon" href="{{ $servedImage }}" type="image/gif" sizes="32x32">
    <link rel="shortcut icon" href="{{ $servedImage }}">
    <link rel="apple-touch-icon" href="{{ $servedImage }}">
    <link rel="manifest" href="{{ $servedManifest }}">
    <title> Title </title>

    <!-- animate css, variables, fonts, root colors are defined in this css -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="https://jonaspaq.github.io/vuespa/public/css/app.css">
>>>>>>> 319d9628befcc447e31cd165bdbb26d126fb49ba
    
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