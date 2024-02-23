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
    public $fromDate;
    public $toDate;
    public $attendanceReport;

    #[On('set-month')]
    public function setMonth($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
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
        $attendanceRecords = [];
        if ($this->fromDate && $this->toDate) {
            // Parse the start and end dates using Carbon
            $startDate = Carbon::parse($this->fromDate)->startOfMonth();
            $endDate = Carbon::parse($this->toDate)->endOfMonth();

            // Fetch attendance records for the selected date range
            $attendanceRecords = StudentAttendance::whereBetween('date', [$startDate, $endDate])
                ->orderBy('date')
                ->get();

            // Initialize an array to hold attendance data for each day of the month
            $attendanceByDay = [];

            // Loop through each day of the month
            $currentDate = clone $startDate;
            while ($currentDate <= $endDate) {
                $dayNumber = $currentDate->format('j');

                // Check if attendance data exists for the current date for all students
                $attendancesForDate = $attendanceRecords->filter(function ($attendance) use ($currentDate) {
                    return Carbon::parse($attendance['date'])->isSameDay($currentDate);
                });

                // Populate the attendance data for the current day for all students
                $attendanceByDay[$dayNumber] = $attendancesForDate->toArray();

                // Move to the next day
                $currentDate->addDay();
            }

            // Assign the attendance data to each student's "attendances" array
            $this->attendanceReport = $attendanceByDay;
            $column = $this->section_id ? 'school_class_section_id' : 'class_group_id';
            $r = Student::where('school_class_id', $this->class_id)
                ->where($column, $this->section_id ?? $this->group_id)
                ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate])->orderBy('date');
                }])->get();
            // dd($r, $this->attendanceReport);
        }


        return view('livewire.backend.school.attendance-report-management', ['r' => $r])->title('Attendance report generate');
    }
}
