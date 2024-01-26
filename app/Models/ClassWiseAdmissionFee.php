<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassWiseAdmissionFee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the school that owns the ClassWiseAdmissionFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    /**
     * Get the class that owns the ClassWiseAdmissionFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the group that owns the ClassWiseAdmissionFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(classGroup::class, 'group_id');
    }

    /**
     * Get the section that owns the ClassWiseAdmissionFee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(SchoolClassSection::class, 'section_id');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_wise_admission_fee_student', 'admission_fee_id', 'student_id')
            ->withPivot('due_amount', 'paid_amount', 'status')
            ->withTimestamps();
    }
}
