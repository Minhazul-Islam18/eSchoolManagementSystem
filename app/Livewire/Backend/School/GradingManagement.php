<?php

namespace App\Livewire\Backend\School;

use App\Models\Grade;
use Livewire\Component;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use App\Rules\CheckUniqueAsClassID;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GradingManagement extends Component
{
    use LivewireAlert;
    #[Title('Grade management')]
    public $openCEmodal = false,
        $editable_item,
        $sections = [],
        $groups = [],
        $class_id,
        $section_id,
        $group_id,
        $grade_name;
    public function rules()
    {
        return [
            'grade_name' => ['required', new CheckUniqueAsClassID($this->section_id, 'grades', 'grade_name', $this->editable_item->id ?? null)],
        ];
    }

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
        Gate::authorize('school.gradings.create');
        $this->validate();
        Grade::create([
            'school_id' => school()->id,
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'group_id' => $this->group_id,
            'grade_name' => $this->grade_name,
        ]);
        $this->alert('success', 'Grade created.');
        $this->resetFields();
    }

    public function edit(Grade $grade)
    {
        Gate::authorize('school.gradings.update');
        $this->editable_item = $grade;
        $this->class_id = $grade->school_class_id;
        $this->section_id = $grade->school_class_section_id;
        $this->group_id = $grade->group_id;
        $this->grade_name = $grade->grade_name;
    }

    public function update()
    {
        Gate::authorize('school.gradings.update');
        $this->validate();
        $this->editable_item->update([
            'school_id' => school()->id,
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'group_id' => $this->group_id,
            'grade_name' => $this->grade_name,
        ]);
        $this->alert('success', 'Grade updated.');
        $this->resetFields();
    }

    public function destroy(Grade $grade)
    {
        Gate::authorize('school.gradings.destroy');
        $grade->delete();
        $this->alert('success', 'Deleted successfully.');
    }

    public function resetFields()
    {
        $this->editable_item = null;
        $this->class_id = null;
        $this->section_id = null;
        $this->group_id = null;
        $this->grade_name = null;
        $this->openCEmodal = false;
        $this->sections = [];
        $this->groups = [];
    }
    public function mount()
    {
        Gate::authorize('school.gradings.index');
    }
    public function render()
    {
        $classes = SchoolClass::allClasses();
        $grades = Grade::allGrades();
        return view('livewire.backend.school.grading-management', ['classes' => $classes, 'grades' => $grades]);
    }
}
