<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\StudentPayment;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CollectionUpdateManagement extends Component
{
    use WithPagination, LivewireAlert;
    public $editable_item;
    public $relation;
    public $amount;
    public $status;
    #[Url(history: true)]
    public $search = '';

    #[Url()]
    public $perPage = 5;

    public function editTransection(StudentPayment $studentPayment)
    {
        abort_action($studentPayment->school->user_id);
        $this->editable_item = $studentPayment;
        $this->amount = $this->editable_item->amount;
        $this->relation = DB::table('school_fee_student')
            ->where('student_id', $this->editable_item->student_id)
            ->where('school_fee_id', $this->editable_item->fee_id)
            ->first();
        $this->status = $this->relation->status == 'Paid' ? 1 : 0;
    }

    public function updateTransection()
    {
        abort_action($this->editable_item->school->user_id);
        DB::transaction(function () {
            if ($this->relation) {
                DB::table('school_fee_student')
                    ->where('student_id', $this->editable_item->student_id)
                    ->where('school_fee_id', $this->editable_item->fee_id)
                    ->update([
                        'due_amount' =>  $this->amount == 0 && $this->status == 'Paid'
                            ? 0
                            : max(
                                0,
                                $this->relation->due_amount - ($this->amount ?? 0)
                            ),

                        'paid_amount' =>
                        isset($this->amount) && $this->amount ? max($this->relation->due_amount, $this->amount) : null,
                        'status' => isset($this->status) ? $this->status : 'Unpaid'
                    ]);
            }
            $this->editable_item->update([
                'amount' => $this->amount
            ]);

            $this->alert('success', 'Record updated successfully');
        }, 5);
    }

    public function render()
    {
        $collections = StudentPayment::with(['student', 'fee'])->paginate($this->perPage);
        return view('livewire.backend.school.collection-update-management', ['collections' => $collections])->title('Update collection');
    }
}
