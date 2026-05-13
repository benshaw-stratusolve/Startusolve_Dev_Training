@props([
    'title' => 'Laracasts'
])

<!DOCTYPE html>
<html lang="en" data-theme="dracula">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function () {
            const theme = localStorage.getItem('theme') || 'dracula';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>
<body class="bg-base-200 min-h-screen">
    <x-nav />

    <main class="max-w-3xl mx-auto mt-6 px-4">
        {{ $slot }}
    </main>
</body>
</html>
