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
        $namaPerusahaan = htmlspecialchars($request->nama_perusahaan);
        $namaPemilik = htmlspecialchars($request->nama_pemilik);
        $password = htmlspecialchars($request->password);
        $alamat = htmlspecialchars($request->alamat);
        $versi = htmlspecialchars($request->versi);
        $file = $request->file('gambar');
        $konfig = Konfigurasi::all();

        $kode = "";
        $data = "";
        if ($file == "") {
            if ($namaPerusahaan != $konfig[2]->nilai_konfig) {
                $data = ['nilai_konfig' => $namaPerusahaan];
                $kode = "NAMA_MESJID";
            } else if ($namaPemilik != $konfig[3]->nilai_konfig) {
                $data = ['nilai_konfig' => $namaPemilik];
                $kode = "KETUA";
            }  else if ($password != $konfig[4]->nilai_konfig) {
                $data = ['nilai_konfig' => $password];
                $kode = "RESET_PASSWORD";
            } else if ($alamat != $konfig[0]->nilai_konfig) {
                $data = ['nilai_konfig' => $alamat];
                $kode = "ALAMAT_MESJID";
            } else if ($versi != $konfig[5]->nilai_konfig) {
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
        } else {
            $kode = "LOGO_MESJID";

            $data = [
                'nilai_konfig' => $file->store('img', 'public')
            ];

            if ($file->getSize() > 1000000) {
                return response()->json(["status" => 500, "msg" => "Maksimal file adalah 1 MB"]);
            } else {
                $update = Konfigurasi::where('kode_konfig', $kode)->update($data);

                if ($update) {
                    return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah otomatis']);
                } else {
                    return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
                }
            }
        }
    }
}
