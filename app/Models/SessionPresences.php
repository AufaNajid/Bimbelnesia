<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionPresences extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'sesi_id',
        'user_id',
        'is_present'
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
