<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = "struktur_organisasi";
    protected $primaryKey = "id";
    protected $dates = [ 'updated_at', 'created_at'];
    protected $fillable = ["value"];
}
