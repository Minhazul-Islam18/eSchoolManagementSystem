<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolExamResult;
use App\Models\SchoolClassSection;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ExamResultManagement extends Component
{
    use LivewireAlert;
    #[Title('Exam result management incomplete')]
    public $editable_item;
    public $class_id;
    public $section_id;
    public $sections = [];
    public $fee_name;
    public $amount;
    public $openCEmodal = false;
    public function getSection()
    {
        if (null != $this->class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->where('school_id', school()->id)->get();
        }
    }
    public function getStudents()
    {
        if (null != $this->class_id && null != $this->section_id) {
            $this->sections = Student::where('school_id', $this->class_id)->where('school_id', school()->id)->get();
        }
    }
    public function store()
    {
        $this->validate([
            'class_id' => 'required',
            'amount' => 'required',
            'section_id' => 'required',
            'fee_name' => 'required|min:1|max:50|unique:school_fees'
        ]);
        SchoolExamResult::create([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'fee_name' => $this->fee_name,
            'amount' => $this->amount,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Exam fee created.');
    }
    public function edit(SchoolExamResult $schoolExamResult)
    {
        abort_action($schoolExamResult->school->user_id);

        $this->editable_item = $schoolExamResult;
        $this->class_id = $schoolExamResult->school_class_id;
        $this->section_id = $schoolExamResult->school_class_section_id;
        $this->fee_name = $schoolExamResult->fee_name;
        $this->amount = $schoolExamResult->amount;
        $this->getSection();
    }
    public function update()
    {
        $this->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'amount' => 'required',
            'fee_name' => 'required|min:1|max:50|unique:school_fees,fee_name,' . $this->editable_item->id,
        ]);
        $e = SchoolExamResult::findBySchool($this->editable_item->id);
        $e->update([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'fee_name' => $this->fee_name,
            'amount' => $this->amount,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Exam fee updated');
        $this->resetFields();
    }
    public function destroy(SchoolExamResult $schoolExamResult)
    {
        abort_action($schoolExamResult->school->user_id);
        $schoolExamResult->delete();
        $this->alert('success', 'Exam result deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->amount = null;
        $this->fee_name = null;
        $this->class_id = null;
        $this->openCEmodal = false;
    }
    public function render()
    {
        $results = SchoolExamResult::allResults();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.exam-result-management')->with([
            'results' => $results,
            'classes' => $classes,
        ]);
    }
}
