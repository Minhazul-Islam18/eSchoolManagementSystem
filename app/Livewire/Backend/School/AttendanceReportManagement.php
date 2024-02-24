<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use App\Models\StudentAttendance;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use App\Models\Student;

class AttendanceReportManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $group_id;
    public $sections = [];
    public $groups = [];
    public $fees = [];
    public $students = [];
    public $payments;
    public $student_id;
    public $selectedMonth;
    public $attendanceDays;

    #[On('set-month')]
    public function setMonth($selectedMonth)
    {
        $this->selectedMonth = $selectedMonth;
    }

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

    public function render()
    {
        $r = [];
        if ($this->selectedMonth) {
            $year = date('Y');
            // Parse the start and end dates using Carbon
            $startDate = Carbon::create($year, $this->selectedMonth, 1)->startOfMonth();
            $endDate = Carbon::create($year, $this->selectedMonth, 1)->endOfMonth();

            // Assign the attendance data to each student's "attendances" array
            $this->attendanceDays = range(1, Carbon::now()->month($this->selectedMonth)->daysInMonth);

            $column = $this->section_id ? 'school_class_section_id' : 'class_group_id';
            $r = Student::where('school_class_id', $this->class_id)
                ->where($column, $this->section_id ?? $this->group_id)
                ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate])->orderBy('date');
                }])->get();
        }


        return view('livewire.backend.school.attendance-report-management', ['r' => $r])->title('Student attendance report generate');
    }
}
