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
    protected $fillable = ["tanggal", "id_pengurus", "id_dana", "jumlah", "keterangan"];

    public function dana()
    {
        return $this->hasOne(SumberDana::class, 'id', 'id_dana');
    }
}
