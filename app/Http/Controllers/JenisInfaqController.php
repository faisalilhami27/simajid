<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisInfaqRequest;
use App\Models\JenisInfaq;
use App\Models\UserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class JenisInfaqController extends Controller
{
    public function index()
    {
        $user = UserPengurus::with('pengurusRole')
            ->find(Auth::id());

        /*
            checking is treasure or not
        */
        $isTrasure = false;
        foreach ($user->pengurusRole as $userRole) {
            $isTrasure = RoleIdentifierController::hasTreasure($userRole->id_user_level);

            if ($isTrasure) {
                break;
            }
        }

        if ($isTrasure) {
            return view('jenis_infaq.index');
        } else {
            return view('error.denied');
        }
    }

    public function datatable()
    {
        $data = JenisInfaq::orderBy('id', 'desc')->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(JenisInfaqRequest $request)
    {
        $nama = htmlspecialchars($request->nama);

        $insert = JenisInfaq::create([
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

        $getData = JenisInfaq::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(JenisInfaqRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];

        $update = JenisInfaq::find($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = JenisInfaq::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
