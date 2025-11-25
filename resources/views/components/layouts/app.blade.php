<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DCodeMania' }}</title>  

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="bg-slate-200 dark:bg-slate-700 min-h-screen flex flex-col">

    <!-- Navbar -->
    @livewire('partials.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    @livewire('partials.footer')

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
