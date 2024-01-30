<?php

namespace App\Livewire\Backend\School;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class StudentFeeCollectionManagement extends Component
{
    use WithPagination;
    public $feeSheat = false;
    public $class_id;
    public $feeModal;
    public $section_id;
    public $group_id;
    public $editable_item;
    public $sections = [];
    public $groups = [];
    public $students = [];
    public $fees = [];
    public $monthly_fees = [];
    public $admission_fees = [];
    public $additional_fees = [];
    public $editable_student = [];

    #[Url(history: true)]
    public $search = '';

    #[Url()]
    public $perPage = 5;


    #[Computed()]
    public function classes()
    {
        return school()->classes;
    }

    public function collectFees($id)
    {
        $this->editable_student = collect(json_decode($this->students)->data)->where('id', $id)->first();
        // dd($this->editable_student);
    }

    public function updateFeeStatus()
    {
        if ($this->monthly_fees) {
            foreach ($this->monthly_fees as $key => $fee) {
                $record =   DB::table('school_monthly_fee_student')->find($key);
                if ($record) {
                    DB::table('school_monthly_fee_student')
                        ->where('id', $key)
                        ->update([
                            'due_amount' => is_array($fee) && isset($fee['amount']) && $fee['amount'] === 1
                                ? 0
                                : max(
                                    0,
                                    $record->due_amount - ($fee['amount'] ?? 0)
                                ),

                            'paid_amount' =>
                            isset($fee['amount']) && $fee['amount'] ? max($record->due_amount, $fee['amount']) : null,
                            'status' => isset($fee['status']) ? $fee['status'] : 0
                        ]);
                }
            }
            $this->monthly_fees = [];
        }

        if ($this->additional_fees) {
            foreach ($this->additional_fees as $key => $fee) {
                $record =   DB::table('school_fee_student')->find($key);
                if ($record) {
                    DB::table('school_fee_student')
                        ->where('id', $key)
                        ->update([
                            'due_amount' => is_array($fee) && isset($fee['amount']) && $fee['amount'] === 1
                                ? 0
                                : max(
                                    0,
                                    $record->due_amount - ($fee['amount'] ?? 0)
                                ),

                            'paid_amount' =>
                            isset($fee['amount']) && $fee['amount'] ? max($record->due_amount, $fee['amount']) : null,
                            'status' => isset($fee['status']) ? $fee['status'] : 'Unpaid'
                        ]);
                }
            }
            $this->additional_fees = [];
        }

        if ($this->admission_fees) {
            foreach ($this->admission_fees as $key => $fee) {
                $record =   DB::table('class_wise_admission_fee_student')->find($key);
                if ($record) {
                    $e =   DB::table('class_wise_admission_fee_student')
                        ->where('id', $key)
                        ->update([
                            'due_amount' => is_array($fee) && isset($fee['amount']) && $fee['amount'] === 1
                                ? 0
                                : max(
                                    0,
                                    $record->due_amount - ($fee['amount'] ?? 0)
                                ),

                            'paid_amount' =>
                            isset($fee['amount']) && $fee['amount'] ? max($record->due_amount, $fee['amount']) : null,
                            'status' => isset($fee['status']) ? $fee['status'] : 0
                        ]);
                }
            }
            $this->additional_fees = [];
        }

        $this->alert('success', 'Fee collected successfully');
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

    public function getStudents()
    {
        if (null != $this->class_id && $this->section_id) {
            $this->students = school()->classes()->findOrFail($this->class_id)->classSections()->findOrFail($this->section_id)->students()
                ->with(['admissionFees', 'fees', 'monthlyFees'])
                ->paginate($this->perPage)->toArray();

            $this->feeSheat = true;
            // dd($this->students);
        } elseif (null != $this->class_id && $this->group_id) {
            $this->students = school()->classes()->findOrFail($this->class_id)->groups()->findOrFail($this->group_id)->students()
                ->with(['admissionFees', 'fees', 'monthlyFees'])
                ->paginate($this->perPage)->toArray();
            $this->feeSheat = true;
            // dd($this->students);
        }
    }

    public function mount()
    {
        Gate::authorize('school.fee-collection.index');
    }

    private function saveS($data)
    {
        $this->students = $data;
    }

    public function render()
    {

        $stds = [];
        if (null != $this->class_id && $this->section_id) {
            $stds = Student::where('school_id', school()->id)->where('school_class_id', $this->class_id)->where('school_class_section_id', $this->section_id)->with(['admissionFees', 'monthlyFees', 'fees'])->search($this->search)->paginate($this->perPage);

            $this->feeSheat = true;
        } elseif (null != $this->class_id && $this->group_id) {
            $stds = school()->classes()->findOrFail($this->class_id)->groups()->findOrFail($this->group_id)->students()
                ->paginate($this->perPage);
            $this->feeSheat = true;
        }

        $this->students = json_encode($stds);
        return view(
            'livewire.backend.school.student-fee-collection-management',
            ['stds' => $stds]
        );


        // return view(
        //     'livewire.users-table',
        //     [
        //         'users' => User::search($this->search)
        //             ->when($this->admin !== '', function ($query) {
        //                 $query->where('is_admin', $this->admin);
        //             })
        //             ->orderBy($this->sortBy, $this->sortDir)
        //             ->paginate($this->perPage)
        //     ]
        // );
    }
}
