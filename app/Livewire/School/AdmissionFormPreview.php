<?php

namespace App\Livewire\School;

use App\Models\Student;
use Livewire\Component;
use App\Models\SchoolClass;
use App\Models\SchoolClassSection;
use App\Models\StudentCategory;
use App\Models\StudentQuota;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;

class AdmissionFormPreview extends Component
{
    public
        $preview = [
            'user_id',
            'student_id',
            'school_id',
            'admission_id',
            'student_image',
            'name_bn',
            'name_en',
            'school_class_id',
            'roll',
            'school_class_section_id',
            'ssc_roll',
            'gender',
            'religion',
            'birth_certificate_no',
            'dob',
            'has_stipend',
            'have_siblings_studying',
            'student_category',
            'student_quota',
            'name_of_siblings_studying',
            'roll_of_siblings_studying',
            'class_of_siblings_studying',
            'freedomfighter_certificate_no',
            'previous_institute',
            'previous_study_class',
            'division',
            'district',
            'upazila',
            'union',
            'postoffice',
            'village',
            'mobile_number',
            'post_code',
            'fathers_name_bn',
            'mothers_name_bn',
            'fathers_name_en',
            'mothers_name_en',
            'fathers_nid_no',
            'mothers_nid_no',
            'fathers_bc_no',
            'mothers_bc_no',
            'gurdian_in_absence_of_parent_en',
            'gurdian_in_absence_of_parent_bn',
            'gurdian_nid_no',
            'relation_with_gurdian',
            'gurdians_monthly_income',
            'gurdians_occupation',
        ];
    public function mount($admission_id)
    {
        $e = Student::where('admission_id', $admission_id)->firstOrFail();
        // dd($e);
        $this->preview['user_id'] = $e->user_id;
        $this->preview['student_id'] = $e->student_id;
        $this->preview['school_id'] = $e->school_id;
        $this->preview['admission_id'] = $e->admission_id;
        $this->preview['student_image'] = $e->student_image;
        $this->preview['name_bn'] = $e->name_bn;
        $this->preview['name_en'] = $e->name_en;
        $this->preview['class_name'] = SchoolClass::findBySchool($e->school_class_id)->class_name;
        $this->preview['roll'] = $e->roll;
        $this->preview['section_name'] = SchoolClassSection::findBySchool($e->school_class_section_id)->section_name;
        $this->preview['ssc_roll'] = $e->ssc_roll;
        $this->preview['gender'] = $e->gender;
        $this->preview['religion'] = $e->religion;
        $this->preview['birth_certificate_no'] = $e->birth_certificate_no;
        $this->preview['dob'] = $e->dob;
        $this->preview['has_stipend'] = $e->has_stipend;
        $this->preview['have_siblings_studying'] = $e->have_siblings_studying;
        $this->preview['student_category'] = StudentCategory::find($e->student_category_id)->name;
        $this->preview['student_quota'] = StudentQuota::find($e->student_quota_id)->name;
        $this->preview['name_of_siblings_studying'] = $e->name_of_siblings_studying;
        $this->preview['roll_of_siblings_studying'] = $e->roll_of_siblings_studying;
        $this->preview['class_of_siblings_studying'] = $e->class_of_siblings_studying;
        $this->preview['freedomfighter_certificate_no'] = $e->freedomfighter_certificate_no;
        $this->preview['previous_institute'] = $e->previous_institute;
        $this->preview['previous_study_class'] = $e->previous_study_class;
        $this->preview['division'] = Division::find($e->division)->bn_name;
        $this->preview['district'] = District::find($e->zilla)->bn_name;
        $this->preview['upazila'] = Upazila::find($e->upazilla_or_thana)->bn_name;
        $this->preview['union'] = Union::find($e->union)->bn_name;
        $this->preview['postoffice'] = $e->postoffice;
        $this->preview['village'] = $e->village;
        $this->preview['mobile_number'] = $e->mobile_number;
        $this->preview['post_code'] = $e->post_code;
        $this->preview['fathers_name_bn'] = $e->fathers_name_bn;
        $this->preview['mothers_name_bn'] = $e->mothers_name_bn;
        $this->preview['fathers_name_en'] = $e->fathers_name_en;
        $this->preview['mothers_name_en'] = $e->mothers_name_en;
        $this->preview['fathers_nid_no'] = $e->fathers_nid_no;
        $this->preview['mothers_nid_no'] = $e->mothers_nid_no;
        $this->preview['fathers_bc_no'] = $e->fathers_bc_no;
        $this->preview['mothers_bc_no'] = $e->mothers_bc_no;
        $this->preview['gurdian_in_absence_of_parent_en'] = $e->gurdian_in_absence_of_parent_en;
        $this->preview['gurdian_in_absence_of_parent_bn'] = $e->gurdian_in_absence_of_parent_bn;
        $this->preview['gurdian_nid_no'] = $e->gurdian_nid_no;
        $this->preview['relation_with_gurdian'] = $e->relation_with_gurdian;
        $this->preview['gurdians_monthly_income'] = $e->gurdians_monthly_income;
        $this->preview['gurdians_occupation'] = $e->gurdians_occupation;
        $this->preview['name_of_studying_siblings'] = $e->name_of_studying_siblings;
        $this->preview['class_of_studying_siblings'] = $e->class_of_studying_siblings;
        $this->preview['roll_of_studying_siblings'] = $e->roll_of_studying_siblings;
    }
    public function render()
    {
        return view('livewire.backend.school.admission-form-preview');
    }
}
