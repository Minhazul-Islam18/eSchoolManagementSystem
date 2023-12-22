<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StudentAttendance;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentAttendanceManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $group_id;
    public $editable_item;
    public $sections = [];
    public $groups = [];
    public $students = [];
    public $ids = [];
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

    #[On('present-getting-ids')]
    public function presentGettingIds($ids)
    {
        Gate::authorize('school.attendance.create');
        foreach ($ids as $staffId) {
            // Check if a record already exists for the given date and staff ID
            $existingRecord = StudentAttendance::where('school_id', school()->id)
                ->where('student_id', $staffId)
                ->where('date', $this->attendance_date)
                ->first();

            // If no record exists, create a new one
            if (!$existingRecord) {
                StudentAttendance::create([
                    'school_id' => school()->id,
                    'student_id' => $staffId,
                    'date' => $this->attendance_date,
                    'is_present' => 1,
                ]);

                // $this->alert('success', 'Attendance added.');
            } else {
                // $this->alert('warning', 'Attendance already added.');
            }
        }

        $this->alert('success', 'Attendance added.');
    }

    public function mount()
    {
        Gate::authorize('school.attendance.index');
    }

    public function render()
    {
        return view('livewire.backend.school.student-attendance-management');
    }
}
