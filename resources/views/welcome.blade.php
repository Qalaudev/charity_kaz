<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Qoldau</title>
    <link rel="icon" type="image/png" href="/storage/navbarImage/logo.png" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preload" as="image" href="/storage/app/public/navbarImage/navbarPhoto1.jpg">
    <link rel="preload" as="image" href="/storage/app/public/navbarImage/navbarPhoto2.jpg">
    <link rel="preload" as="image" href="/storage/app/public/navbarImage/navbarPhoto3.jpg">

</head>
<body>
<div id="app"></div>
<script src="https://www.google.com/recaptcha/api.js?render=6Lfxm00rAAAAAHK2Qegt6PPfC1Stu4D42Pg1QvSR"></script>
<script type="module" src="{{ Vite::asset('resources/js/app.js') }}"></script>
</body>
</html>
