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
    protected $fillable = ["tanggal", "id_pengurus", "id_jenis_infaq", "id_donatur", "id_pengubah", "jumlah", "keterangan"];

    public function jenis()
    {
        return $this->hasOne(JenisInfaq::class, 'id', 'id_jenis');
    }

    public function donatur()
    {
        return $this->hasOne(Donatur::class, 'id', 'id_doantur');
    }
}
