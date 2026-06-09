<?php

namespace App\Livewire\Owner\Tables;

use App\Enums\UserRole;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\User;
use App\Services\TableSessionService;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.owner')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    #[Url(as: 'status')]
    public string $status = '';

    public ?int $editingTableId = null;

    public bool $showForm = false;

    public bool $showQrPreview = false;

    // ── Waiter assignment state ───────────────────────────────────────────────

    /** tableId => selected waiter user_id to add (string for select binding) */
    public array $waiterSelectValues = [];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function createTable(): void
    {
        $this->editingTableId = null;
        $this->showQrPreview = false;
        $this->showForm = true;
    }

    public function editTable(int $tableId): void
    {
        $this->editingTableId = $tableId;
        $this->showQrPreview = false;
        $this->showForm = true;
    }

    public function previewQr(int $tableId): void
    {
        $this->editingTableId = $tableId;
        $this->showForm = false;
        $this->showQrPreview = true;
    }

    public function closePanels(): void
    {
        $this->showForm = false;
        $this->showQrPreview = false;
        $this->editingTableId = null;
    }

    public function markFree(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $session = TableSession::query()
            ->where('table_id', $table->getKey())
            ->where('status', TableSession::STATUS_ACTIVE)
            ->first();

        if ($session !== null) {
            $this->authorize('close', $session);
            app(TableSessionService::class)->close($session);

            return;
        }

        $table->markFree();
    }

    public function deleteTable(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('delete', $table);

        $table->delete();

        if ($this->editingTableId === $tableId) {
            $this->closePanels();
        }
    }

    public function handleSaved(int $tableId): void
    {
        $this->editingTableId = $tableId;
        $this->showForm = false;
        $this->showQrPreview = true;
    }

    // ── Waiter assignment ─────────────────────────────────────────────────────

    /**
     * Assign the selected waiter to a table.
     * Idempotent — pivot uses a composite primary key so duplicates are ignored.
     */
    public function assignWaiter(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $waiterId = (int) ($this->waiterSelectValues[$tableId] ?? 0);

        if ($waiterId === 0) {
            return;
        }

        // Verify the waiter belongs to the same tenant.
        $waiter = User::query()
            ->where('id', $waiterId)
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('role', UserRole::Waiter->value)
            ->first();

        if ($waiter === null) {
            return;
        }

        // syncWithoutDetaching prevents duplicates without removing existing ones.
        $table->assignedWaiters()->syncWithoutDetaching([$waiter->getKey()]);

        // Reset the select for this table.
        $this->waiterSelectValues[$tableId] = '';
    }

    /**
     * Remove a waiter assignment from a table.
     */
    public function removeWaiter(int $tableId, int $waiterId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $table->assignedWaiters()->detach($waiterId);
    }

    public function render()
    {
        $tables = Table::query()
            ->with([
                'assignedWaiters:id,name',
            ])
            ->when($this->search !== '', fn(Builder $query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->status !== '', fn(Builder $query) => $query->where('status', $this->status))
            ->latest()
            ->paginate(10);

        // All waiters for this tenant — used to populate assignment dropdowns.
        $waiters = User::query()
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('role', UserRole::Waiter->value)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('livewire.owner.tables.index', [
            'tables' => $tables,
            'waiters' => $waiters,
            'statusOptions' => [
                Table::STATUS_FREE => 'Free',
                Table::STATUS_OCCUPIED => 'Occupied',
            ],
        ]);
    }
}