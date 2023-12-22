<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use App\Models\StaffAttendance;
use App\Models\StudentAttendance;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Exception;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('Staff attendance')]
class StaffAttendanceManagement extends Component
{
    use LivewireAlert;
    public $ids = [];
    public $attendance_date;
    public bool $attendanceSheat = false;

    #[Computed()]
    public function staffs()
    {
        return school()->staffs;
    }
    public function getAttendanceSheet()
    {
        $this->validate([
            'attendance_date' => 'required',
        ]);

        // Make attendance sheat visible
        $this->attendanceSheat = true;
    }

    #[On('present-getting-ids')]
    public function presentGettingIds($ids)
    {
        Gate::authorize('school.attendance.create');
        foreach ($ids as $staffId) {
            // Check if a record already exists for the given date and staff ID
            $existingRecord = StaffAttendance::where('school_id', school()->id)
                ->where('staff_id', $staffId)
                ->where('date', $this->attendance_date)
                ->first();

            // If no record exists, create a new one
            if (!$existingRecord) {
                StaffAttendance::create([
                    'school_id' => school()->id,
                    'staff_id' => $staffId,
                    'date' => $this->attendance_date,
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
        return view('livewire.backend.school.staff-attendance-management');
    }
}
