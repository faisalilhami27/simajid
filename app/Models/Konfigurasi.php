<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    protected $table = "konfigurasi";
    protected $fillable = ['kode_konfig', 'nilai_konfig'];
}
