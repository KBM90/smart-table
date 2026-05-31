<section class="mt-6 rounded-2xl border border-amber-500/30 bg-slate-950/60 p-5">
    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-400">Livewire 3</p>
            <p class="mt-2 text-sm text-slate-300">Counter smoke component is active.</p>
        </div>

        <div class="flex items-center gap-3">
            <span class="rounded-lg bg-slate-900 px-3 py-2 text-sm font-semibold text-white">{{ $count }}</span>
            <button wire:click="increment" type="button" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
                Increment
            </button>
        </div>
    </div>
</section>