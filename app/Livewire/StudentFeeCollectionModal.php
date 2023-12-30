<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class StudentFeeCollectionModal extends ModalComponent
{
    public $fees;
    public function mount($fees)
    {
        $this->fees = $fees;
    }
    public function render()
    {
        return view('livewire.student-fee-collection-modal');
    }
}
