<?php

namespace App\Models;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class School extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // Relationships
    public function administrator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    /**
     * Get all of the classes for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes(): HasMany
    {
        return $this->hasMany(SchoolClass::class);
    }

    public static function allInformations(): School
    {
        return self::where('user_id', auth()->user()->id)
            // ->with('classes.classSections')
            ->first();
    }

    /**
     * The fees that belong to the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fees(): BelongsToMany
    {
        return $this->belongsToMany(SchoolFee::class);
    }

    //grading
    // public static function gradingRule(School $school, $section_id)
    // {
    //     return $school->classes->flatMap->classSections->flatMap->grading($section_id);
    // }
    /**
     * Grading rule for a specific section.
     *
     * @param  int  $section_id
     * @return \Illuminate\Support\Collection
     */
    public static function gradingRule($school, $section_id)
    {
        return Grade::whereHas('section', function ($query) use ($section_id) {
            $query->where('id', $section_id);
        })->where('school_id', $school->id)->latest()->first();
    }
}
