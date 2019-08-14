<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleLevelRequest;
use App\Models\RoleLevel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleLevelController extends Controller
{
    public function index()
    {
        return view('role_level.index');
    }

    public function datatable()
    {
        $data = RoleLevel::orderBy('id', 'desc')->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(RoleLevelRequest $request)
    {
        $nama = htmlspecialchars($request->nama);

        $insert = RoleLevel::create([
            'nama' => $nama,
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

        $getData = RoleLevel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(RoleLevelRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];

        $update = RoleLevel::find($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = RoleLevel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
