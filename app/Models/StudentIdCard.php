<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentIdCard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'expire_date',
        'frontside_background_image',
        'backside_background_image',
        'signature',
        'qr_code',
        'backside_description',
    ];

    /**
     * Get the school that owns the StudentIdCard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
