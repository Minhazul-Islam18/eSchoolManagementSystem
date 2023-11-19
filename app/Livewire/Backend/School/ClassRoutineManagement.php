<?php

namespace App\Livewire\Backend\School;

use App\Models\ClassRoutine;
use App\Models\SchoolClassSection;
use App\Models\SchoolClassSubject;
use Livewire\Component;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassRoutineManagement extends Component
{
    use LivewireAlert;
    #[Title('Class routines')]
    public $editable_item,
        $class_id,
        $section_id,
        $subject_id,
        $weekday,
        $starts_at,
        $ends_at,
        $openCEmodal = false,
        $sections = [],
        $subjects = [];
    public function store()
    {
        school()->classes()->findOrFail($this->class_id)->classSections()->findOrFail($this->section_id)->routines()->create([
            'school_id' => school()->id,
            'class_id' => $this->class_id,
            'subject_id' => $this->subject_id,
            'weekday' => $this->weekday,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
        ]);
        $this->alert('success', 'Routine created');
        // $this->resetFields();
    }

    public function getSection()
    {
        $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->get();
        $this->getSubject();
    }

    public function getSubject()
    {
        $this->subjects = SchoolClassSubject::where('school_class_id', $this->class_id)->get();
    }

    public function edit(ClassRoutine $classRoutine)
    {
        abort_action($classRoutine->school->user_id);

        $this->editable_item = $classRoutine;
        $this->class_id = $classRoutine->class_id;
        $this->section_id = $classRoutine->section_id;
        $this->subject_id = $classRoutine->subject_id;
        $this->getSection();
        $this->weekday = $classRoutine->weekday;
        $this->starts_at = $classRoutine->starts_at;
        $this->ends_at = $classRoutine->ends_at;
    }

    public function update()
    {
        abort_action($this->editable_item->school->user_id);

        $this->editable_item->update([
            'school_id' => school()->id,
            'class_id' => $this->class_id,
            'section_id' => $this->section_id,
            'subject_id' => $this->subject_id,
            'weekday' => $this->weekday,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
        ]);
        $this->resetFields();
        $this->alert('success', 'Syllabus updated');
    }

    public function destroy(ClassRoutine $classRoutine)
    {
        abort_action($classRoutine->school->user_id);

        $classRoutine->delete();
        $this->alert('success', 'Class routine deleted');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->editable_item = null;
        $this->class_id = null;
        $this->section_id = null;
        $this->subject_id = null;
        $this->weekday = null;
        $this->starts_at = null;
        $this->ends_at = null;
        $this->openCEmodal = false;
        $this->sections = [];
        $this->subjects = [];
    }


    public function render()
    {
        $allRoutine = ClassRoutine::allRoutine();
        $classes = school()->classes;
        return view('livewire.backend.school.class-routine-management', ['allRoutine' => $allRoutine, 'classes' => $classes]);
    }
}
