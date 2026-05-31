<div class="space-y-5">
    <div class="overflow-hidden rounded-2xl bg-white p-4">
        <img src="{{ $qrDataUrl }}" alt="QR for {{ $table->name }}" class="mx-auto block h-auto w-full max-w-xs">
    </div>

    <div class="space-y-2">
        <h3 class="text-lg font-semibold text-white">{{ $table->name }}</h3>
        <p class="text-sm text-slate-300 break-all">{{ $table->getPublicUrl() }}</p>
    </div>

    <a href="{{ route('owner.tables.qr.download', $table) }}" class="inline-flex w-full justify-center rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
        Download PNG
    </a>
</div>