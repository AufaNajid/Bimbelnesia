<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gradestudent extends Model
{
    protected $fillable = [
        'grade_id',
        'student_id'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'grade_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
