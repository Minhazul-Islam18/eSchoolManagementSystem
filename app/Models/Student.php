<?php

namespace App\Models;

use App\Models\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // Relationships
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public static function allStudents()
    {
        return Student::where('school_id', school()->id)->get() ?? abort(404);
    }
}
