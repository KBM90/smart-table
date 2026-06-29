<div x-data="{
        pendingRemoval: null,
        openRemovalModal(removal) {
            this.pendingRemoval = removal;
        },
        closeRemovalModal() {
            this.pendingRemoval = null;
        },
        confirmRemoval() {
            if (!this.pendingRemoval) return;

            const removal = this.pendingRemoval;
            this.pendingRemoval = null;
            $wire.removeWaiter(removal.tableId, removal.waiterId);
        },
    }" x-on:keydown.escape.window="closeRemovalModal()" class="space-y-6">
    <div wire:loading.flex wire:target="removeWaiter"
        class="fixed inset-0 z-[100] hidden items-center justify-center bg-white/60 backdrop-blur-md">
        <svg class="w-32 h-32 drop-shadow-xl" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="svg-draw-path"
                d="M 85 45 L 35 45 C 20 45 20 65 35 65 L 65 65 C 80 65 80 85 65 85 L 25 85"
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

    <div x-show="pendingRemoval" x-cloak x-transition.opacity style="display: none;"
        class="fixed inset-0 z-[90] flex items-center justify-center bg-slate-950/30 px-4 backdrop-blur-sm"
        aria-modal="true" role="dialog">
        <div x-show="pendingRemoval" x-transition.scale.origin.center style="display: none;"
            @click.outside="closeRemovalModal()"
            class="w-full max-w-md rounded-2xl border border-white/80 bg-white p-6 shadow-2xl shadow-slate-900/20">
            <div class="flex items-start gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.364 18.364A9 9 0 105.636 5.636a9 9 0 0012.728 12.728zM12 8v4m0 4h.01" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h2 class="text-lg font-extrabold text-slate-900">Remove waiter assignment?</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">
                        <span x-text="pendingRemoval?.waiterName"></span> will no longer be assigned to
                        <span class="font-semibold text-slate-800" x-text="pendingRemoval?.tableName"></span>.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" @click="closeRemovalModal()"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-slate-900">
                    Cancel
                </button>
                <button type="button" @click="confirmRemoval()"
                    class="rounded-xl bg-red-600 px-4 py-2 text-sm font-bold text-white shadow-sm shadow-red-600/20 transition hover:bg-red-700">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <section class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-xl border border-indigo-100 shadow-sm inline-block">
                    Owner Tables
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Tables</h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">Create tenant-scoped tables, preview their QR codes, manage availability, and assign waiters.</p>
            </div>

            <button wire:click="createTable" type="button" class="shrink-0 group inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <span>Create Table</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search table name..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            </label>

            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Status</span>
                <select wire:model.live="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
                    <option value="">All statuses</option>
                    @foreach ($statusOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
        <div class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                            <th class="px-6 py-4">Name & Waiters</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Public URL</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($tables as $table)
                            <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                                {{-- Name + assigned waiters + assignment control --}}
                                <td class="px-6 py-4 align-top min-w-[220px]">
                                    <p class="font-bold text-slate-800">{{ $table->name }}</p>
                                    <p class="mt-0.5 text-[10px] text-slate-400 font-mono">{{ $table->qr_token }}</p>

                                    {{-- Assigned waiters --}}
                                    @if ($table->assignedWaiters->isNotEmpty())
                                        <div class="mt-2 flex flex-wrap gap-1.5">
                                            @foreach ($table->assignedWaiters as $waiter)
                                                <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 border border-indigo-100 pl-2 pr-1 py-0.5 text-[10px] font-bold text-indigo-700">
                                                    {{ $waiter->name }}
                                                    <button
                                                        @click="openRemovalModal({
                                                            tableId: {{ $table->id }},
                                                            waiterId: {{ $waiter->id }},
                                                            tableName: @js($table->name),
                                                            waiterName: @js($waiter->name),
                                                        })"
                                                        type="button"
                                                        class="flex h-4 w-4 items-center justify-center rounded-full hover:bg-indigo-200 transition-colors disabled:cursor-not-allowed disabled:opacity-70"
                                                        title="Remove assignment"
                                                    >
                                                        <svg class="h-2.5 w-2.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                                                        </svg>
                                                    </button>
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="mt-1.5 text-[10px] text-slate-400 italic">No waiters assigned</p>
                                    @endif

                                    {{-- Assign waiter control --}}
                                    @if ($waiters->isNotEmpty())
                                        <div class="mt-2 flex gap-1.5">
                                            <select
                                                wire:model="waiterSelectValues.{{ $table->id }}"
                                                class="min-w-0 flex-1 rounded-lg border border-slate-200 bg-white px-2 py-1 text-xs text-slate-700 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 transition"
                                            >
                                                <option value="">Add waiter…</option>
                                                @foreach ($waiters as $waiter)
                                                    @unless ($table->assignedWaiters->contains('id', $waiter->id))
                                                        <option value="{{ $waiter->id }}">{{ $waiter->name }}</option>
                                                    @endunless
                                                @endforeach
                                            </select>
                                            <button
                                                wire:click="assignWaiter({{ $table->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="assignWaiter({{ $table->id }})"
                                                type="button"
                                                class="inline-flex shrink-0 items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700 hover:bg-indigo-100 hover:border-indigo-300 transition-all disabled:cursor-not-allowed disabled:opacity-50"
                                            >
                                                <span wire:loading.remove wire:target="assignWaiter({{ $table->id }})">
                                                    Assign
                                                </span>
                                                <span wire:loading.inline-flex wire:target="assignWaiter({{ $table->id }})"
                                                    class="items-center gap-1.5">
                                                    <svg class="h-3 w-3 animate-spin" viewBox="0 0 24 24" fill="none">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                                    </svg>
                                                    Assigning...
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-top">
                                    @if ($table->status === \App\Models\Table::STATUS_FREE)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Free
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Occupied
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-top text-sm">
                                    <a href="{{ $table->getPublicUrl() }}" target="_blank" class="break-all text-indigo-600 hover:text-indigo-700 font-semibold hover:underline">{{ $table->getPublicUrl() }}</a>
                                </td>

                                <td class="px-6 py-4 align-top">
                                    <div class="flex flex-wrap justify-end gap-1.5">
                                        <button wire:click="previewQr({{ $table->id }})" type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">QR</button>
                                        <a href="{{ route('owner.tables.qr.download', $table) }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">Download QR</a>
                                        <button wire:click="editTable({{ $table->id }})" type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-600 shadow-sm transition-all duration-200">Edit</button>
                                        @if ($table->status !== \App\Models\Table::STATUS_FREE)
                                            <button wire:click="markFree({{ $table->id }})" type="button" class="rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700 hover:bg-emerald-100 hover:border-emerald-300 shadow-sm transition-all duration-200">Mark Free</button>
                                        @endif
                                        <button wire:click="deleteTable({{ $table->id }})" type="button" class="rounded-xl border border-red-200 bg-red-50/50 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 hover:border-red-300 shadow-sm transition-all duration-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-800">No Tables Found</h3>
                                        <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">Try adjusting your search query or creating a new table.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 px-6 py-4">
                {{ $tables->links() }}
            </div>
        </div>

        <div class="space-y-6">
            @if ($showForm)
                <div class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">{{ $editingTableId ? 'Edit Table' : 'Create Table' }}</h2>
                        <button wire:click="closePanels" type="button" class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">Close</button>
                    </div>

                    <livewire:owner.tables.form :table-id="$editingTableId" :key="'table-form-'.$editingTableId" @table-saved="handleSaved($event.detail.tableId)" />
                </div>
            @endif

            @if ($showQrPreview && $editingTableId)
                <div class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">QR Preview</h2>
                        <button wire:click="closePanels" type="button" class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">Close</button>
                    </div>

                    <livewire:owner.tables.qr-preview :table-id="$editingTableId" :key="'table-qr-'.$editingTableId" />
                </div>
            @endif
        </div>
    </section>
</div>
