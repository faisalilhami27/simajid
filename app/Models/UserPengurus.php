<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserPengurus extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'user_pengurus';
    protected $guard = 'pengurus';

    protected $fillable = [
        'id_pengurus',
        'username',
        'password',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class, 'id', 'id_pengurus');
    }

    public function pengurusRole()
    {
        return $this->hasMany(RoleUserPengurus::class, 'id_pengurus', 'id');
    }
}
