<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>

<body>
    <header class="bg-[var(--color-primary)] text-white sticky top-0 py-2 z-50">
        <x-frontend-navbar />
    </header>

    <main class="min-h-[60vh]">
        {{ $slot }}
    </main>

    <x-footer />
</body>

</html>
