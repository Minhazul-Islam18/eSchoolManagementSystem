<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolClassSubject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // This function will return all subjects by school
    public static function allSubjects()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
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
    // This function will return subject by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }

    /**
     * Get the section that owns the SchoolClassSubject
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_class_section(): BelongsTo
    {
        return $this->belongsTo(SchoolClassSection::class);
    }

    /**
     * Get the class that owns the SchoolClassSubject
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
