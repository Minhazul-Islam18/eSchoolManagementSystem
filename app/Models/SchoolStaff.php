<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolStaff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function findSchoolStaff($id)
    {
        return  self::where('school_id', auth()->user()->id)->findOrFail($id);
    }
    public static function allStaffs()
    {
        return  self::where('school_id', auth()->user()->id)->get();
    }
}
