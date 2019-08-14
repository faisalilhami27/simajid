<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\RoleUserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $getJumlahPengurus = Pengurus::count();
        return view('home', compact('getJumlahPengurus'));
    }
}
