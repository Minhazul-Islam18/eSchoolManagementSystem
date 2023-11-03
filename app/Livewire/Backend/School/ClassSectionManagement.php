<?php

namespace App\Livewire\Backend\School;

use App\Models\SchoolClass;
use App\Models\SchoolClassSection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class ClassSectionManagement extends Component
{
    use LivewireAlert;
    public $openCEmodal = false;
    public $editable_item;
    public $section_name;
    public $class_id;
    #[Title('Class Sections')]
    public function store()
    {
        $this->validate([
            'class_id' => 'required',
            'section_name' => 'required|min:1|max:50|unique:school_class_sections'
        ]);
        SchoolClassSection::create([
            'school_class_id' => $this->class_id,
            'section_name' => $this->section_name,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->resetFields();
        $this->alert('success', 'Section created.');
    }
    public function edit(SchoolClassSection $schoolClassSection)
    {
        abort_action($schoolClassSection->school->user_id);
        $this->editable_item = $schoolClassSection;
        $this->class_id = $schoolClassSection->school_class_id;
        $this->section_name = $schoolClassSection->section_name;
    }
    public function update()
    {
        $this->validate([
            'class_id' => 'required',
            'section_name' => 'required|min:1|max:50|unique:school_class_sections,section_name,' . $this->editable_item->id,
        ]);
        $e = SchoolClassSection::findBySchool($this->editable_item->id);
        $e->update([
            'school_class_id' => $this->class_id,
            'section_name' => $this->section_name,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Class Section updated');
        $this->resetFields();
    }
    public function destroy(SchoolClassSection $schoolClassSection)
    {
        abort_action($schoolClassSection->school->user_id);
        $schoolClassSection->delete();
        $this->alert('success', 'Class section deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->section_name = null;
        $this->class_id = null;
        $this->openCEmodal = false;
    }
    public function render()
    {
        $sections = SchoolClassSection::allSections();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.class-section-management')->with([
            'sections' => $sections,
            'classes' => $classes,
        ]);
    }
}
