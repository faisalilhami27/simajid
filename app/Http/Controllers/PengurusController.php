<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengurusRequest;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengurusController extends Controller
{
    public function index()
    {
        return view('pengurus.index');
    }

    public function datatable()
    {
        $data = Pengurus::all();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(PengurusRequest $request)
    {
        $nama = htmlspecialchars($request->nama);
        $email = htmlspecialchars($request->email);
        $noHp = htmlspecialchars($request->no_hp);
        $status = $request->status;

        $insert = Pengurus::create([
            'nama' => $nama,
            'email' => $email,
            'no_hp' => $noHp,
            'status' => $status,
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

        $getData = Pengurus::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function cekEmail(Request $request)
    {
        $email = $request->email;
        $cekUsername = Pengurus::where('email', $email)->get();
        $getEmail = $cekUsername->count();

        if ($getEmail == 1) {
            return response()->json(['status' => 500, 'msg' => 'email has been used']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'email available']);
        }
    }

    public function cekNoHp(Request $request)
    {
        $noHp = $request->noHp;
        $cekUsername = Pengurus::where('no_hp', $noHp)->get();
        $getNoHp = $cekUsername->count();

        if ($getNoHp == 1) {
            return response()->json(['status' => 500, 'msg' => 'No Handphone has been used']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'No Handphone available']);
        }
    }

    public function update(PengurusRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];

        $update = Pengurus::find($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = Pengurus::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
