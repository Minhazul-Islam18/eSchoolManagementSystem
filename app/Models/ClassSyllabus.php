<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassSyllabus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the school that owns the ClassSyllabus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }


    /**
     * Get the class that owns the ClassSyllabus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }


    public function getSchoolAttribute()
    {
        return $this->class->school;
    }

    public static function allSyllabus()
    {
        return self::where('school_id', school()->id)->get();
    }
}
