<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getIsFreeAttribute()
    {
        return empty($this->attributes['price']);
    }
}
