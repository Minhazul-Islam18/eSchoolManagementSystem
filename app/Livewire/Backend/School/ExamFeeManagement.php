<?php

namespace App\Livewire\Backend\School;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SchoolFee;
use App\Models\SchoolExam;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use App\Models\SchoolFeeCategory;
use App\Rules\CheckUniqueAsClassID;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ExamFeeManagement extends Component
{
    use LivewireAlert;
    #[Title('Fee management')]
    public $editable_item;
    public $class_id;
    public $section_id;
    public $group_id;
    public $category_id;
    public $sections = [];
    public $groups = [];
    public $fee_name;
    public $amount;
    public $openCEmodal = false;
    public function rules()
    {
        return [
            'fee_name' => ['required', new CheckUniqueAsClassID($this->class_id, 'school_fees', 'fee_name', $this->editable_item->id ?? null)],
        ];
    }
    // public function getSection()
    // {
    //     if (null != $this->class_id) {
    //         $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->where('school_id', school()->id)->get();
    //     }
    // }

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


    public function store()
    {
        $this->validate();
        $this->validate([
            'class_id' => 'required',
            'amount' => 'required',
            'category_id' => 'required',
            'fee_name' => 'required|min:1|max:50'
        ]);
        school()->fees()->create([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'school_fee_category_id' => $this->category_id,
            'group_id' => $this->group_id,
            'fee_name' => $this->fee_name,
            'amount' => $this->amount,
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Exam fee created.');
    }
    public function edit(SchoolFee $schoolFee)
    {
        abort_action($schoolFee->school->user_id);

        $this->editable_item = $schoolFee;
        $this->class_id = $schoolFee->school_class_id;
        $this->section_id =  $schoolFee->school_class_section_id;
        $this->category_id = $schoolFee->school_fee_category_id;
        $this->group_id = $schoolFee->group_id;
        $this->fee_name = $schoolFee->fee_name;
        $this->amount = $schoolFee->amount;
        $this->getSection();
    }
    public function update()
    {
        $this->validate();
        $this->validate([
            'class_id' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'fee_name' => 'required|min:1|max:50',
        ]);
        $this->editable_item->update([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'group_id' => $this->group_id,
            'school_fee_category_id' => $this->category_id,
            'fee_name' => $this->fee_name,
            'amount' => $this->amount,
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Exam fee updated');
        $this->resetFields();
    }
    public function destroy(SchoolFee $schoolFee)
    {
        abort_action($schoolFee->school->user_id);
        $schoolFee->delete();
        $this->alert('success', 'Exam fee deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->amount = null;
        $this->fee_name = null;
        $this->class_id = null;
        $this->category_id = null;
        $this->openCEmodal = false;
        $this->sections = [];
        $this->groups = [];
    }
    public function render()
    {
        $categories = SchoolFeeCategory::allCategories();
        $fees = SchoolFee::allFees();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.exam-fee-management')->with([
            'categories' => $categories,
            'fees' => $fees,
            'classes' => $classes,
        ]);
    }
}
