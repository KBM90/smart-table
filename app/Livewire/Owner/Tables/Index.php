<?php

namespace App\Livewire\Owner\Tables;

use App\Models\Table;
use App\Models\TableSession;
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

    public function render()
    {
        $tables = Table::query()
            ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->status !== '', fn (Builder $query) => $query->where('status', $this->status))
            ->latest()
            ->paginate(10);

        return view('livewire.owner.tables.index', [
            'tables' => $tables,
            'statusOptions' => [
                Table::STATUS_FREE => 'Free',
                Table::STATUS_OCCUPIED => 'Occupied',
            ],
        ]);
    }
}
