<?php

namespace App\Http\Controllers;

use App\Http\Requests\StrukturOrganisasiRequest;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $data = StrukturOrganisasi::where('kode', 'DKM')->first();
        $value = (!is_null($data)) ? $data->value : "";
        $checkAccess = checkAccess();
        return view('struktur_organisasi.dkm', compact('value', 'checkAccess'));
    }

    public function show()
    {
        $data = StrukturOrganisasi::where('kode', 'DKM')->first()['value'];
        return response()->json(['data' => $data]);
    }

    public function edit(Request $request)
    {
        $kode = $request->kode;

        $getData = StrukturOrganisasi::where('kode', $kode)->first()['value'];

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(StrukturOrganisasiRequest $request)
    {
        $value = $request->value;
        $kode = $request->kode;

        $update = StrukturOrganisasi::where('kode', $kode)->update([
            'value' => $value,
        ]);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }
}
