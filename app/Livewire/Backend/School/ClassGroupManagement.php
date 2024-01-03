<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\classGroup;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Rules\CheckUniqueAsClassID;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassGroupManagement extends Component
{
    use LivewireAlert;
    public $showRoutine = false;
    public $openCEmodal = false;
    public $editable_item;
    public $group_name;
    public $class_id;
    public $filter_class_id;
    public $filter_group_id;
    public $routine_for;
    public $routine_sets = [];
    public $allClassesWithGroups = [];
    public $groups = [];
    #[Title('Class Sections')]
    public function rules()
    {
        return [
            'class_id' => 'required',
            'group_name' => 'required',
        ];
    }

    public function getGroup()
    {
        $this->groups = school()->classes()->findOrFail($this->filter_class_id)->groups;
    }

    public function store()
    {
        Gate::authorize('school.groups.create');
        $this->validate();
        $e = SchoolClass::findBySchool($this->class_id);
        $e->groups()->create([
            'school_id' => school()->id,
            'group_name' => $this->group_name,
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Group created.');
    }
    public function edit(classGroup $classGroup)
    {
        Gate::authorize('school.groups.update');
        abort_action(school()->user_id);
        $this->editable_item = $classGroup;
        $this->group_name = $classGroup->group_name;
        $this->class_id = $classGroup->school_class_id;
    }
    // public function update()
    // {
    // Gate::authorize('school.groups.update');
    //     $this->validate();
    //     $e = classGroup::findBySchool($this->editable_item->id);
    //     $e->update([
    //         'school_class_id' => $this->class_id,
    //         'group_name' => $this->group_name,
    //         'school_id' => school()->id
    //     ]);
    //     $this->dispatch('closeModal');
    //     $this->alert('success', 'Class Section updated');
    //     $this->resetFields();
    // }
    public function destroy(classGroup $classGroup)
    {
        Gate::authorize('school.groups.destroy');
        abort_action(school()->user_id);
        $classGroup->delete();
        $this->alert('success', 'Class group deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->group_name = null;
        $this->class_id = null;
        $this->filter_class_id = null;
        $this->filter_group_id = null;
        $this->routine_for = null;
        $this->routine_sets = [];
        $this->groups = [];
        $this->openCEmodal = false;
        $this->dispatch('closeModal');
    }


    //Generate routine
    public function generateRoutine()
    {
        $e = school()->classes()->findOrFail($this->filter_class_id)->groups()->findOrFail($this->filter_group_id);
        $this->routine_sets =  $e->routines;
        $e->update(['routine_published' => true]);
        $this->alert('success', 'Routine generated.');
    }

    //Show routine
    public function showFullRoutine($id)
    {
        // Initialize an array to store routines
        $group = classGroup::findBySchool($id);
        $this->routine_for['class'] = $group->class->class_name;
        $this->routine_for['group'] = $group->group_name;
        foreach ($group->routines as $result) {
            $weekday = $result['weekday'];

            // Initialize the weekday group if not exists
            if (!isset($this->routine_sets[$weekday])) {
                $this->routine_sets[$weekday] = [];
            }

            // Add the result to the corresponding weekday group
            $this->routine_sets[$weekday][] = $result;
        }
    }

    public function mount()
    {
        Gate::authorize('school.groups.index');
    }

    public function render()
    {
        $this->allClassesWithGroups = classGroup::allGroups();
        $classes = SchoolClass::allClasses();
        // Get sections with routine_published set to true
        $publishedRoutines = classGroup::where('routine_published', true)->get();
        return view('livewire.backend.school.class-group-management')->with([
            'classes' => $classes,
            'publishedRoutines' => $publishedRoutines,
        ]);
    }
}
