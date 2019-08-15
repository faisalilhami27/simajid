<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonfigurasiRequest;
use App\Models\Konfigurasi;

class KonfigurasiController extends Controller
{
    public function index()
    {
        $konfig = Konfigurasi::all();
        return view('konfigurasi.index', compact('konfig'));
    }

    public function update(KonfigurasiRequest $request)
    {
        $namaMesjid = htmlspecialchars($request->nama_mesjid);
        $ketua = htmlspecialchars($request->ketua);
        $password = htmlspecialchars($request->password);
        $alamat = htmlspecialchars($request->alamat);
        $versi = htmlspecialchars($request->versi);
        $konfig = Konfigurasi::all();

        $kode = "";
        $data = "";
        if ($namaMesjid != $konfig[2]->nilai_konfig) {
            $data = ['nilai_konfig' => $namaMesjid];
            $kode = "NAMA_MESJID";
        } else if ($ketua != $konfig[1]->nilai_konfig) {
            $data = ['nilai_konfig' => $ketua];
            $kode = "KETUA";
        }  else if ($password != $konfig[3]->nilai_konfig) {
            $data = ['nilai_konfig' => $password];
            $kode = "RESET_PASSWORD";
        } else if ($alamat != $konfig[0]->nilai_konfig) {
            $data = ['nilai_konfig' => $alamat];
            $kode = "ALAMAT_MESJID";
        } else if ($versi != $konfig[4]->nilai_konfig) {
            $data = ['nilai_konfig' => $versi];
            $kode = "VERSION";
        }

        if ($kode == '' && $data == '') {
            return response()->json(['status' => 500]);
        } else {
            $update = Konfigurasi::where('kode_konfig', $kode)->update($data);
        }

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah otomatis']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }
}
