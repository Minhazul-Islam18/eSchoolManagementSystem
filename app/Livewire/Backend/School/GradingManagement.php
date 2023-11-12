<?php

namespace App\Livewire\Backend\School;

use App\Models\Grade;
use Livewire\Component;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use App\Rules\CheckUniqueAsClassID;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GradingManagement extends Component
{
    use LivewireAlert;
    #[Title('Grade management')]
    public $openCEmodal = false, $editable_item, $sections = [], $class_id, $section_id, $grade_name;
    public function rules()
    {
        return [
            'grade_name' => ['required', new CheckUniqueAsClassID($this->section_id, 'grades', 'grade_name', $this->editable_item->id ?? null)],
        ];
    }
    public function getSection()
    {
        if (null != $this->class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->where('school_id', school()->id)->get();
        }
    }
    public function store()
    {
        $this->validate();
        Grade::create([
            'school_id' => school()->id,
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'grade_name' => $this->grade_name,
        ]);
        $this->alert('success', 'Grade created.');
    }
    public function render()
    {
        $classes = SchoolClass::allClasses();
        $grades = Grade::allGrades();
        return view('livewire.backend.school.grading-management', ['classes' => $classes, 'grades' => $grades]);
    }
}
