<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mirror extends Model
{
    protected $fillable = [
        'slug', 'name', 'title', 'type', 'season',
        'accent_color', 'starts_at', 'ends_at',
    ];


    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'mirror_id');
    }
}
