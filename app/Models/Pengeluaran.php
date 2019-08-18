<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengeluaran extends Model
{
    use SoftDeletes;
    protected $table = "pemasukan";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["tanggal", "id_pengurus", "id_jenis", "jumlah", "keterangan"];

    public function jenis()
    {
        return $this->hasOne(JenisPengeluaran::class, 'id', 'id_jenis');
    }
}
