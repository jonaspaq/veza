
@php 
    $favicon = "https://jonaspaq.github.io/vuespa/public/icons/36-Bluegreen.png";
    $servedImage = "https://jonaspaq.github.io/vuespa/public/icons/192-Bluegreen.png";

    $servedManifest = "https://jonaspaq.github.io/vuespa/public/manifest.json";
@endphp
<link rel="icon" href="{{ $servedImage }}" type="image/gif" sizes="32x32">
<link rel="shortcut icon" href="{{ $servedImage }}">
<link rel="apple-touch-icon" href="{{ $servedImage }}">
<link rel="manifest" href="{{ $servedManifest }}">
<title> Veza </title>


<link rel="stylesheet" href="https://jonaspaq.github.io/vuespa/public/css/app.css">