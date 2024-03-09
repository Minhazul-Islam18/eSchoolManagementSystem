<?php

namespace App\Livewire\Backend\School;

use App\Models\classGroup;
use App\Models\SchoolClass;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentSummaryManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $student_id;
    public $student;
    public $exam_id;
    public $group_id;
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
    public function getSection()
    {
        if (null != $this->class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->where('school_id', school()->id)->get();
        }
        //If class had no sections, then get all groups.
        if (!sizeof($this->sections)) {
            $this->getGroups();
        } else {
            $this->groups = [];
        }
    }

    public function getGroups()
    {
        if (null != $this->class_id) {
            $this->groups = school()->classes()->findOrFail($this->class_id)->groups;
        }
    }

    public function getExams()
    {
        if (null != $this->class_id && $this->section_id != null || $this->group_id != null) {
            $rowSelect = $this->section_id != null ? 'school_class_section_id' : 'group_id';
            $this->exams = school()->exams()->where('school_class_id', $this->class_id)->where($rowSelect, $this->section_id ?? $this->group_id)->get();
        }
    }

    public function getStudentSummary()
    {
        $this->validate([
            'class_id' => 'required',
            'student_id' => 'required'
        ]);

        if (isset($this->class_id, $this->student_id) && isset($this->section_id) || isset($this->group_id)) {
            if (isset($this->class_id, $this->student_id)) {
                $this->student = Student::with(['fees', 'admissionFees', 'monthlyFees'])->findOrFail($this->student_id);

                if ($this->class_id) {
                    $this->class = SchoolClass::findBySchool($this->class_id);
                }
                if (isset($this->section_id)) {
                    $this->section = SchoolClassSection::where('school_class_id', $this->class_id)
                        ->where('id', $this->section_id)
                        ->firstOrFail();
                } elseif (isset($this->group_id)) {
                    $this->group = classGroup::findOrFail($this->group_id);
                }
            }
            // dd($this->student, $this->section, $this->group);
        }
    }
    public function render()
    {
        return view('livewire.backend.school.student-summary-management');
    }
}
