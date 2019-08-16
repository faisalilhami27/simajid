<?php

namespace App\Http\Controllers;

use App\Models\Konfigurasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JadwalSholatController extends Controller
{
    public function index()
    {
        return view('jadwal_sholat.index');
    }

    public function datatable()
    {
        $konfigurasi = Konfigurasi::all();
        $month = date('n');
        $year = date('Y');
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://api.aladhan.com/v1/calendar?latitude=' . $konfigurasi[3]->nilai_konfig . '&longitude= ' . $konfigurasi[4]->nilai_konfig . '&method=' . $konfigurasi[5]->nilai_konfig . '&month=' . $month . '&year=' . $year);
        $response = $request->getBody()->getContents();
        $decode = json_decode($response);
        $data = [];
        $i = 1;
        foreach ($decode->data as $d) {
            $tanggal = monthConverter(date('n', strtotime($d->date->gregorian->date)));
            $convertTanggal = date('d', strtotime($d->date->gregorian->date)) . ' ' . $tanggal . ' ' . date('Y', strtotime($d->date->gregorian->date));
            $bulanHijriah = monthHijriConverter(substr($d->date->hijri->date, 3, 2));
            $tanggalHijriah = substr($d->date->hijri->date, 0, 2);
            $tahunHijriah = substr($d->date->hijri->date, 6, 4);
            $data[$i] = [
                'tanggal' => $convertTanggal,
                'hijriah' => $tanggalHijriah . ' ' . $bulanHijriah . ' ' . $tahunHijriah,
                'imsak' => $d->timings->Imsak,
                'subuh' => $d->timings->Fajr,
                'fajar' => $d->timings->Sunrise,
                'dzuhur' => $d->timings->Dhuhr,
                'ashar' => $d->timings->Asr,
                'maghrib' => $d->timings->Maghrib,
                'isya' => $d->timings->Isha,
            ];
            $i++;
        }
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function update(Request $request)
    {
        $latitude = htmlspecialchars($request->latitude);
        $longitude = htmlspecialchars($request->longitude);
        $konfig = Konfigurasi::all();

        $kode = "";
        $data = "";

         if ($latitude != $konfig[3]->nilai_konfig) {
            $data = ['nilai_konfig' => $latitude];
            $kode = "LATITUDE";
        } else if ($longitude != $konfig[4]->nilai_konfig) {
            $data = ['nilai_konfig' => $longitude];
            $kode = "LONGITUDE";
        }

        if ($kode == '' && $data == '') {
            return response()->json(['status' => 500]);
        } else {
            $update = Konfigurasi::where('kode_konfig', $kode)->update($data);
        }

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }
}
