
<!-- Development assets -->

@php 
    $favicon = "icons/36-Bluegreen.png";
    $imagePath = "icons/192-Bluegreen.png";
    $manifestJSON = "manifest.json";
@endphp

<link rel="icon" href="{{ asset($favicon) }}" type="image/png" sizes="32x32">
<link rel="shortcut icon" href="{{ asset($imagePath) }}">
<link rel="apple-touch-icon" href="{{ asset($imagePath) }}">
<link rel="manifest" href="{{ asset($manifestJSON) }}">
<title> Veza </title>

<!-- Fonts, Root Variables, Custom CSS, Animate CSS found here from compiled scss -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">