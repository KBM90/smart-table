<div class="space-y-6">
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-medium uppercase tracking-[0.3em] text-sky-600">{{ __('waiter.tables.label') }}</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ __('waiter.tables.title') }}</h1>
        <p class="mt-2 max-w-2xl text-sm text-slate-600">
            {{ __('waiter.tables.intro') }}
        </p>

        @if (session('status'))
            <div
                class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-6 max-w-md">
            <label class="block">
                <span class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('waiter.tables.search') }}</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('waiter.tables.search_placeholder') }}"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-sky-500 focus:bg-white focus:outline-none focus:ring-1 focus:ring-sky-500 transition">
            </label>
        </div>
    </section>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">
                    <th class="px-6 py-4">{{ __('waiter.tables.table') }}</th>
                    <th class="px-6 py-4">{{ __('waiter.tables.status') }}</th>
                    <th class="px-6 py-4 text-right">{{ __('waiter.tables.action') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse ($tables as $table)
                    @php
                        $isAssigned = $table->assignedWaiters->contains('id', $currentUserId);
                    @endphp
                    <tr class="align-middle">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-slate-900">{{ $table->name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if ($table->status === \App\Models\Table::STATUS_FREE)
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    {{ __('waiter.tables.free') }}
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    {{ __('waiter.tables.occupied') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if ($isAssigned)
                                <button wire:click="toggleAssignment({{ $table->id }})" type="button"
                                    class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                    {{ __('waiter.tables.unassign') }}
                                </button>
                            @else
                                <button wire:click="toggleAssignment({{ $table->id }})" type="button"
                                    class="rounded-lg border border-sky-300 bg-sky-50 px-3 py-2 text-xs font-semibold text-sky-700 transition hover:bg-sky-100">
                                    {{ __('waiter.tables.assign') }}
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-sm text-slate-400">
                            {{ __('waiter.tables.none_found') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="border-t border-slate-100 px-6 py-4">
            {{ $tables->links() }}
        </div>
    </section>
</div>
