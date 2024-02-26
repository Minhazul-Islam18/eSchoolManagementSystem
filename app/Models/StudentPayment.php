<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class StudentPayment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fee()
    {
        return $this->belongsTo(SchoolFee::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function studentClass(): HasOneThrough
    {
        return $this->hasOneThrough(SchoolClass::class, Student::class, 'id', 'id', 'student_id', 'school_class_id');
    }

    public function studentClassSection(): HasOneThrough
    {
        return $this->hasOneThrough(SchoolClassSection::class, Student::class, 'id', 'id', 'student_id', 'school_class_section_id');
    }

    public function studentClassGroup(): HasOneThrough
    {
        return $this->hasOneThrough(classGroup::class, Student::class, 'id', 'id', 'student_id', 'class_group_id');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('payment_id', 'like', "%{$value}%");
    }
}
