<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuote extends Model
{
    protected $table = 'user_quote';
    protected $fillable = [
        'user_id', 'quote_id', 'seen_on', 'favorited_at',
    ];

    protected function casts(): array
    {
        return [
            'seen_on' => 'date',
            'favorited_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
