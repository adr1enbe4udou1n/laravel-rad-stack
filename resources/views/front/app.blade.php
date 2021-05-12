<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ mix('build/front.css') }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @livewireStyles

    <script src="{{ mix('build/front.js') }}" defer></script>
</head>
<body class="antialiased">
    <div id="app"></div>
    @livewireScripts
</body>
</html>
