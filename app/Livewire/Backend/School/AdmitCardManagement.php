<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AdmitCardManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
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

    public function getAdmitCardSheet()
    {
        $school = school();
        if ($this->class_id) {
            $this->class =
                school()->classes()
                ->select(['id', 'class_name'])
                ->findOrFail($this->class_id)
                ->with(['classSections', 'groups'])
                ->firstOrFail();
        }

        if ($this->section_id) {
            $this->section = $this->class
                ->classSections()
                ->select(['id', 'section_name'])
                ->findOrFail($this->section_id)
                ->firstOrFail();
        } elseif ($this->group_id) {
            $this->group = $this->class
                ->groups()
                ->select(['id', 'section_name'])
                ->findOrFail($this->group_id)
                ->firstOrFail();
        }

        if ($this->exam_id) {
            $this->exam = $school->exams()->findOrFail($this->exam_id);
        }

        // dd($this->exam);
        $this->showAdmitSheat = true;
    }

    public function render()
    {
        return view('livewire.backend.school.admit-card-management')->title('Admit card manage');
    }
}
