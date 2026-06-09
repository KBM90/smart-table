<div class="space-y-6">
    <section
        class="relative overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-2xl shadow-indigo-100/50 backdrop-blur-xl">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span
                    class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-xl border border-indigo-100 shadow-sm inline-block">
                    Owner Staff
                </span>
                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Staff</h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-600 font-medium">Create tenant-scoped waiter
                    accounts and revoke access with soft deletion when staff leave. Assign tables from the Tables page.
                </p>
            </div>

            <button wire:click="createWaiter" type="button"
                class="shrink-0 group inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-3 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                <span>Create Waiter</span>
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>

        <div class="mt-6 max-w-xl">
            <label class="block">
                <span class="mb-2 block text-xs font-black uppercase tracking-[0.2em] text-slate-500">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search waiter name or email..."
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm transition-all duration-200">
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">
        <div
            class="overflow-hidden rounded-[2rem] border border-white/80 bg-white/60 shadow-xl backdrop-blur-md shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 border-b border-slate-100 bg-slate-50/40">
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Assigned Tables</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-transparent">
                        @forelse ($waiters as $waiter)
                            <tr class="group/row transition-colors duration-200 hover:bg-slate-50/50">
                                <td class="px-6 py-4 align-middle">
                                    <p class="font-bold text-slate-800">{{ $waiter->name }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle text-sm text-slate-600 font-medium">{{ $waiter->email }}
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($waiter->assignedTables->isNotEmpty())
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($waiter->assignedTables as $table)
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-slate-100 border border-slate-200 px-2.5 py-0.5 text-[10px] font-bold text-slate-600">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-400"></span>
                                                    {{ $table->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-[11px] text-slate-400 italic">None yet — assign from Tables</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($waiter->email_verified_at)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Provisioned
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700 shadow-sm">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle text-right">
                                    <div class="flex justify-end">
                                        <button wire:click="deleteWaiter({{ $waiter->id }})" type="button"
                                            class="rounded-xl border border-red-200 bg-red-50/50 px-3.5 py-2 text-xs font-bold text-red-600 hover:bg-red-50 hover:border-red-300 shadow-sm transition-all duration-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 mb-3 border border-slate-100">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-800">No Waiters Found</h3>
                                        <p class="mt-1 text-xs text-slate-400 max-w-xs leading-relaxed">Try adjusting your
                                            search query or creating a new waiter account.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 px-6 py-4">
                {{ $waiters->links() }}
            </div>
        </div>

        <div class="space-y-6">
            @if ($showForm)
                <div
                    class="rounded-[2rem] border border-white/80 bg-white/60 p-6 shadow-xl backdrop-blur-md shadow-slate-200/50">
                    <div class="mb-5 flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-lg font-extrabold text-slate-900">Create Waiter</h2>
                        <button wire:click="closeForm" type="button"
                            class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors bg-slate-100 hover:bg-slate-200/80 px-2.5 py-1.5 rounded-lg">Close</button>
                    </div>

                    <livewire:owner.staff.form :key="'staff-form-' . ($showForm ? 'open' : 'closed')"
                        @waiter-saved="handleSaved" />
                </div>
            @endif

            {{-- Help callout --}}
            @if (!$showForm)
                <div class="rounded-[2rem] border border-indigo-100 bg-indigo-50/60 p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-indigo-800">Assigning Tables</p>
                            <p class="mt-1 text-xs text-indigo-700 leading-relaxed">
                                Table assignments are managed from the
                                <a href="{{ route('owner.tables.index') }}"
                                    class="underline font-bold hover:text-indigo-900">Tables page</a>.
                                Each table row has a dropdown to add waiters. Waiters only see requests for their assigned
                                tables.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>