<?php

namespace App\Livewire\Backend\School;

// use PDF;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\URL;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;

class StudentIdCardManagement extends Component
{
    use WithFileUploads;
    // public $photo;
    public $class_id;
    public $section_id;
    public $group_id;
    public $student_id;
    public $editable_item;
    public $classes;
    public $groups = [];
    public $sections = [];
    public $students = [];
    public $student_division_name;
    public $student_district_name;
    public $student_upazila_name;
    public $student_union_name;

    public $card = [
        'class' => [],
        'section' => [],
        'group' => [],
        'student' => [],
    ];


    #[Title('Generate student ID card')]

    public function loadPdf()
    {
        ini_set('max_execution_time', 300); // Set the maximum execution time to 300 seconds (adjust as needed)

        $pdf = Pdf::loadView(
            'livewire.backend.school.id-card-preview',
            ['card' => $this->card, 'path' => config('app.url'), 'student_upazila_name' => $this->student_upazila_name, 'student_district_name' => $this->student_district_name]
        );

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'name.pdf');

        // $pdf =  PDF::loadView('livewire.back''end.school.id-card-preview', ['card' => $this->card]);
        // return $pdf->stream('document.pdf');
    }
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
            $this->card['section'] = $this->sections ? $this->sections->firstWhere('id', $this->section_id) : null;
            $this->card['group'] = $this->groups ? $this->groups->firstWhere('id', $this->group_id) : null;
            $this->card['student'] = $this->students->firstWhere('id', $this->student_id);
            $this->student_division_name = Division::findOrFail($this->card['student']->division)->name;
            $this->student_district_name = District::findOrFail($this->card['student']->zilla)->name;
            $this->student_upazila_name = Upazila::findOrFail($this->card['student']->upazilla_or_thana)->name;
            $this->student_union_name = Union::findOrFail($this->card['student']->union)->name;

            // dd($this->card['student']);
            break;
        };
    }

    public function render()
    {
        $this->classes = school()->classes;
        return view('livewire.backend.school.student-id-card-management');
    }
}
