<?php

namespace App\Livewire;

use App\Models\FrontendPage;
use Livewire\Component;

class FrontendPageComponent extends Component
{
    public $data;
    public function mount($slug)
    {
        $this->data = FrontendPage::findBySlug($slug);
    }
    public function render()
    {
        dd($this->data);
        return view('livewire.frontend-page-component');
    }
}
