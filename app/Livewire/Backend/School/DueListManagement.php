<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DueListManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $student_id;
    public $exam_id;
    public $group_id;
    public $students = [];
    public $sections = [];
    public $groups = [];
    public $exams = [];
    public $class;
    public $group;
    public $section;
    public $exam;
    public $showAdmitSheat = false;

    #[Computed()]
    public function classes()
    {
        return school()->classes;
    }

    public function getDueList()
    {
        if (null != $this->class_id) {
            $this->students = Student::where('school_class_id', $this->class_id)->where('school_id', school()->id)->with([
                'monthlyFees' => function ($query) {
                    $query->where('due_amount', '>', 0);
                },
                'admissionFees' => function ($query) {
                    $query->where('due_amount', '>', 0);
                },
                'fees' => function ($query) {
                    $query->where('due_amount', '>', 0);
                }
            ])->get();
        }
    }
    public function render()
    {
        return view('livewire.backend.school.due-list-management');
    }
}
