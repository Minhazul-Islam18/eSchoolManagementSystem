<?php

namespace App\Models;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolNotice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /**
     * Get the school that owns the SchoolNotice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
    public function schoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'school_notice_school_class', 'notice_id', 'class_id');
    }
}
