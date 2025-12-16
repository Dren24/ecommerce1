<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RevnoParts Inventory System' }}</title>  

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-200 dark:bg-slate-700 min-h-screen flex flex-col">

    @livewire('partials.navbar')

    <main class="flex-grow">
        {{ $slot }}
    </main>

    @livewire('partials.footer')

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireAlertScripts

    <!-- 🌙 DARK MODE SCRIPT (FINAL FIX) -->
    <script>
        function applyTheme(theme) {
            const html = document.documentElement;
            const sun = document.getElementById('theme-sun');
            const moon = document.getElementById('theme-moon');

            if (!sun || !moon) return;

            if (theme === 'dark') {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');

                sun.classList.remove('hidden');
                moon.classList.add('hidden');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');

                moon.classList.remove('hidden');
                sun.classList.add('hidden');
            }
        }

        function initThemeToggle() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            applyTheme(savedTheme);

            const toggleBtn = document.getElementById('theme-toggle');
            if (toggleBtn && !toggleBtn.dataset.bound) {
                toggleBtn.dataset.bound = "true";

                toggleBtn.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.contains('dark');
                    applyTheme(isDark ? 'light' : 'dark');
                });
            }
        }

        // First page load
        document.addEventListener('DOMContentLoaded', initThemeToggle);

        // Livewire navigation support
        document.addEventListener('livewire:navigated', initThemeToggle);
    </script>

</body>
</html>
