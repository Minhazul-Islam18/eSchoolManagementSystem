<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFeeCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // This function will return all fee categories by school
    public static function allCategories()
    {
        return self::where('school_id', school()->id)->get() ?? abort(404);
    }
}
