<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengurus extends Model
{
    use SoftDeletes;
    protected $table = "pengurus";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ['nama', 'email', 'no_hp', 'status', 'foto', 'id_jabatan', 'id_jenis', 'id_pengurus'];
}
