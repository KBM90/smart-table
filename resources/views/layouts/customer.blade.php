<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.realtime-config')

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="min-h-screen bg-gradient-to-tr from-slate-50 via-indigo-50/20 to-amber-50/30 font-sans text-slate-800 antialiased">
    <div class="absolute -right-10 -top-10 h-72 w-72 rounded-full bg-amber-200/20 blur-[80px] pointer-events-none">
    </div>
    <div class="absolute -left-10 bottom-20 h-72 w-72 rounded-full bg-indigo-200/20 blur-[80px] pointer-events-none">
    </div>

    <main class="mx-auto min-h-screen max-w-3xl px-6 py-10 relative z-10">
        {{ $slot }}
    </main>
</body>

</html>