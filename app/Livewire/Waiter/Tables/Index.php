<?php

namespace App\Livewire\Waiter\Tables;

use App\Models\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.waiter')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    public function toggleAssignment(int $tableId): void
    {
        $table = Table::query()->find($tableId);
        abort_if($table === null, 404);

        $user = auth()->user();

        if ($table->assignedWaiters()->where('users.id', $user->getKey())->exists()) {
            $table->assignedWaiters()->detach($user->getKey());
        } else {
            $table->assignedWaiters()->syncWithoutDetaching([$user->getKey()]);
        }
    }

    public function render()
    {
        $userId = auth()->id();

        $tables = Table::query()
            ->with(['assignedWaiters' => fn($q) => $q->select('users.id')])
            ->when($this->search !== '', fn(Builder $q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.waiter.tables.index', [
            'tables' => $tables,
            'currentUserId' => $userId,
        ]);
    }
}