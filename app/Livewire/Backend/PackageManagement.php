<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PackageManagement extends Component
{
    use LivewireAlert;
    use AuthorizesRequests;
    public $editable_item;
    public $packages = [];
    public $openCEmodal = false;
    #[Title('Package Management')]
    #[Layout('layouts.backend.admin.layout')]
    public function render()
    {
        return view('livewire.backend.package-management');
    }
}
