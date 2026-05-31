<div class="space-y-6">
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-6 shadow-2xl shadow-slate-950/40">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Owner tables</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Tables</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-300">Create tenant-scoped tables, preview their QR codes, and manage current availability.</p>
            </div>

            <button wire:click="createTable" type="button" class="rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
                Create table
            </button>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Table 5" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-0">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Status</span>
                <select wire:model.live="status" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:border-amber-400 focus:outline-none focus:ring-0">
                    <option value="">All statuses</option>
                    @foreach ($statusOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
        <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
            <table class="min-w-full divide-y divide-slate-800">
                <thead class="bg-slate-950/70">
                    <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Public URL</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($tables as $table)
                        <tr class="align-top">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-white">{{ $table->name }}</p>
                                <p class="mt-1 text-xs text-slate-400">{{ $table->qr_token }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $table->status === \App\Models\Table::STATUS_FREE ? 'bg-emerald-500/15 text-emerald-300' : 'bg-amber-500/15 text-amber-300' }}">
                                    {{ ucfirst($table->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-300">
                                <a href="{{ $table->getPublicUrl() }}" target="_blank" class="break-all text-amber-300 hover:text-amber-200">{{ $table->getPublicUrl() }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <button wire:click="previewQr({{ $table->id }})" type="button" class="rounded-lg border border-slate-700 px-3 py-2 text-xs font-semibold text-slate-200 hover:border-amber-400 hover:text-amber-300">QR</button>
                                    <a href="{{ route('owner.tables.qr.download', $table) }}" class="rounded-lg border border-slate-700 px-3 py-2 text-xs font-semibold text-slate-200 hover:border-amber-400 hover:text-amber-300">Download QR</a>
                                    <button wire:click="editTable({{ $table->id }})" type="button" class="rounded-lg border border-slate-700 px-3 py-2 text-xs font-semibold text-slate-200 hover:border-amber-400 hover:text-amber-300">Edit</button>
                                    <button wire:click="markFree({{ $table->id }})" type="button" class="rounded-lg border border-slate-700 px-3 py-2 text-xs font-semibold text-slate-200 hover:border-emerald-400 hover:text-emerald-300">Mark Free</button>
                                    <button wire:click="deleteTable({{ $table->id }})" type="button" class="rounded-lg border border-rose-500/40 px-3 py-2 text-xs font-semibold text-rose-200 hover:border-rose-400 hover:text-rose-100">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-400">No tables found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="border-t border-slate-800 px-6 py-4">
                {{ $tables->links() }}
            </div>
        </div>

        <div class="space-y-6">
            @if ($showForm)
                <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-white">{{ $editingTableId ? 'Edit table' : 'Create table' }}</h2>
                        <button wire:click="closePanels" type="button" class="text-sm font-medium text-slate-400 hover:text-white">Close</button>
                    </div>

                    <livewire:owner.tables.form :table-id="$editingTableId" :key="'table-form-'.$editingTableId" @table-saved="handleSaved($event.detail.tableId)" />
                </div>
            @endif

            @if ($showQrPreview && $editingTableId)
                <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-white">QR preview</h2>
                        <button wire:click="closePanels" type="button" class="text-sm font-medium text-slate-400 hover:text-white">Close</button>
                    </div>

                    <livewire:owner.tables.qr-preview :table-id="$editingTableId" :key="'table-qr-'.$editingTableId" />
                </div>
            @endif
        </div>
    </section>
</div>