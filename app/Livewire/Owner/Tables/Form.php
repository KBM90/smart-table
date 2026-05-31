<?php

namespace App\Livewire\Owner\Tables;

use App\Models\Table;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;

class Form extends Component
{
    public ?int $tableId = null;

    public string $name = '';

    public string $status = Table::STATUS_FREE;

    public function mount(?int $tableId = null): void
    {
        $this->tableId = $tableId;

        if ($tableId === null) {
            $this->authorize('create', Table::class);
            return;
        }

        $table = Table::query()->find($tableId);
        abort_if($table === null, Response::HTTP_NOT_FOUND);
        $this->authorize('update', $table);

        $this->name = $table->name;
        $this->status = $table->status;
    }

    public function save(): void
    {
        if ($this->tableId === null) {
            $this->authorize('create', Table::class);
        }

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tables', 'name')
                    ->where(fn ($query) => $query->where('tenant_id', auth()->user()->tenant_id)->whereNull('deleted_at'))
                    ->ignore($this->tableId),
            ],
        ]);

        if ($this->tableId === null) {
            $table = Table::query()->create([
                'name' => $validated['name'],
                'status' => Table::STATUS_FREE,
            ]);
        } else {
            $table = Table::query()->find($this->tableId);
            abort_if($table === null, Response::HTTP_NOT_FOUND);
            $this->authorize('update', $table);
            $table->update([
                'name' => $validated['name'],
            ]);
        }

        $this->dispatch('table-saved', tableId: $table->id);
    }

    public function render()
    {
        return view('livewire.owner.tables.form');
    }
}
