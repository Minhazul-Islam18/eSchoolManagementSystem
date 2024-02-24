<?php

namespace App\Livewire\Backend\School;

use App\Models\SchoolStaff;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class StaffsAttendanceReportManagement extends Component
{
    public $attendanceDays;
    public $selectedMonth;

    #[On('set-month')]
    public function setMonth($selectedMonth)
    {
        $this->selectedMonth = $selectedMonth;
    }

    public function render()
    {
        $records = [];
        if ($this->selectedMonth) {
            $year = date('Y');
            // Parse the start and end dates using Carbon
            $startDate = Carbon::create($year, $this->selectedMonth, 1)->startOfMonth();
            $endDate = Carbon::create($year, $this->selectedMonth, 1)->endOfMonth();

            // Assign the attendance data to each student's "attendances" array
            $this->attendanceDays = range(1, Carbon::now()->month($this->selectedMonth)->daysInMonth);

            $records = SchoolStaff::where('status', 1)
                ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate])->orderBy('date');
                }])->get();
        }
        return view('livewire.backend.school.staffs-attendance-report-management', ['records' => $records])->title('Staffs attendance report generate');
    }
}
