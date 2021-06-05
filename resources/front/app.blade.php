<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @livewireStyles

    @vite("front", "http://localhost:3100/app.ts")
</head>

<body class="antialiased">
    <h1>Hello !</h1>

    @livewireScripts
</body>

</html>
