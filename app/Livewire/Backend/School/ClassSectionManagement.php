<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use App\Rules\CheckUniqueAsClassID;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ClassSectionManagement extends Component
{
    use LivewireAlert;
    public $openCEmodal = false;
    public $showRoutine = false;
    public $editable_item;
    public $section_name;
    public $class_id;
    public $filter_class_id;
    public $filter_section_id;
    public $sections = [];
    public $routine_sets = [];
    public $routine_for = [];


    #[Title('Class Sections')]

    public function rules()
    {
        return [
            'class_id' => 'required',
            'section_name' => ['required', new CheckUniqueAsClassID($this->class_id, 'school_class_sections', 'section_name')],
        ];
    }
    public function getSection()
    {
        $this->sections = school()->classes()->findOrFail($this->filter_class_id)->classSections;
    }

    //Generate routine
    public function generateRoutine()
    {

        $e = school()->classes()->findOrFail($this->filter_class_id)->classSections()->findOrFail($this->filter_section_id);
        $this->routine_sets =  $e->routines;
        $e->update(['routine_published' => true]);
        $this->alert('success', 'Routine generated.');
    }
    public function store()
    {
        $this->validate();
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
        $this->validate();
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
        $this->dispatch('closeModal');
        $this->routine_sets = [];
        $this->routine_for = [];
    }
    public function showFullRoutine($id)
    {
        // Initialize an array to store routines
        $section = SchoolClassSection::findBySchool($id);
        $this->routine_for['class'] = $section->school_class->class_name;
        $this->routine_for['section'] = $section->section_name;
        foreach ($section->routines as $result) {
            $weekday = $result['weekday'];

            // Initialize the weekday group if not exists
            if (!isset($this->routine_sets[$weekday])) {
                $this->routine_sets[$weekday] = [];
            }

            // Add the result to the corresponding weekday group
            $this->routine_sets[$weekday][] = $result;
        }
    }
    public function render()
    {
        $e = school();
        $allSections = school()->sections;
        $classes = $e->classes;


        // Get sections with routine_published set to true
        $publishedRoutines = SchoolClassSection::where('routine_published', true)->get();
        return view('livewire.backend.school.class-section-management')->with([
            'allSections' => $allSections,
            'classes' => $classes,
            'publishedRoutines' => $publishedRoutines,
        ]);
    }
}
