<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FeeCollectionManagement extends Component
{
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $group_id;
    public $editable_item;
    public $sections = [];
    public $groups = [];
    public $fees = [];
    public $students = [];
    public $ids = [];
    public $fee_id;
    public bool $attendanceSheat = false;

    #[Computed()]
    public function classes()
    {
        return school()->classes;
    }
    public function getCollectionSheet()
    {
        $this->validate([
            'class_id' => 'required'
        ]);

        // Make attendance sheat visible
        $this->attendanceSheat = true;

        //Get filtered students for attendance
        if (isset($this->class_id) && isset($this->section_id)) {
            $this->students = school()->classes()->findOrFail($this->class_id)->classSections()->findOrFail($this->section_id)->students;
        } elseif (isset($this->class_id) && isset($this->group_id)) {
            $this->students = school()->classes()->findOrFail($this->class_id)->groups()->findOrFail($this->group_id)->students;
        }
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

    public function getFees()
    {
        if (null != $this->class_id && $this->section_id) {
            $this->fees = school()->classes()->findOrFail($this->class_id)->classSections()->findOrFail($this->section_id)->fees;
        } elseif (null != $this->class_id && $this->group_id) {
            $this->fees = school()->classes()->findOrFail($this->class_id)->groups()->findOrFail($this->group_id)->fees;
        }
    }

    public function mount()
    {
        // Gate::authorize('school.fee-collection.index');
    }
    public function render()
    {
        dd(school()->classes()->findOrFail(1)->classSections()->findOrFail(1)->students()->find(15)->fees);
        return view('livewire.backend.school.fee-collection-management');
    }
}
