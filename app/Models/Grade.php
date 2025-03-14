<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    Protected $primaryKey = 'id'; 
    protected $fillable = [
        'branch_id',
        'grade_tag_id',
        'title'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function gradeTag()
    {
        return $this->belongsTo(GradeTag::class, 'grade_tag_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'grade_id', 'id');
    }
}
