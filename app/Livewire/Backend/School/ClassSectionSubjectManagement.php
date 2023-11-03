<?php

namespace App\Livewire\Backend\School;

use App\Models\SchoolClass;
use App\Models\SchoolClassSection;
use App\Models\SchoolClassSubject;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class ClassSectionSubjectManagement extends Component
{
    use LivewireAlert;
    #[Title('Section subjects')]
    public $editable_item;
    public $sections = [];
    public $subject_name;
    public $class_id;
    public $section_id;
    public $openCEmodal = false;
    public function getSection()
    {
        if (null != $this->class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->where('school_id', school()->id)->get();
        }
    }
    public function store()
    {
        $this->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_name' => 'required|min:1|max:50|unique:school_class_subjects'
        ]);
        SchoolClassSubject::create([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'subject_name' => $this->subject_name,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Subject created.');
    }
    public function edit(SchoolClassSubject $schoolClassSubject)
    {
        abort_action($schoolClassSubject->school->user_id);

        $this->editable_item = $schoolClassSubject;
        $this->class_id = $schoolClassSubject->school_class_id;
        $this->section_id = $schoolClassSubject->school_class_section_id;
        $this->subject_name = $schoolClassSubject->subject_name;
        $this->getSection();
    }
    public function update()
    {
        $this->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_name' => 'required|min:1|max:50|unique:school_class_subjects,subject_name,' . $this->editable_item->id,
        ]);
        $e = SchoolClassSubject::findBySchool($this->editable_item->id);
        $e->update([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'subject_name' => $this->subject_name,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Class subject updated');
        $this->resetFields();
    }
    public function destroy(SchoolClassSubject $schoolClassSubject)
    {
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
        $this->openCEmodal = false;
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
