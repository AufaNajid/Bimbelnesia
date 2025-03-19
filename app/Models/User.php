<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash; 
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id',
        'grade_id',
        'avatar',
        'username',
        'password',
        'role',
        'fullname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [ // ✅ Ubah dari function menjadi property
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set the user's password (hashed).
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Relationship with Branch.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id'); // ✅ Sesuaikan jika 'id' adalah PK di tabel branch
    }

    /**
     * Relationship with Grade.
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id'); // ✅ Sesuaikan jika 'id' adalah PK di tabel grade
    }
}
