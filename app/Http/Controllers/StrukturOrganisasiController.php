<?php

namespace App\Http\Controllers;

use App\Http\Requests\StrukturOrganisasiRequest;
use App\Models\Jabatan;
use App\Models\Pengurus;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $checkAccess = json_encode(checkAccess());
        return view('struktur_organisasi.dkm', compact('checkAccess'));
    }

    public function datatable()
    {
        $data = StrukturOrganisasi::with(['jabatan' => function($query) {
            $query->orderBy('id', 'ASC');
        }])
        ->whereHas('pengurus', function ($query) {
            $query->where('id_jenis', 1);
        })->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function getJabatan()
    {
        $jabatan = Jabatan::all();
        return response()->json($jabatan);
    }

    public function getPengurus()
    {
        $pengurus = Pengurus::where('id', '!=', 1)
            ->where('id_jenis', 1)
            ->get();
        return response()->json($pengurus);
    }

    public function store(StrukturOrganisasiRequest $request)
    {
        $idJabatan = $request->id_jabatan;
        $idPengurus = $request->id_pengurus;

        $insert = StrukturOrganisasi::create([
            'id_jabatan' => $idJabatan,
            'id_pengurus' => $idPengurus,
        ]);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = StrukturOrganisasi::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(StrukturOrganisasiRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];

        $update = StrukturOrganisasi::find($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = StrukturOrganisasi::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
