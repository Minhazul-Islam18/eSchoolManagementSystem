<?php

namespace App\Livewire\Backend\School;

use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use App\Models\SchoolClass;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\StudentQuota;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\StudentCategory;
use Livewire\Attributes\Layout;
use App\Models\GurdianOccupation;
use Livewire\Attributes\Validate;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Devfaysal\BangladeshGeocode\Models\Union;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;

class AdmissionManagement extends Component
{
    use LivewireAlert, WithFileUploads;
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
        $upazila,
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
        $fathers_occupation,
        $gurdians_occupation,
        $sections = [],
        $groups = [],
        $class_id = null,
        $group_id = null,
        $class_id_of_studying_siblings,
        $division,
        $division_id,
        $district_id,
        $upazila_id,
        $union_id,
        $districts = [],
        $upazilas = [],
        $unions = [],
        $section_id,
        $openCEmodal = false,
        $checkImageDimension = true,
        $editable_item,
        $class,
        $section,
        $group,
        $student_quota,
        $student_category;
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
        if (null != $this->school_class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->school_class_id)->where('school_id', school()->id)->get();
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
        if (null != $this->school_class_id) {
            $this->groups = school()->classes()->findOrFail($this->school_class_id)->groups;
        }
    }
    public function checkDivision()
    {
        $this->districts = District::where('division_id', $this->division_id)->get();
    }
    public function checkUpazilla()
    {
        $this->upazilas = Upazila::where('district_id', $this->district_id)->get();
    }
    public function checkUnion()
    {
        $this->unions = Union::where('upazila_id', $this->upazila_id)->get();
    }
    #[On('form-preview')]
    public function formPreview()
    {
        $this->validate([
            'student_image' => 'required',
            'name_bn' => 'required',
            'name_en' => 'required',
            'school_class_id' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'birth_certificate_no' => 'required',
            'dob' => 'required',
            'have_siblings_studying' => 'nullable',
            'student_category_id' => 'required',
            'student_quota_id' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'union_id' => 'required',
            'postoffice' => 'required',
            'village' => 'required',
            'mobile_number' => 'required',
            'post_code' => 'required',
        ]);
        $this->student_category = StudentCategory::findOrFail($this->student_category_id);
        $this->student_quota = StudentQuota::findOrFail($this->student_quota_id);
        $this->class = SchoolClass::findBySchool($this->school_class_id);
        if ($this->class_id_of_studying_siblings != null) {
            $this->class_of_studying_siblings = SchoolClass::findBySchool($this->class_id_of_studying_siblings)->class_name;
        }
        $this->section = $this->class->classSections->find($this->section_id);
        $this->group = $this->class->groups->find($this->group_id);
        $this->student_quota = StudentQuota::findOrFail($this->student_quota_id);
        $this->student_category = StudentCategory::findOrFail($this->student_category_id);
        $this->division = Division::findOrFail($this->division_id)->bn_name;
        $this->district = District::findOrFail($this->district_id)->bn_name;
        $this->upazila = Upazila::findOrFail($this->upazila_id)->bn_name;
        $this->union = Union::findOrFail($this->union_id)->bn_name;
    }
    public function checkPD()
    {
        $this->validate([
            'fathers_name_bn' => 'required',
            'mothers_name_bn' => 'required',
            'fathers_name_en' => 'required',
            'mothers_name_en' => 'required',
            'fathers_nid_no' => 'required',
            'mothers_nid_no' => 'required',
            'fathers_bc_no' => 'required',
            'mothers_bc_no' => 'required',
            'gurdians_occupation' => 'required',
        ]);
    }
    public function store()
    {
        Gate::authorize('school.admissions.create');
        $u = User::create([
            'student_id' => date('y') . rand(101, 10000),
            'name' => $this->name_en,
            'role_id' => Role::where('slug', 'student')->first()->id,
        ]);
        if (null != $this->student_image) {
            $this->student_image = $this->student_image->storeAs(auth()->user()->id . '/students', $this->student_image->hashName(), 'public');
        }
        Student::create([
            'user_id' => $u->id,
            'student_id' => $u->student_id,
            'school_id' => school()->id,
            'admission_id' => date('d') . date('m') . date('y') . Str::random(5),
            'student_image' => $this->student_image,
            'name_bn' => $this->name_bn,
            'name_en' => $this->name_en,
            'school_class_id' => $this->school_class_id,
            'roll' => $this->roll,
            'school_class_section_id' => $this->section_id,
            'class_group_id' => $this->group_id,
            'ssc_roll' => $this->ssc_roll,
            'gender' => $this->gender,
            'religion' => $this->religion,
            'birth_certificate_no' => $this->birth_certificate_no,
            'dob' => $this->dob,
            'has_stipend' => false,
            'have_siblings_studying' => $this->have_siblings_studying ? 1 : 0,
            'student_category_id' => $this->student_category_id,
            'student_quota_id' => $this->student_quota_id,
            'name_of_siblings_studying' => $this->name_of_studying_siblings,
            'roll_of_siblings_studying' => $this->roll_of_studying_siblings,
            'class_of_siblings_studying' => $this->class_of_studying_siblings,
            'freedomfighter_certificate_no' => $this->freedom_fighter_id,
            'previous_institute' => $this->previous_institute,
            'previous_study_class' => $this->previous_study_class,
            'division' => $this->division_id,
            'zilla' => $this->district_id,
            'upazilla_or_thana' => $this->upazila_id,
            'union' => $this->union_id,
            'postoffice' => $this->postoffice,
            'village' => $this->village,
            'mobile_number' => $this->mobile_number,
            'post_code' => $this->post_code,
            'fathers_name_bn' => $this->fathers_name_bn,
            'mothers_name_bn' => $this->mothers_name_bn,
            'fathers_name_en' => $this->fathers_name_en,
            'mothers_name_en' => $this->mothers_name_en,
            'fathers_nid_no' => $this->fathers_nid_no,
            'mothers_nid_no' => $this->mothers_nid_no,
            'fathers_bc_no' => $this->fathers_bc_no,
            'mothers_bc_no' => $this->mothers_bc_no,
            // 'father_occupation' => $this->gurdians_occupation,
            'gurdian_in_absence_of_parent_en' => $this->gurdian_in_absence_of_parent_en,
            'gurdian_in_absence_of_parent_bn' => $this->gurdian_in_absence_of_parent_bn,
            'gurdian_nid_no' => $this->gurdian_nid_no,
            'relation_with_gurdian' => $this->relation_with_gurdian,
            'gurdians_monthly_income' => $this->gurdians_monthly_income,
            'gurdians_occupation' => $this->gurdians_occupation,
        ]);
        $this->alert('success', 'Student admission created');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->student_image = '';
        $this->name_bn = '';
        $this->name_en = '';
        $this->school_class_id = '';
        $this->roll = '';
        $this->ssc_roll = '';
        $this->gender = '';
        $this->religion = '';
        $this->birth_certificate_no = '';
        $this->dob = '';
        $this->has_stipend = '';
        $this->have_siblings_studying = '';
        $this->name_of_studying_siblings = '';
        $this->class_of_studying_siblings = '';
        $this->roll_of_studying_siblings = '';
        $this->freedom_fighter_id = '';
        $this->student_category_id = '';
        $this->student_quota_id = '';
        $this->previous_institute = '';
        $this->previous_study_class = '';
        $this->district = '';
        $this->upazila = '';
        $this->union = '';
        $this->postoffice = '';
        $this->village = '';
        $this->mobile_number = '';
        $this->post_code = '';
        $this->fathers_name_bn = '';
        $this->mothers_name_bn = '';
        $this->fathers_name_en = '';
        $this->mothers_name_en = '';
        $this->fathers_nid_no = '';
        $this->mothers_nid_no = '';
        $this->fathers_bc_no = '';
        $this->mothers_bc_no = '';
        $this->gurdian_in_absence_of_parent_en = '';
        $this->gurdian_in_absence_of_parent_bn = '';
        $this->gurdian_nid_no = '';
        $this->relation_with_gurdian = '';
        $this->gurdians_monthly_income = '';
        $this->fathers_occupation = '';
        $this->gurdians_occupation = '';
        $this->sections = [];
        $this->groups = [];
        $this->class_id = '';
        $this->group_id = '';
        $this->class_id_of_studying_siblings = '';
        $this->division = '';
        $this->division_id = '';
        $this->district_id = '';
        $this->upazila_id = '';
        $this->union_id = '';
        $this->districts = [];
        $this->upazilas = [];
        $this->unions = [];
        $this->section_id = '';
        $this->openCEmodal = false;
        $this->checkImageDimension = true;
        $this->editable_item = '';
        $this->student_quota = '';
        $this->student_category = '';
    }

    public function mount()
    {
        Gate::authorize('school.admissions.index');
    }
    public function render()
    {
        $applications = Student::where('school_id', school()->id)
            ->whereNotNull('admission_id')
            ->with(['class_group', 'school_class_section'])
            ->get();
        // dd($applications);
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
                'applications' => $applications,
            ]);
    }
}
