<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <script>document.documentElement.classList.add('loading');</script>
    <div id="page-loader"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-white/60 backdrop-blur-md transition-opacity duration-500">

        <svg class="w-32 h-32 drop-shadow-xl" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">

            <path class="svg-draw-path" d="M 85 45 L 35 45 C 20 45 20 65 35 65 L 65 65 C 80 65 80 85 65 85 L 25 85"
                stroke="#0f766e" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />

            <path class="svg-draw-path" d="M 25 85 L 35 95 L 65 95 C 85 95 90 75 75 60" stroke="#0f766e"
                stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />

            <line class="svg-draw-path" x1="65" y1="65" x2="90" y2="35" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="105" y2="55" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="95" y2="85" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />
            <line class="svg-draw-path" x1="65" y1="65" x2="60" y2="25" stroke="#14b8a6" stroke-width="4"
                stroke-linecap="round" />

            <circle class="svg-node" cx="90" cy="35" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="105" cy="55" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="95" cy="85" r="5" fill="#14b8a6" />
            <circle class="svg-node" cx="60" cy="25" r="5" fill="#14b8a6" />

        </svg>
    </div>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>