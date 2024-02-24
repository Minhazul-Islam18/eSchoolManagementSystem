<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolStaff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    /**
     * Get the school that owns the SchoolStaff
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }


    public static function findSchoolStaff($id)
    {
        return  self::where('school_id', school()->id)->findOrFail($id);
    }


    public static function allStaffs()
    {
        return  self::where('school_id', school()->id)->get();
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(StaffAttendance::class, 'staff_id');
    }
}
