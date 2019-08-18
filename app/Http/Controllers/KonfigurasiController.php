<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonfigurasiRequest;
use App\Models\Konfigurasi;
use App\Models\UserPengurus;
use Illuminate\Support\Facades\Auth;

class KonfigurasiController extends Controller
{
    public function index()
    {
        $user = UserPengurus::with('pengurusRole')
            ->find(Auth::id());

        $isAdministrator = false;
        foreach ($user->pengurusRole as $userRole) {
            $isAdministrator = RoleIdentifierController::hasAdministrator($userRole->id_user_level);

            if ($isAdministrator) {
                break;
            }
        }

        if ($isAdministrator) {
            $konfig = Konfigurasi::all();
            return view('konfigurasi.index', compact('konfig'));
        } else {
            return view('error.denied');
        }
    }

    public function update(KonfigurasiRequest $request)
    {
        $namaMesjid = htmlspecialchars($request->nama_mesjid);
        $ketua = htmlspecialchars($request->ketua);
        $password = htmlspecialchars($request->password);
        $alamat = htmlspecialchars($request->alamat);
        $versi = htmlspecialchars($request->versi);
        $latitude = htmlspecialchars($request->latitude);
        $longitude = htmlspecialchars($request->longitude);
        $konfig = Konfigurasi::all();

        $kode = "";
        $data = "";
        if ($namaMesjid != $konfig[6]->nilai_konfig) {
            $data = ['nilai_konfig' => $namaMesjid];
            $kode = "NAMA_MESJID";
        } else if ($ketua != $konfig[1]->nilai_konfig) {
            $data = ['nilai_konfig' => $ketua];
            $kode = "KETUA";
        }  else if ($password != $konfig[7]->nilai_konfig) {
            $data = ['nilai_konfig' => $password];
            $kode = "RESET_PASSWORD";
        } else if ($alamat != $konfig[0]->nilai_konfig) {
            $data = ['nilai_konfig' => $alamat];
            $kode = "ALAMAT_MESJID";
        } else if ($versi != $konfig[8]->nilai_konfig) {
            $data = ['nilai_konfig' => $versi];
            $kode = "VERSION";
        } else if ($kode != $konfig[2]->nilai_konfig) {
            $data = ['nilai_konfig' => $versi];
            $kode = "KOTA";
        } else if ($latitude != $konfig[3]->nilai_konfig) {
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
