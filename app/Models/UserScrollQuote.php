<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserScrollQuote extends Model
{
    protected $fillable = ['user_id', 'quote_id'];

    public function quote()
    {
        return $this->belongsTo(Quote::class, 'quote_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
