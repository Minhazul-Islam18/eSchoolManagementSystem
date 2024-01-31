<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use App\Models\SchoolClassSubject;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassSectionSubjectManagement extends Component
{
    use LivewireAlert;
    #[Title('Section subjects')]
    public $editable_item;
    public $sections = [];
    public $groups = [];
    public $subject_name;
    public $class_id;
    public $section_id;
    public $group_id;
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
        Gate::authorize('school.subjects.create');
        $this->validate([
            'class_id' => 'required',
            'subject_name' => 'required|min:1|max:50'
        ]);
        SchoolClassSubject::create([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'class_group_id' => $this->group_id,
            'subject_name' => $this->subject_name,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Subject created.');
    }
    public function edit(SchoolClassSubject $schoolClassSubject)
    {
        Gate::authorize('school.subjects.update');
        abort_action($schoolClassSubject->school->user_id);

        $this->editable_item = $schoolClassSubject;
        $this->class_id = $schoolClassSubject->school_class_id;
        $this->section_id = $schoolClassSubject->school_class_section_id;
        $this->group_id = $schoolClassSubject->class_group_id;
        $this->groups = $schoolClassSubject->groups;
        $this->subject_name = $schoolClassSubject->subject_name;
        $this->getSection();
    }
    public function update()
    {
        Gate::authorize('school.subjects.update');
        $this->validate([
            'class_id' => 'required',
            'subject_name' => 'required|min:1|max:50',
        ]);
        $e = SchoolClassSubject::findBySchool($this->editable_item->id);
        $e->update([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'class_group_id' => $this->group_id,
            'subject_name' => $this->subject_name,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Class subject updated');
        $this->resetFields();
    }
    public function destroy(SchoolClassSubject $schoolClassSubject)
    {
        Gate::authorize('school.subjects.destroy');
        abort_action($schoolClassSubject->school->user_id);
        $schoolClassSubject->delete();
        $this->alert('success', 'Class subject deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->subject_name = null;
        $this->class_id = null;
        $this->group_id = null;
        $this->section_id = null;
        $this->openCEmodal = false;
        $this->sections = [];
        $this->groups = [];
    }
    public function mount()
    {
        Gate::authorize('school.subjects.index');
    }
    public function render()
    {
        $subjects = SchoolClassSubject::allSubjects();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.class-section-subject-management')->with([
            'subjects' => $subjects,
            'classes' => $classes,
        ]);
    }
}
