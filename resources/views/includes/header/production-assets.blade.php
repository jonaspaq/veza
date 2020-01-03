
<meta name="google-site-verification" content="UN7mJejqYi-sb5EMWh0Y0_LEea4iTuFuW7v_cvE7MRI" />

@php 
    $favicon = "icons/32-Bluegreen.png";
    $imagePath = "icons/192-Bluegreen.png";

    $manifest = "manifest.json";
@endphp
<link rel="icon" href="{{ secure_asset($favicon) }}" type="image/png" sizes="32x32">
<link rel="shortcut icon" href="{{ secure_asset($imagePath) }}">
<link rel="apple-touch-icon" href="{{ secure_asset($imagePath) }}">
<link rel="manifest" href="{{ secure_asset($manifest) }}">
<title> Veza </title>


<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">