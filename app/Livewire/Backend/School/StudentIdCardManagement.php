<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;

class StudentIdCardManagement extends Component
{
    use WithFileUploads;
    public $photo;
    public $class_id;
    public $section_id;
    public $group_id;
    public $student_id;
    public $editable_item;
    public $classes;
    public $groups = [];
    public $sections = [];
    public $students = [];

    public $card = [
        'class' => [],
        'section' => [],
        'group' => [],
        'student' => [],
    ];


    #[Title('Generate student ID card')]

    public function getSection()
    {
        if ($this->editable_item == null) {
            $this->section_id = null;
            $this->group_id = null;
        }

        if ($this->class_id != null) {
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
    public function getStudents()
    {
        if (isset($this->section_id) && $this->sections !== null) {
            $this->students = $this->sections->firstWhere('id', $this->section_id)->students;
        }

        if (isset($this->group_id) && $this->groups !== null) {
            $this->students = $this->groups->firstWhere('id', $this->group_id)->students;
        }
    }

    public function setIDcard()
    {
        while (
            $this->student_id !== "" && isset($this->class_id) && (isset($this->section_id) || isset($this->group_id))
        ) {
            $this->card['class'] = $this->classes->firstWhere('id', $this->class_id);
            $this->card['section'] = $this->sections->firstWhere('id', $this->section_id);
            $this->card['group'] = $this->groups->firstWhere('id', $this->group_id);
            $this->card['student'] = $this->students->firstWhere('id', $this->student_id);
            $this->card['student']['division'] = Division::findOrFail($this->card['student']->division)->name;
            $this->card['student']['district'] = District::findOrFail($this->card['student']->zilla)->name;
            $this->card['student']['upazila'] = Upazila::findOrFail($this->card['student']->upazilla_or_thana)->name;
            $this->card['student']['union'] = Union::findOrFail($this->card['student']->union)->name;

            break;
        };
    }

    public function render()
    {
        $this->classes = school()->classes;
        return view(
            'livewire.backend.school.student-id-card-management',
            // ['classes' => $classes]
        );
    }
}
