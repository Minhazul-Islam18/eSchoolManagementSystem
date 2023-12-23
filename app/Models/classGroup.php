<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class classGroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * Get all of the subjects for the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(SchoolClassSubject::class, 'class_group_id');
    }

    /**
     * Get all of the exams for the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams(): HasMany
    {
        return $this->hasMany(SchoolExam::class, 'group_id');
    }

    /**
     * Get all of the students for the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_group_id');
    }


    /**
     * Get the class that owns the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    /**
     * Get all of the routines for the SchoolClassSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routines(): HasMany
    {
        return $this->hasMany(ClassRoutine::class, 'group_id');
    }

    // This function will return all groups by school
    public static function allGroups()
    {
        $e = SchoolClass::with('groups')->where('school_id', school()->id)->get();
        $filteredClasses = $e->filter(function ($class) {
            // return all classes those have group
            return $class->groups->isNotEmpty();
        });
        return $filteredClasses ?? abort(404);
    }

    // This function will return class by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }

    /**
     * Get all of the grades for the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'group_id');
    }

    public function fees()
    {
        return $this->hasMany(SchoolFee::class);
    }
}
