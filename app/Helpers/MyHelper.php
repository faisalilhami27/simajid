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
        return $query[8]->nilai_konfig;
    }
}

if (!function_exists('mosqueName')) {
    function mosqueName()
    {
        $query = Konfigurasi::all();
        return $query[6]->nilai_konfig;
    }
}

if (!function_exists('monthConverter')) {
    function monthConverter($param)
    {
        switch ($param) {
            case '1':
                $value = 'Januari';
                break;
            case '2':
                $value = 'Februari';
                break;
            case '3':
                $value = 'Maret';
                break;
            case '4':
                $value = 'April';
                break;
            case '5':
                $value = 'Mei';
                break;
            case '6':
                $value = 'Juni';
                break;
            case '7':
                $value = 'Juli';
                break;
            case '8':
                $value = 'Agustus';
                break;
            case '9':
                $value = 'September';
                break;
            case '10':
                $value = 'Oktober';
                break;
            case '11':
                $value = 'November';
                break;
            case '12':
                $value = 'Desember';
                break;
        }
        return $value;
    }
}

if (!function_exists('monthHijriConverter')) {
    function monthHijriConverter($param)
    {
        switch ($param) {
            case '1':
                $value = 'Muharam';
                break;
            case '2':
                $value = 'Safar';
                break;
            case '3':
                $value = "Rabiul Awal";
                break;
            case '4':
                $value = "Rabiul Akhir";
                break;
            case '5':
                $value = 'Jumadil Awal';
                break;
            case '6':
                $value = 'Jumadil Akhir';
                break;
            case '7':
                $value = 'Rajab';
                break;
            case '8':
                $value = "Syaban";
                break;
            case '9':
                $value = 'Ramadhan';
                break;
            case '10':
                $value = 'Syawal';
                break;
            case '11':
                $value = 'Dzulqadah';
                break;
            case '12':
                $value = 'Dzulhijah';
                break;
        }
        return $value;
    }
}
