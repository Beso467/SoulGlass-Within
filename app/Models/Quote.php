<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable= [
        'mirror_id', 'text'
    ];

    public function mirror()
    {
        return $this->belongsTo(Mirror::class, 'mirror_id');
    }
}
