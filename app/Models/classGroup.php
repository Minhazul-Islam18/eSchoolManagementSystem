<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class classGroup extends Model
{
    use HasFactory;
    protected $fillable = ['group_name'];
    /**
     * Get the class that owns the classGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }
    // This function will return all groups by school
    public static function allGroups()
    {
        $e = SchoolClass::with('groups')->where('school_id', school()->id)->get();
        $filteredClasses = $e->filter(function ($class) {
            // return all classes those have group
            return $class->groups->isNotEmpty();
        });
        return $filteredClasses ?? abort(404);
    }
}
