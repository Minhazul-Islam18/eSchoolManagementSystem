<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class StudentFeeCollectionModal extends ModalComponent
{
    public $student;
    public function mount($student)
    {
        dd($student);
    }
    public function render()
    {
        return view('livewire.student-fee-collection-modal');
    }
}
