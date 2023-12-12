<?php

namespace App\Livewire\Backend\School;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\Attributes\Title;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    public function mount()
    {
        Gate::authorize('school.dashboard.index');
    }
    public function render()
    {
        return view('livewire.backend.school.dashboard');
    }
}
