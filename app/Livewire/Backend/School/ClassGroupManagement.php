<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\classGroup;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Rules\CheckUniqueAsClassID;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassGroupManagement extends Component
{
    use LivewireAlert;
    public $openCEmodal = false;
    public $editable_item;
    public $group_name;
    public $class_id;
    #[Title('Class Sections')]
    public function rules()
    {
        return [
            'class_id' => 'required',
            'group_name' => 'required',
            // 'group_name' => ['required', new CheckUniqueAsClassID($this->class_id, 'school_classs', 'group_name')],
        ];
    }
    public function store()
    {
        $this->validate();
        $e = SchoolClass::findBySchool($this->class_id);
        $e->groups()->create([
            'group_name' => $this->group_name,
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Group created.');
    }
    public function edit(classGroup $classGroup)
    {
        abort_action(school()->user_id);
        $this->editable_item = $classGroup;
        $this->group_name = $classGroup->group_name;
        $this->class_id = $classGroup->school_class_id;
        // dd($this->editable_item);
    }
    // public function update()
    // {
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
        $this->openCEmodal = false;
        $this->dispatch('closeModal');
    }
    public function render()
    {
        $groups = classGroup::allGroups();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.class-group-management')->with([
            'groups' => $groups,
            'classes' => $classes,
        ]);
    }
}
