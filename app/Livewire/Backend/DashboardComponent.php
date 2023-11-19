<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class DashboardComponent extends Component
{
    use Authorizable;
    #[Title('Dashboard')]
    public function mount(User $user)
    {
        $this->authorize('app.roles.index', $user);
    }
    public function render()
    {
        return view('livewire.backend.dashboard-component');
    }
}
