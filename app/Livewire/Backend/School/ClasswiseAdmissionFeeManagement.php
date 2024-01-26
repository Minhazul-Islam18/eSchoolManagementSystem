<?php

namespace App\Livewire\Backend\School;

use App\Models\ClassWiseAdmissionFee;
use App\Models\SchoolClass;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClasswiseAdmissionFeeManagement extends Component
{
    use LivewireAlert;
    public bool $openCEmodal = false;
    public $editable_item;
    public $class_id;
    public int $amount;

    public function edit(SchoolClass $schoolClass)
    {
        isset($schoolClass->admission_fee) ? abort_action($schoolClass->school->user_id) : '';
        $this->editable_item = $schoolClass;
    }

    public function update()
    {
        isset($this->editable_item->admission_fee) ? abort_action($this->editable_item->school->user_id) : '';
        if ($this->editable_item && $this->editable_item->admission_fee) {
            $this->editable_item->admission_fee->update([
                'amount' => $this->amount,
            ]);
        } else {
            $class = school()->classes()->find($this->editable_item->id);

            if ($class) {
                $class->admission_fee()->create([
                    'school_id' => school()->id,
                    'amount' => $this->amount,
                ]);
            }
        }

        $this->alert('success', 'Admission fee updated');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->openCEmodal = false;
        $this->editable_item = null;
        $this->class_id = null;
        $this->amount = 0;
    }

    #[Computed()]
    public function classes()
    {
        return school()->classes()->with(['admission_fee'])->get();
    }
    public function render()
    {
        return view('livewire.backend.school.classwise-admission-fee-management');
    }
}
