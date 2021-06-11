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
    <div class="min-h-screen flex flex-col justify-center items-center bg-primary-400 px-6">
        <a href="{{ route('admin.login') }}" class="text-center uppercase font-bold sm:max-w-md px-12 py-8 bg-white shadow-md overflow-hidden rounded-sm">Go to admin</a>
    </div>

    @livewireScripts
</body>

</html>
