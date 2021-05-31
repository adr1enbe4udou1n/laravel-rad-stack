<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    @routes
    @translations
    @vite("admin", "http://localhost:3200/app.ts")
</head>

<body class="antialiased">
    @inertia
</body>

</html>
