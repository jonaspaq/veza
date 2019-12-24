
<!-- @php 
    $favicon = "https://jonaspaq.github.io/veza/public/icons/36-Bluegreen.png";
    $servedImage = "https://jonaspaq.github.io/veza/public/icons/192-Bluegreen.png";

    $servedManifest = "https://jonaspaq.github.io/veza/public/manifest.json";
@endphp
<link rel="icon" href="{{ $favicon }}" type="image/gif" sizes="32x32">
<link rel="shortcut icon" href="{{ $servedImage }}">
<link rel="apple-touch-icon" href="{{ $servedImage }}">
<link rel="manifest" href="{{ $servedManifest }}">
<title> Veza </title>


<link rel="stylesheet" href="https://jonaspaq.github.io/veza/public/css/app.css"> -->

@php 
    $favicon = "icons/32-Bluegreen.png";
    $imagePath = "icons/192-Bluegreen.png";

    $manifest = "manifest.json";
@endphp
<link rel="icon" href="{{ secure_asset($favicon) }}" type="image/gif" sizes="32x32">
<link rel="shortcut icon" href="{{ secure_asset($imagePath) }}">
<link rel="apple-touch-icon" href="{{ secure_asset($imagePath) }}">
<link rel="manifest" href="{{ secure_asset($manifest) }}">
<title> Veza </title>


<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">