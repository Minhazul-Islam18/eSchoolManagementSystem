<?php

namespace App\Livewire\Backend\School;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\StudentPayment;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Livewire\FeeCollectionSheatTable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FeeCollectionManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $group_id;
    public $editable_item;
    public $sections = [];
    public $groups = [];
    public $fees = [];
    public $previousStudentData = [];
    public $students = [];
    public $ids = [];
    public $fee_id;
    public bool $attendanceSheat = false;
    public $amount;
    public $status;
    public $student_id;
    public $payable_amount;

    #[Computed()]
    public function classes()
    {
        return school()->classes;
    }

    public function setStudentData($studentId)
    {
        $this->student_id = $studentId;
        $fee = Student::find($studentId)->fees()->find($this->fee_id);
        $this->payable_amount = isset($fee->pivot) && $fee->pivot->paid_amount < 0 ? $fee->pivot->due_amount : $fee->pivot->due_amount - $fee->pivot->paid_amount;
        // dd($this->payable_amount);
    }

    public function getCollectionSheet()
    {
        if (isset($this->section_id) || isset($this->group_id)) {
            $this->validate([
                'class_id' => 'required',
                'fee_id' => 'required',
            ]);
            // Call the method before assignment
            $this->hasStudentsChanged();

            // Store the previous value
            $this->previousStudentData = $this->students;
            // Make attendance sheat visible
            $this->attendanceSheat = true;
            $feeId = $this->fee_id;
            //Get filtered students for attendance
            if (isset($this->class_id) && isset($this->section_id)) {

                $this->students = Student::where('school_id', school()->id)
                    ->whereHas('fees', function ($query) use ($feeId) {
                        $query->where('school_fee_student.school_fee_id', $feeId)
                            ->where('school_fee_student.status', 'Unpaid')
                            ->where('school_fee_student.due_amount', '>', 0);
                    })
                    ->with(['fees' => function ($query) use ($feeId) {
                        $query->where('school_fee_student.school_fee_id', $feeId);
                    }])
                    ->where(function ($query) {
                        $query->whereHas('school_class_section', function ($subQuery) {
                            $subQuery->where('id', $this->section_id);
                        });
                    })
                    ->get();
            } elseif (isset($this->class_id) && isset($this->group_id)) {

                $this->students = Student::where('school_id', school()->id)
                    ->whereHas('fees', function ($query) use ($feeId) {
                        $query->where('school_fee_student.school_fee_id', $feeId)
                            ->where('school_fee_student.status', 'Unpaid')
                            ->where('school_fee_student.due_amount', '>', 0);
                    })
                    ->with(['fees' => function ($query) use ($feeId) {
                        $query->where('school_fee_student.school_fee_id', $feeId);
                    }])
                    ->where(function ($query) {
                        $query->whereHas('class_group', function ($subQuery) {
                            $subQuery->where('id', $this->group_id);
                        });
                    })
                    ->get();
            }

            $this->hasStudentsChanged();
        }
    }

    private function hasStudentsChanged()
    {
        // Compare the previous value with the current value
        if ($this->previousStudentData != $this->students) {
            // dd($this->students, $this->previousStudentData);

            // $this->dispatch('pg:eventRefresh-default')->to(FeeCollectionSheatTable::class);
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

    public function getFees()
    {
        if (null != $this->class_id && $this->section_id) {
            $this->fees = school()->classes()->findOrFail($this->class_id)->classSections()->findOrFail($this->section_id)->fees;
        } elseif (null != $this->class_id && $this->group_id) {
            $this->fees = school()->classes()->findOrFail($this->class_id)->groups()->findOrFail($this->group_id)->fees;
        }
    }

    public function updateFeeStatus()
    {
        Gate::authorize('school.fee-collection.update');
        $this->validate([
            'amount' => 'integer|nullable',
            'status' => 'required|in:Paid,Unpaid'
        ]);

        DB::transaction(function () {
            $student = school()->students()->find($this->student_id);
            $student->fees()->updateExistingPivot($this->fee_id, [
                'due_amount' => $this->amount == 0 && $this->status == 'Paid' ? 0 : $student->fees()->find($this->fee_id)->amount - $this->amount,
                'status' => $this->status,
            ]);

            StudentPayment::create([
                'payment_id' => Str::random(6),
                'school_id' => school()->id,
                'student_id' => $this->student_id,
                'fee_id' => $this->fee_id,
                'amount' => $this->amount,
            ]);
        }, 5);

        $this->dispatch('close-modal');
        $this->alert('success', 'Updated successfully');
    }
    public function mount()
    {
        Gate::authorize('school.fee-collection.index');
    }
    public function render()
    {
        return view('livewire.backend.school.fee-collection-management')->title('Student fee collection');
    }
}
