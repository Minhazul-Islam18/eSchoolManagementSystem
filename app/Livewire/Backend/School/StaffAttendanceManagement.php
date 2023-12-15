<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use Livewire\Attributes\Computed;

#[Title('Staff attendance')]
class StaffAttendanceManagement extends Component
{
    public $class_id;
    public $section_id;
    public $group_id;
    public $editable_item;
    public $sections = [];
    public $groups = [];
    public $students = [];
    public $attendance_date;
    public bool $attendanceSheat = false;

    #[Computed()]
    public function classes()
    {
        return school()->classes;
    }
    public function getAttendanceSheet()
    {
        $this->validate([
            'class_id' => 'required',
            'attendance_date' => 'required',
        ]);

        // Make attendance sheat visible
        $this->attendanceSheat = true;

        //Get filtered students for attendance
        if (isset($this->class_id) && isset($this->section_id)) {
            $this->students = school()->classes()->findOrFail($this->class_id)->classSections()->findOrFail($this->section_id)->students;
        } elseif (isset($this->class_id) && isset($this->group_id)) {
            $this->students = school()->classes()->findOrFail($this->class_id)->groups()->findOrFail($this->group_id)->students;
        }
    }
    public function getSection()
    {
        if ($this->editable_item == null) {
            $this->section_id = null;
            $this->group_id = null;
        }

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

    public function render()
    {
        return view('livewire.backend.school.staff-attendance-management');
    }
}
