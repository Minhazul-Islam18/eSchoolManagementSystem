<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuBarDropdown extends Component
{
    public $dropdown;
    /**
     * Create a new component instance.
     */
    public function __construct($items)
    {
        $this->dropdown = $items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-bar-dropdown');
    }
}
