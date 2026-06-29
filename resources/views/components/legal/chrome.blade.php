@props(['title', 'eyebrow'])

<div class="min-h-screen bg-slate-50">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-5">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3 transition hover:opacity-80" aria-label="Smart Table home">
                <img src="{{ asset('img/system/logo_with_text.png') }}" alt="Smart Table" class="h-12 w-auto object-contain" />
            </a>

            <nav class="flex items-center gap-5 text-sm font-semibold text-slate-600" aria-label="Legal">
                <a href="{{ route('pricing') }}" class="transition hover:text-indigo-600">Pricing</a>
                <a href="{{ route('login') }}" class="transition hover:text-indigo-600">Login</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-6 py-12 sm:py-16">
        <div class="mb-10">
            <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">{{ $eyebrow }}</p>
            <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">{{ $title }}</h1>
            <p class="mt-4 text-sm font-semibold text-slate-500">Last updated: June 29, 2026</p>
        </div>

        <article class="space-y-7 text-base leading-8 text-slate-700 [&_a]:font-semibold [&_a]:text-indigo-600 [&_h2]:pt-4 [&_h2]:text-2xl [&_h2]:font-black [&_h2]:tracking-tight [&_h2]:text-slate-950 [&_p]:max-w-3xl">
            {{ $slot }}
        </article>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex max-w-5xl flex-col gap-4 px-6 py-8 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-500">&copy; {{ date('Y') }} Smart Table. All rights reserved.</p>
            <div class="flex flex-wrap items-center gap-5 text-sm font-semibold text-slate-600">
                <a href="{{ route('legal.terms') }}" class="transition hover:text-indigo-600">Terms</a>
                <a href="{{ route('legal.privacy') }}" class="transition hover:text-indigo-600">Privacy</a>
                <a href="{{ route('legal.refund') }}" class="transition hover:text-indigo-600">Refunds</a>
                <a href="mailto:support@smartable.space" class="transition hover:text-indigo-600">support@smartable.space</a>
            </div>
        </div>
    </footer>
</div>
