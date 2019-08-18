<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donatur extends Model
{
    use SoftDeletes;
    protected $table = "donatur";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["nama", "tempat_lahir", "tanggal_lahir", "id_jenis", "no_hp", "alamat", "jenis_kelamin"];

    public function jenis()
    {
        return $this->hasOne(JenisDonatur::class, 'id', 'id_jenis');
    }
}
