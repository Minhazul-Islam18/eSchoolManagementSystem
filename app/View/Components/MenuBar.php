<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuBar extends Component
{
    public $menudata;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menudata =  menu('topbar-menu');
    }

    /** 
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-bar');
    }
}
