<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mirror extends Model
{
    protected $fillable = [
        'name', 'slug', 'season', 'is_active', 'description',
        'starts_at', 'ends_at',
    ];
}
