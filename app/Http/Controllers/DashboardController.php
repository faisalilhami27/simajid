<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Pengurus;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $month = Carbon::now()->format('m');
        $getPemasukan = Pemasukan::whereMonth('tanggal', $month)->get();
        $pemasukan = collect($getPemasukan)->sum('jumlah');
        $getPengeluaran = Pengeluaran::whereMonth('tanggal', $month)->get();
        $pengeluaran = collect($getPengeluaran)->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;
        $getJumlahPengurus = Pengurus::count();
        return view('dashboard.home', compact('getJumlahPengurus', 'pemasukan', 'pengeluaran', 'saldo'));
    }
}
