<?php

namespace App\Livewire\Backend\School;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TabulationSheetManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $student_id;
    public $exam_id;
    public $group_id;
    public $student = [];
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

    #[Computed()]
    public function subjects()
    {
        return isset($this->section_id)
            ? (school()->classes()->find($this->class_id)?->classSections()->find($this->section_id)?->subjects)
            : (isset($this->group_id)
                ? (school()->classes()->find($this->class_id)?->groups()->find($this->group_id)?->subjects)
                : []);
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
        $this->subjects();
        if (null != $this->class_id && $this->section_id != null || $this->group_id != null) {
            $rowSelect = $this->section_id != null ? 'school_class_section_id' : 'group_id';
            $this->exams = school()->exams()->where('school_class_id', $this->class_id)->where($rowSelect, $this->section_id ?? $this->group_id)->get();
        }
    }

    public function getTabulationSheet()
    {
        // $this->validate([
        //     'class_id' => 'required',
        //     'exam_id' => 'required'
        // ]);

        if (isset($this->class_id) && isset($this->section_id) || isset($this->group_id)) {
            if (isset($this->class_id)) {
                $this->student = Student::with(['school_exam_results'])->get();

                // dd($this->student[1]->school_exam_results);
                // if ($this->class_id) {
                //     $this->class = SchoolClass::findBySchool($this->class_id);
                // }
                // if (isset($this->section_id)) {
                //     $this->section = SchoolClassSection::where('school_class_id', $this->class_id)
                //         ->where('id', $this->section_id)
                //         ->firstOrFail();
                // } elseif (isset($this->group_id)) {
                //     $this->group = classGroup::findOrFail($this->group_id);
                // }
            }
        }
    }
    public function render()
    {
        return view('livewire.backend.school.tabulation-sheet-management');
    }
}
