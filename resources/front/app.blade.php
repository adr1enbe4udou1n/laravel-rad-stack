<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @livewireStyles

    @vite(front/app.ts)
</head>
<body class="antialiased">
    <div id="app">
        <span v-bind:title="message">
            Hover your mouse over me for a few seconds to see my dynamically-bound
            title!
        </span>
        <hello-world msg="Hello Vue 3 + TypeScript + Vite"></hello-world>
    </div>
    @livewireScripts
</body>
</html>
