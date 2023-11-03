<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendPage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->where('status', 1)->firstOrFail();
    }
}
