<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GradingRule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * Get the grade that owns the SchoolExam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    // This function will return all grades by school
    public static function allRules($id)
    {
        return self::where('grade_id', $id)
            ->get() ?? abort(404);
    }
    // This function will return result by it's id by school
    public static function findBySchool($id)
    {
        return self::where('school_id', school()->id)->findOrFail($id);
    }
}
