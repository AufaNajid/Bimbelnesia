<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeTag extends Model
{
    protected $fillable = [
        'title'
    ];

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'grade_tag_pivot', 'grade_tag_id', 'grade_id');
    }
}
