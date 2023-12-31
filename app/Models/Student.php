<?php

namespace App\Models;

use App\Models\School;
use App\Models\classGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // Relationships
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public static function allStudents()
    {
        return Student::where('school_id', school()->id)->get() ?? abort(404);
    }
    /**
     * Get the class that owns the SchoolExam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    /**
     * Get the section that owns the SchoolExam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_class_section(): BelongsTo
    {
        return $this->belongsTo(SchoolClassSection::class);
    }

    /**
     * The fees that belong to the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fees(): BelongsToMany
    {
        return $this->belongsToMany(SchoolFee::class)->withPivot(['due_amount', 'status']);
    }

    /**
     * Get the school_class_group that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class_group(): BelongsTo
    {
        return $this->belongsTo(classGroup::class);
    }

    public function payments()
    {
        return $this->hasMany(StudentPayment::class);
    }
}
