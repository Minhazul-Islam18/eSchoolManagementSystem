<?php

namespace App\Livewire\Backend;

use Livewire\Component;

class MenuDdComponent extends Component
{
    public $menuItems;
    public function mount($menuItems)
    {
        $this->menuItems = $menuItems;
    }
    public function render()
    {
        return view('livewire.backend.menu-dd-component');
    }
}
