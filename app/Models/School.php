<?php

namespace App\Models;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class School extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    // Relationships

    /**
     * Get all of the users for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }


    public function administrator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all of the classes for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes(): HasMany
    {
        return $this->hasMany(SchoolClass::class);
    }

    /**
     * Get all of the staffs for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staffs(): HasMany
    {
        return $this->hasMany(SchoolStaff::class);
    }

    public static function allInformations(): School
    {
        return self::where('user_id', auth()->user()->id)
            ->with('package')
            ->first();
    }

    /**
     * Get all of the fees for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fees(): HasMany
    {
        return $this->hasMany(SchoolFee::class, 'school_id');
    }

    /**
     * Grading rule for a specific section.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public static function gradingRule($school, $id, $section_or_group)
    {
        if ($section_or_group === 'section') {
            return Grade::whereHas('section', function ($query) use ($id) {
                $query->where('school_class_section_id', $id);
            })->where('school_id', $school->id)->latest()->first();
        } else {
            return Grade::whereHas('group', function ($query) use ($id) {
                $query->where('group_id', $id);
            })->where('school_id', $school->id)->latest()->first();
        }
    }

    /**
     * Get all of the notices for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notices(): HasMany
    {
        return $this->hasMany(SchoolNotice::class);
    }

    /**
     * Get all of the routines for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routines(): HasMany
    {
        return $this->hasMany(ClassRoutine::class);
    }

    /**
     * Get all of the syllabuses for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function syllabuses(): HasMany
    {
        return $this->hasMany(ClassSyllabus::class);
    }

    /**
     * Get all of the sections for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(SchoolClassSection::class);
    }


    /**
     * Get all of the groups for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups(): HasMany
    {
        return $this->hasMany(classGroup::class);
    }


    /**
     * Get the package that owns the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    // /**
    //  * Get the subscription associated with the School
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasOne
    //  */
    // public function subscription(): HasOne
    // {
    //     return $this->hasOne(Subscription::class, 'user_id', school()->user_id);
    // }

    /**
     * Get all of the monthly_fees for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function monthly_fees(): HasMany
    {
        return $this->hasMany(SchoolMonthlyFee::class);
    }

    public function canAddStudent()
    {
        $maxStudents = school()->package->allowed_students;
        return $this->students()->count() < $maxStudents;
    }

    /**
     * Get all of the studentIdCards for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentIdCards(): HasMany
    {
        return $this->hasMany(StudentIdCard::class, 'school_id');
    }

    /**
     * Get all of the admissionFees for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admissionFees(): HasMany
    {
        return $this->hasMany(ClassWiseAdmissionFee::class, 'school_id');
    }

    /**
     * Get all of the exams for the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams(): HasMany
    {
        return $this->hasMany(SchoolExam::class, 'school_id');
    }
}
