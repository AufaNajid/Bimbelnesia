<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gradeschedule extends Model
{
    protected $fillable = [
        'grade_id',
        'repeat_at'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'grade_id');
    }
}
