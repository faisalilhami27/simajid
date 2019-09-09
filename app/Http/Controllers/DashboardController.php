<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Pengurus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function chartKeuangan()
    {
        $dataPemasukan = Pemasukan::select(DB::raw('MONTH(tanggal) AS bulan, SUM(jumlah) AS jumlah'))
            ->whereRaw('YEAR(tanggal) = YEAR(CURDATE())')
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->get();
        $dataPengeluaran = Pengeluaran::select(DB::raw('MONTH(tanggal) AS bulan, SUM(jumlah) AS jumlah'))
            ->whereRaw('YEAR(tanggal) = YEAR(CURDATE())')
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->get();
        $pemasukan = [];
        $pengeluaran = [];

        foreach ($dataPemasukan as $pm) {
            $pemasukan[] = [
                'bulan' => monthConverter($pm->bulan),
                'jumlah' => $pm->jumlah,
            ];
        }

        foreach ($dataPengeluaran as $pl) {
            $pengeluaran[] = [
                'bulan' => monthConverter($pl->bulan),
                'jumlah' => $pl->jumlah
            ];
        }

        $data = [
          'pemasukan' => $pemasukan,
          'pengeluaran' => $pengeluaran,
        ];

        return response()->json($data);
    }
}
