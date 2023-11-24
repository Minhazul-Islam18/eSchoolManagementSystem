<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolExamResult extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * Get the student that owns the SchoolExamResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(student::class);
    }
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
     * The exams that belong to the SchoolExamResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(SchoolExam::class, 'school_exam_id');
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
     * Get the group that owns the Exam result
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(classGroup::class);
    }

    // This function will return all exams by school
    public static function allResults()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
    }
    // public static function studentResults()
    // {
    //     return Student::where('school_id', school()->id)->get() ?? abort(404);
    // }

    // This function will return exam by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }
}
