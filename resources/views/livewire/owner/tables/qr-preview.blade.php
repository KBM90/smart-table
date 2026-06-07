<div class="space-y-5">
    <div class="overflow-hidden rounded-2xl bg-white p-4 border border-slate-200 shadow-sm max-w-[200px] mx-auto">
        <img src="{{ $qrDataUrl }}" alt="QR for {{ $table->name }}" class="mx-auto block h-auto w-full">
    </div>

    <div class="space-y-3">
        <h3 class="text-lg font-black text-slate-900">{{ $table->name }}</h3>
        <p class="text-xs text-slate-500 break-all font-mono bg-slate-50 border border-slate-100 p-2.5 rounded-xl shadow-inner select-all block" title="Click to select all">{{ $table->getPublicUrl() }}</p>
    </div>

    <a href="{{ route('owner.tables.qr.download', $table) }}" class="inline-flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        <span>Download PNG</span>
    </a>
</div>