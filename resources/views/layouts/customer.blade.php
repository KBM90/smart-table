<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ \App\Support\CustomerLocale::direction(app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.realtime-config')

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="min-h-screen bg-gradient-to-tr from-slate-50 via-indigo-50/20 to-amber-50/30 font-sans text-slate-800 antialiased">
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
    <div class="absolute -right-10 -top-10 h-72 w-72 rounded-full bg-amber-200/20 blur-[80px] pointer-events-none">
    </div>
    <div class="absolute -left-10 bottom-20 h-72 w-72 rounded-full bg-indigo-200/20 blur-[80px] pointer-events-none">
    </div>

    <main class="mx-auto min-h-screen max-w-3xl px-6 py-10 relative z-10">
        <form method="GET" action="{{ url()->current() }}" class="mb-6 flex justify-end">
            @foreach (request()->except('lang') as $key => $value)
                @if (is_scalar($value))
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach

            <div class="inline-flex items-center gap-2 rounded-xl border border-white/70 bg-white/80 px-3 py-2 shadow-sm backdrop-blur-md transition focus-within:border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-500/20">
                <svg class="h-4 w-4 shrink-0 text-slate-500" aria-hidden="true" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 21a9 9 0 100-18 9 9 0 000 18zm0 0c2.5-2.4 4-5.7 4-9s-1.5-6.6-4-9m0 18c-2.5-2.4-4-5.7-4-9s1.5-6.6 4-9m-8.5 9h17" />
                </svg>
                <label for="customer-language" class="sr-only">{{ __('customer.language.label') }}</label>
                <select id="customer-language" name="lang" onchange="this.form.submit()"
                    class="border-0 bg-transparent p-0 text-xs font-bold text-slate-700 shadow-none transition focus:outline-none focus:ring-0">
                    @foreach (\App\Support\CustomerLocale::options() as $locale => $label)
                        <option value="{{ $locale }}" @selected(app()->getLocale() === $locale)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        {{ $slot }}
    </main>
</body>

</html>
