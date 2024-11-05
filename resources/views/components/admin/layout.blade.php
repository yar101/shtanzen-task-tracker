<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SHTANZEN Tasks</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if(request()->routeIs('tasks'))
        @vite('resources/js/tasks.js')
    @endif
    @if(request()->routeIs('contractors'))
        @vite('resources/js/contractors.js')
    @endif

    @livewireStyles
</head>

<body class="font-sans antialiased bg-neutral-200 text-neutral-900">
<main>
    {{ $slot }}
</main>

@livewireScripts
</body>

</html>
