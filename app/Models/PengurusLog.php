<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengurusLog extends Model
{
    protected $table = 'pengurus_log';

    protected $fillable = [
        'id_pengurus',
        'description',
        'provider',
        'last_login_at',
        'last_login_ip'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_login_at'
    ];
}
