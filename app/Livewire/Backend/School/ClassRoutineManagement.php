<?php

namespace App\Livewire\Backend\School;

use App\Models\ClassRoutine;
use Livewire\Component;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassRoutineManagement extends Component
{
    use LivewireAlert;
    #[Title('Class routines')]
    public $editable_item, $class_id, $section_id, $weekday, $starts_at, $ends_at, $openCEmodal = false;
    public function store()
    {
        school()->classes()->findOrFail($this->class_id)->sections()->findOrFail($this->section_id)->routines()->create([
            'school_id' => school()->id,
            'weekday' => $this->weekday,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->weekends_atday,
        ]);
        $this->alert('success', 'Syllabus created');
        $this->resetFields();
    }

    // public function edit(ClassRoutine $classRoutine)
    // {
    //     abort_action($classRoutine->school->user_id);

    //     $this->editable_item = $classRoutine;
    //     $this->class_id = $classRoutine->class_id;
    //     $this->syllabus_name = $classRoutine->syllabus_name;
    // }

    // public function update()
    // {
    //     abort_action($this->editable_item->school->user_id);

    //     $fs = [];
    //     if (null !== $this->files) {
    //         Storage::disk('public')->delete(json_decode($this->editable_item->files));
    //         foreach ($this->files as $file) {
    //             $name = $file->hashName();
    //             $fs[] = $file->storeAs(school()->id . '/syllabus', $name, 'public');
    //         }
    //     } else {
    //         $fs = json_decode($this->editable_item->files);
    //     }


    //     $this->editable_item->update([
    //         'school_id' => school()->id,
    //         'syllabus_name' => $this->syllabus_name,
    //         'files' => json_encode($fs),
    //     ]);
    //     $this->resetFields();
    //     $this->alert('success', 'Syllabus updated');
    // }

    // public function destroy(ClassRoutine $classRoutine)
    // {
    //     abort_action($classSyllabus->school->user_id);
    //     if (null != $classSyllabus->files) {
    //         Storage::disk('public')->delete(json_decode($classSyllabus->files));
    //     }
    //     $classSyllabus->delete();
    //     $this->alert('success', 'Class syllabus deleted');
    //     $this->resetFields();
    // }

    public function resetFields()
    {
        $this->editable_item = null;
        $this->class_id = null;
        $this->syllabus_name = null;
        $this->files = [];
        $this->openCEmodal = false;
    }
    public function render()
    {
        return view('livewire.backend.school.class-routine-management');
    }
}
