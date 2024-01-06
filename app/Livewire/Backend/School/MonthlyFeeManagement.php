<?php

namespace App\Livewire\Backend\School;

use App\Models\SchoolClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;

class MonthlyFeeManagement extends Component
{
    use LivewireAlert;
    public bool $openCEmodal = false;
    public $editable_item;
    public $class_id;
    public int $amount;

    public function edit(SchoolClass $schoolClass)
    {
        abort_action($schoolClass->school->user_id);
        $this->editable_item = $schoolClass;
    }

    public function update()
    {
        abort_action($this->editable_item->school->user_id);
        if ($this->editable_item && $this->editable_item->monthly_fee) {
            $this->editable_item->monthly_fee->update([
                'amount' => $this->amount,
            ]);
        } else {
            $class = school()->classes()->find($this->editable_item->id);

            if ($class) {
                $class->monthly_fee()->create([
                    'school_id' => school()->id,
                    'amount' => $this->amount,
                ]);
            }
        }

        $this->alert('success', 'Monthly fee updated');
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
        return school()->classes;
    }
    public function render()
    {
        return view('livewire.backend.school.monthly-fee-management');
    }
}
