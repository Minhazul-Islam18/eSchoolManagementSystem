<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * Get the school that owns the SchoolExam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Get the class that owns the SchoolExam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    /**
     * Get the section that owns the SchoolExam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(SchoolClassSection::class, 'school_class_section_id');
    }

    /**
     * Get the group that owns the Exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(classGroup::class, 'group_id');
    }

    // This function will return all grades by school
    public static function allGrades()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
    }
    // This function will return result by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }

    // This will return all grade rules associated with a grade.
    //
    /**
     * Get all of the gradingRules for the Grade
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradingRules(): HasMany
    {
        return $this->hasMany(GradingRule::class, 'grade_id');
    }
}
