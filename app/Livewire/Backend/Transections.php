<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;

class Transections extends Component
{
    public function mount(User $user)
    {
        $this->authorize('app.transections.index', $user);
    }

    public function render()
    {
        return view('livewire.backend.transections');
    }
}
