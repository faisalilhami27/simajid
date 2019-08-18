<?php

namespace App\Http\Controllers;

use App\Models\RoleLevel;

class RoleIdentifierController extends Controller
{
    public static function hasAdministrator($role)
    {
        $returnValue = false;
        $defaultRole = RoleLevel::where('nama', 'Administrator')->first();

        if ($defaultRole->id == $role) {
            $returnValue = true;
        }

        return $returnValue;
    }

    public static function hasTreasure($role)
    {
        $returnValue = false;
        $defaultRole = RoleLevel::where('nama', 'Bendahara')->first();

        if ($defaultRole->id == $role) {
            $returnValue = true;
        }

        return $returnValue;
    }

    public static function hasHead($role)
    {
        $returnValue = false;
        $defaultRole = RoleLevel::where('nama', 'Ketua DKM')->first();

        if ($defaultRole->id == $role) {
            $returnValue = true;
        }

        return $returnValue;
    }

    public static function hasViceChairman($role)
    {
        $returnValue = false;
        $defaultRole = RoleLevel::where('nama', 'Wakil Ketua DKM')->first();

        if ($defaultRole->id == $role) {
            $returnValue = true;
        }

        return $returnValue;
    }

    public static function hasSecretary($role)
    {
        $returnValue = false;
        $defaultRole = RoleLevel::where('nama', 'Sekretaris')->first();

        if ($defaultRole->id == $role) {
            $returnValue = true;
        }

        return $returnValue;
    }
}
