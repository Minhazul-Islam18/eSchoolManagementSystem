<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\ClassRoutine;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use App\Models\SchoolClassSubject;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassRoutineManagement extends Component
{
    use LivewireAlert;
    #[Title('Class routines')]
    public $editable_item,
        $class_id,
        $section_id,
        $group_id,
        $subject_id,
        $weekday,
        $starts_at,
        $ends_at,
        $openCEmodal = false,
        $sections = [],
        $subjects = [];
    public $groups = [];

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
        Gate::authorize('school.routines.create');
        $e = school()->classes()->findOrFail($this->class_id);
        if ($this->section_id) {
            $insertable =  $e->classSections()->findOrFail($this->section_id);
        } elseif ($this->group_id) {
            $insertable =  $e->groups()->findOrFail($this->group_id);
        }

        $insertable->routines()->create([
            'school_id' => school()->id,
            'class_id' => $this->class_id,
            'subject_id' => $this->subject_id,
            'group_id' => $this->group_id,
            'weekday' => $this->weekday,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
        ]);
        $this->alert('success', 'Routine created');
        $this->resetFields();
    }


    public function getSubject()
    {
        if ($this->section_id !== null) {
            $this->subjects = school()->classes()->findOrFail($this->class_id)->classSections()->findOrFail($this->section_id)->subjects;
        } elseif ($this->group_id !== null) {
            $this->subjects = school()->classes()->findOrFail($this->class_id)->groups()->findOrFail($this->group_id)->subjects;
        }
    }

    public function edit(ClassRoutine $classRoutine)
    {
        Gate::authorize('school.routines.update');
        abort_action($classRoutine->school->user_id);

        $this->editable_item = $classRoutine;
        $this->class_id = $classRoutine->class_id;
        $this->section_id = $classRoutine->section_id;
        $this->subject_id = $classRoutine->subject_id;
        $this->group_id = $classRoutine->group_id;
        $this->getSection();
        $this->weekday = $classRoutine->weekday;
        $this->starts_at = $classRoutine->starts_at;
        $this->ends_at = $classRoutine->ends_at;
    }

    public function update()
    {
        Gate::authorize('school.routines.update');
        abort_action($this->editable_item->school->user_id);

        $this->editable_item->update([
            'school_id' => school()->id,
            'class_id' => $this->class_id,
            'section_id' => $this->section_id,
            'group_id' => $this->group_id,
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
        Gate::authorize('school.routines.destroy');
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
        $this->group_id = null;
        $this->weekday = null;
        $this->starts_at = null;
        $this->ends_at = null;
        $this->openCEmodal = false;
        $this->sections = [];
        $this->subjects = [];
        $this->groups = [];
    }

    public function mount()
    {
        Gate::authorize('school.routines.index');
    }

    public function render()
    {
        $allRoutine = ClassRoutine::allRoutine();
        $classes = school()->classes;
        return view('livewire.backend.school.class-routine-management', ['allRoutine' => $allRoutine, 'classes' => $classes]);
    }
}
