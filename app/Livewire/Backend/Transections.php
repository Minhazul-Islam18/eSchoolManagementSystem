<?php

namespace App\Livewire\Backend;

use App\Models\BkashTransection;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Transections extends Component
{
    public function mount(User $user)
    {
        $this->authorize('app.transections.index', $user);
    }

    public function render()
    {
        $transections = BkashTransection::all();
        return view('livewire.backend.transections', ['transections' => $transections]);
    }
}
