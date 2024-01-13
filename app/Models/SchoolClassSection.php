<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolClassSection extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    /**
     * Get all of the grades for the classSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'school_class_section_id');
    }

    // This function will return all sections by school
    public static function allSections()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
    }

    // This function will return section by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }

    /**
     * Get the class that owns the SchoolClassSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }
    /**
     * Get the school that owns the SchoolClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
    /**
     * Get all of the subjects for the SchoolClassSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(SchoolClassSubject::class);
    }


    /**
     * Get all of the routines for the SchoolClassSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routines(): HasMany
    {
        return $this->hasMany(ClassRoutine::class, 'section_id');
    }

    /**
     * Get all of the syllabuses for the SchoolClassSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function syllabuses(): HasMany
    {
        return $this->hasMany(ClassSyllabus::class);
    }
    /**
     * Get all of the students for the SchoolClassSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'school_class_section_id');
    }
    // public static function students($section_id)
    // {
    //     return Student::where('school_class_section_id', $section_id)->get();
    // }

    public function grading($section_id)
    {
        return Grade::where('school_class_section_id', $section_id)->first();
    }

    public function fees()
    {
        return $this->hasMany(SchoolFee::class);
    }
}
