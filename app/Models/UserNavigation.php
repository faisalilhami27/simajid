<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNavigation extends Model
{
    protected $table = "user_navigation";
    protected $primaryKey = "id";
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];
    protected $fillable = ["id_user_level", "id_menu", "create", "read", "update", "delete"];

    public function menu()
    {
        return $this->hasOne(Navigation::class, 'id', 'id_menu');
    }
}
