<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolFee extends Model
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
     * Get the category that owns the SchoolFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(SchoolFeeCategory::class, 'school_fee_category_id');
    }
    // This function will return all fees by school
    public static function allFees()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
    }

    // This function will return exam by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }

    /**
     * The students that belong to the SchoolFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
}
