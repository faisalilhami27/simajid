<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StrukturOrganisasi extends Model
{
    use SoftDeletes;
    protected $table = "struktur_organisasi";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["id_jabatan", "id_pengurus"];

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class, 'id', 'id_pengurus');
    }

    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id', 'id_jabatan');
    }
}
