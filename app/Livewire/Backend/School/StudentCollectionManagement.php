<?php

namespace App\Livewire\Backend\School;

use Livewire\Attributes\Computed;
use Livewire\Component;

class StudentCollectionManagement extends Component
{
    public bool $openCEmodal = false;
    #[Computed()]
    public function students()
    {
        return school()->students;
    }
    public function render()
    {
        return view('livewire.backend.school.student-collection-management');
    }
}
