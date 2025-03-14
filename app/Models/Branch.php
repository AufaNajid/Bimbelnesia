<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['branch_admin_id', 'title', 'location'];

    public function users()
    {
        return $this->hasMany(User::class, 'branch_id', 'branch_id');
    }
}
