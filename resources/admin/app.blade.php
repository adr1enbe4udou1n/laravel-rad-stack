<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ mix('admin.css', 'build') }}">

    @routes
    <script src="{{ mix('admin.js', 'build') }}" defer></script>
</head>
<body class="antialiased">
    <div id="app"></div>

    {{-- @inertia --}}
</body>
</html>
