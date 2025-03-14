<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionGenerator extends Model
{
    protected $fillable = ['teacher_id', 'date', 'time', 'topic'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }   
}
