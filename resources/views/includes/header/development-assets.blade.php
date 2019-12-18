
@php 
    $imagePath = "images/hand-peace.png";
    $manifestJSON = "manifest.json";
@endphp
<link rel="icon" href="{{ asset($imagePath) }}" type="image/gif" sizes="32x32">
<link rel="shortcut icon" href="{{ asset($imagePath) }}">
<link rel="apple-touch-icon" href="{{ asset($imagePath) }}">
<link rel="manifest" href="{{ asset($manifestJSON) }}">
<title> Veza </title>

<!-- Fonts, Root Variables, Custom CSS, Animate CSS found here from compiled scss -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">