<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use App\Models\ClassSyllabus;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassSyllabusManagement extends Component
{
    use WithFileUploads, LivewireAlert;
    #[Title('Class syllabuses')]
    public $editable_item, $class_id, $syllabus_name, $files = [], $openCEmodal = false;
    public function store()
    {
        $fs = [];
        foreach ($this->files as $file) {
            $name = $file->hashName();
            $fs[] = $file->storeAs(school()->id . '/syllabus', $name, 'public');
        }
        school()->classes()->findOrFail($this->class_id)->syllabuses()->create([
            'school_id' => school()->id,
            'syllabus_name' => $this->syllabus_name,
            'files' => json_encode($fs),
        ]);
        $this->alert('success', 'Syllabus created');
        $this->resetFields();
    }

    public function edit(ClassSyllabus $classSyllabus)
    {
        abort_action($classSyllabus->school->user_id);

        $this->editable_item = $classSyllabus;
        $this->class_id = $classSyllabus->class_id;
        $this->syllabus_name = $classSyllabus->syllabus_name;
    }

    public function update()
    {
        abort_action($this->editable_item->school->user_id);

        $fs = [];
        if (null !== $this->files) {
            Storage::disk('public')->delete(json_decode($this->editable_item->files));
            foreach ($this->files as $file) {
                $name = $file->hashName();
                $fs[] = $file->storeAs(school()->id . '/syllabus', $name, 'public');
            }
        } else {
            $fs = json_decode($this->editable_item->files);
        }


        $this->editable_item->update([
            'school_id' => school()->id,
            'syllabus_name' => $this->syllabus_name,
            'files' => json_encode($fs),
        ]);
        $this->resetFields();
        $this->alert('success', 'Syllabus updated');
    }

    public function destroy(ClassSyllabus $classSyllabus)
    {
        abort_action($classSyllabus->school->user_id);
        // dd(json_decode($classSyllabus->files));
        if (null != $classSyllabus->files) {
            Storage::disk('public')->delete(json_decode($classSyllabus->files));
        }
        $classSyllabus->delete();
        $this->alert('success', 'Class syllabus deleted');
        $this->resetFields();
    }

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
        $classes = SchoolClass::allClasses();
        $syllabi = ClassSyllabus::allSyllabus();
        return view('livewire.backend.school.class-syllabus-management', ['classes' => $classes, 'syllabi' => $syllabi]);
    }
}
