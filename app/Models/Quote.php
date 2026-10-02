<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'mirror_id', 'text', 'weight', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'weight' => 'integer',
        ];
    }

    public function mirror()
    {
        return $this->belongsTo(Mirror::class, 'mirror_id');
    }

    public function userQuotes()
    {
        return $this->hasMany(UserQuote::class, 'quote_id');
    }
}
