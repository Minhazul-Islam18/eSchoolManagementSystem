<?php

namespace App\Livewire\Backend\School;

use App\Models\GurdianOccupation;
use App\Models\SchoolClass;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\SchoolClassSection;
use App\Models\StudentCategory;
use App\Models\StudentQuota;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class AdmissionManagement extends Component
{
    use LivewireAlert;
    #[Title('Admission management')]

    public
        $student_image,
        $name_bn,
        $name_en,
        $school_class_id,
        $roll,
        $ssc_roll,
        $gender,
        $religion,
        $birth_certificate_no,
        $dob,
        $has_stipend,
        $have_siblings_studying,
        $name_of_studying_siblings,
        $class_of_studying_siblings,
        $roll_of_studying_siblings,
        $freedom_fighter_id,
        $student_category_id,
        $student_quota_id,
        $previous_institute,
        $previous_study_class,
        $district,
        $upazila_or_thana,
        $union,
        $postoffice,
        $village,
        $mobile_number,
        $post_code,
        $fathers_name_bn,
        $mothers_name_bn,
        $fathers_name_en,
        $mothers_name_en,
        $fathers_nid_no,
        $mothers_nid_no,
        $fathers_bc_no,
        $mothers_bc_no,
        $gurdian_in_absence_of_parent_en,
        $gurdian_in_absence_of_parent_bn,
        $gurdian_nid_no,
        $relation_with_gurdian,
        $gurdians_monthly_income,
        $gurdians_occupation,
        $sections = [],
        $class_id,
        $division,
        $districts = [],
        $upazilas = [],
        $unions = [],
        $section_id,
        $openCEmodal = false,
        $checkImageDimension = true,
        $editable_item;
    #[On('image-dimensions-valid')]
    public function imageDimensionsValid()
    {
        $this->checkImageDimension = false;
    }
    #[On('image-dimensions-ok')]
    public function imageDimensionsOk()
    {
        $this->checkImageDimension = true;
    }
    public function getSection()
    {
        if (null != $this->class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->where('school_id', school()->id)->get();
        }
    }
    public function checkDivision()
    {
        $this->districts = District::where('division_id', $this->division)->get();
    }
    public function checkUpazilla()
    {
        $this->upazilas = Upazila::where('district_id', $this->district)->get();
    }
    public function checkUnion()
    {
        $this->unions = Union::where('upazila_id', $this->district)->get();
    }
    public function render()
    {
        $divisions = Division::all();
        $GurdianOccupation = GurdianOccupation::all();
        $sc = StudentCategory::all();
        $sq = StudentQuota::all();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.admission-management')
            ->with([
                'sc' => $sc,
                'sq' => $sq,
                'classes' => $classes,
                'divisions' => $divisions,
                'GurdianOccupation' => $GurdianOccupation,
            ]);
    }
}
