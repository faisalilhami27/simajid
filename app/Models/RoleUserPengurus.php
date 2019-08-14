<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUserPengurus extends Model
{
    protected $table = "role_user_pengurus";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['id_user_level', 'id_pengurus'];

    public function userPengurus()
    {
        return $this->belongsTo(UserPengurus::class, 'id_pengurus');
    }

    public function role()
    {
        return $this->hasOne(RoleLevel::class, 'id', 'id_user_level');
    }
}
