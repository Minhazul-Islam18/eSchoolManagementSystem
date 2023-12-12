<?php

namespace App\Livewire\Backend\School;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SchoolFee;
use App\Models\SchoolExam;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ExamManagement extends Component
{
    use LivewireAlert;
    #[Title('Exam management')]
    public $editable_item;
    public $class_id;
    public $group_id;
    public $section_id;
    public $sections = [];
    public $groups = [];
    public $exam_name;
    public $exam_date;
    public $openCEmodal = false;

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
        Gate::authorize('school.exams.create');
        $this->validate([
            'class_id' => 'required',
            'exam_date' => 'required',
            'exam_name' => 'required|min:1|max:50'
        ]);
        SchoolExam::create([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'group_id' => $this->group_id,
            'exam_name' => $this->exam_name,
            'exam_date' => $this->exam_date,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Class exam created.');
    }

    public function edit(SchoolExam $schoolExam)
    {
        Gate::authorize('school.exams.update');
        abort_action($schoolExam->school->user_id);

        $this->editable_item = $schoolExam;
        $this->class_id = $schoolExam->school_class_id;
        $this->section_id = $schoolExam->school_class_section_id;
        $this->group_id = $schoolExam->group_id;
        $this->exam_name = $schoolExam->exam_name;
        $this->exam_date = Carbon::parse($schoolExam->exam_date)->format('Y-m-d');
        $this->getSection();
    }
    public function update()
    {
        Gate::authorize('school.exams.update');
        $this->validate([
            'class_id' => 'required',
            'exam_date' => 'required',
            'exam_name' => 'required|min:1|max:50',
        ]);
        $e = SchoolExam::findBySchool($this->editable_item->id);
        $e->update([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'group_id' => $this->group_id,
            'exam_name' => $this->exam_name,
            'exam_date' => $this->exam_date,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Class subject updated');
        $this->resetFields();
    }
    public function destroy(SchoolExam $schoolExam)
    {
        Gate::authorize('school.exams.destroy');
        abort_action($schoolExam->school->user_id);
        $schoolExam->delete();
        $this->alert('success', 'Class exam deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->exam_date = null;
        $this->exam_name = null;
        $this->class_id = null;
        $this->group_id = null;
        $this->sections = [];
        $this->groups = [];
        $this->openCEmodal = false;
    }
    public function mount()
    {
        Gate::authorize('school.exams.index');
    }
    public function render()
    {
        $exams = SchoolExam::allExams();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.exam-management')->with(['exams' => $exams, 'classes' => $classes]);
    }
}
