<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassManagement extends Component
{
    use LivewireAlert;
    #[Title('Class Management')]
    public $editable_item;
    public $class_name;
    public $openCEmodal = false;
    public $classSelectedForShowData;
    public $glance = [
        'sections' => [],
        'groups' => [],
        'syllabi' => [],
    ];
    public function showInTab()
    {
        $this->glance['sections'] = school()->classes()->findOrFail($this->classSelectedForShowData)->classSections;
        $this->glance['groups'] = school()->classes()->findOrFail($this->classSelectedForShowData)->groups;
        $this->glance['syllabi'] = school()->classes()->findOrFail($this->classSelectedForShowData)->syllabuses;
    }
    public function store()
    {
        $this->validate(['class_name' => 'required|unique:school_classes,class_name']);
        SchoolClass::create([
            'class_name' => $this->class_name,
            'school_id' => school()->id,
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Class created');
        $this->resetFields();
    }
    public function edit(SchoolClass $schoolClass)
    {
        abort_action($schoolClass->school->user_id);
        $this->editable_item = $schoolClass;
        $this->class_name = $schoolClass->class_name;
    }
    public function update()
    {
        $this->validate(['class_name' => 'required|unique:school_classes,class_name,' . $this->editable_item->id]);
        $e = SchoolClass::findBySchool($this->editable_item->id);
        $e->update([
            'class_name' => $this->class_name,
            'school_id' => school()->id,
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Class updated');
        $this->resetFields();
    }
    public function destroy(SchoolClass $schoolClass)
    {
        abort_action($schoolClass->school->user_id);
        $schoolClass->delete();
        $this->alert('success', 'Class deleted');
        $this->resetFields();
    }
    public function downloadFile($f)
    {
        if (Storage::disk('public')->exists($f)) {
            return Storage::disk('public')->download($f);
        }
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->class_name = null;
        $this->openCEmodal = false;
    }
    public function render()
    {
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.class-management')->with(['classes' => $classes]);
    }
}
