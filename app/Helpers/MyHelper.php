<?php

use App\Models\Konfigurasi;
use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $output = 'active')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        }
    }
}

if (!function_exists('versionApp')) {
    function versionApp()
    {
        $query = Konfigurasi::all();
        return $query[5]->nilai_konfig;
    }
}

if (!function_exists('mosqueName')) {
    function mosqueName()
    {
        $query = Konfigurasi::all();
        return $query[2]->nilai_konfig;
    }
}
