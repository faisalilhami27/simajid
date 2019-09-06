<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemasukan extends Model
{
    use SoftDeletes;
    protected $table = "pemasukan";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["tanggal", "id_pengurus", "id_jenis_pemasukan", "id_jenis_infaq", "id_donatur", "id_pengubah", "jumlah", "keterangan"];

    public function jenisInfaq()
    {
        return $this->hasOne(JenisInfaq::class, 'id', 'id_jenis_infaq');
    }

    public function jenisPemasukan()
    {
        return $this->hasOne(JenisPemasukan::class, 'id', 'id_jenis_pemasukan');
    }

    public function donatur()
    {
        return $this->hasOne(Donatur::class, 'id', 'id_donatur');
    }
}
