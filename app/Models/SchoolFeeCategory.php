<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolFeeCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // This function will return all fee categories by school
    public static function allCategories()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
    }

    /**
     * Get the school that owns the SchoolExam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
