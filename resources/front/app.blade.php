<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @livewireStyles

    @vite("front/app.ts", "http://localhost:3100")
</head>

<body class="antialiased bg-green-500">
    @livewireScripts
</body>

</html>
