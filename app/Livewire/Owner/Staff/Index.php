<?php

namespace App\Livewire\Owner\Staff;

use App\Enums\UserRole;
use App\Models\User;
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

    public bool $showForm = false;

    public function mount(): void
    {
        $this->authorize('viewAny', User::class);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function createWaiter(): void
    {
        $this->authorize('create', User::class);
        $this->showForm = true;
    }

    public function closeForm(): void
    {
        $this->showForm = false;
    }

    public function handleSaved(): void
    {
        $this->showForm = false;
        $this->resetPage();
    }

    public function deleteWaiter(int $userId): void
    {
        $staff = User::query()
            ->where('tenant_id', auth()->user()->tenant_id)
            ->find($userId);

        abort_if($staff === null, Response::HTTP_NOT_FOUND);

        $this->authorize('delete', $staff);
        $staff->delete();
    }

    public function render()
    {
        $waiters = User::query()
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('role', UserRole::Waiter->value)
            ->when($this->search !== '', function (Builder $query): void {
                $query->where(function (Builder $nested): void {
                    $nested
                        ->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->latest('id')
            ->paginate(10);

        return view('livewire.owner.staff.index', [
            'waiters' => $waiters,
        ]);
    }
}