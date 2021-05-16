<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @livewireStyles

    @vite(front/app.ts)
</head>
<body class="antialiased">
    @livewireScripts
</body>
</html>
