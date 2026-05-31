<?php

namespace App\Livewire\Owner;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.owner')]
class HelloLivewire extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.owner.hello-livewire');
    }
}
