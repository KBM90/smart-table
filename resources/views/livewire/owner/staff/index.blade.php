<div class="space-y-6">
    <section class="rounded-2xl border border-slate-800 bg-slate-900 p-6 shadow-2xl shadow-slate-950/40">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.3em] text-amber-400">Owner staff</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Staff</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-300">Create tenant-scoped waiter accounts and revoke access with soft deletion when staff leave.</p>
            </div>

            <button wire:click="createWaiter" type="button" class="rounded-xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
                Create waiter
            </button>
        </div>

        <div class="mt-6 max-w-xl">
            <label class="block">
                <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">Search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Ali or ali@test.com" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-amber-400 focus:outline-none focus:ring-0">
            </label>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(360px,1fr)]">
        <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
            <table class="min-w-full divide-y divide-slate-800">
                <thead class="bg-slate-950/70">
                    <tr class="text-left text-xs font-semibold uppercase tracking-[0.25em] text-slate-400">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Verified</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($waiters as $waiter)
                        <tr class="align-top">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-white">{{ $waiter->name }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-300">{{ $waiter->email }}</td>
                            <td class="px-6 py-4 text-sm text-slate-300">{{ $waiter->email_verified_at ? 'Provisioned' : 'Pending' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end">
                                    <button wire:click="deleteWaiter({{ $waiter->id }})" type="button" class="rounded-lg border border-rose-500/40 px-3 py-2 text-xs font-semibold text-rose-200 hover:border-rose-400 hover:text-rose-100">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-400">No waiters found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="border-t border-slate-800 px-6 py-4">
                {{ $waiters->links() }}
            </div>
        </div>

        <div class="space-y-6">
            @if ($showForm)
                <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-white">Create waiter</h2>
                        <button wire:click="closeForm" type="button" class="text-sm font-medium text-slate-400 hover:text-white">Close</button>
                    </div>

                    <livewire:owner.staff.form :key="'staff-form-'.($showForm ? 'open' : 'closed')" @waiter-saved="handleSaved" />
                </div>
            @endif
        </div>
    </section>
</div>