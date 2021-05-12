<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ mix('build/admin.css') }}">

    @routes
    <script src="{{ mix('build/admin.js') }}" defer></script>
</head>
<body class="antialiased">
    <div id="app"></div>

    {{-- @inertia --}}
</body>
</html>
