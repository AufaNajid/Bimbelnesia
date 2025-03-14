<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $fillable = [
        'schedule_id',
        'study_id',
        'teacher_id',
        'date',
        'time',
    ];

    public function schedule()
    {
        return $this->belongsTo(GradeSchedule::class, 'schedule_id', 'grade_schedule_id');
    }

    // Relasi ke tabel Study
    public function study()
    {
        return $this->belongsTo(Studiy::class, 'study_id', 'study_id');
    }

    // Relasi ke tabel Teacher (User)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }


    public function presences()
    {
        return $this->hasMany(SessionPresence::class, 'session_id');
    }
}
