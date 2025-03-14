<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'sesi_id',
        'user_id',
        'score'
    ];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
