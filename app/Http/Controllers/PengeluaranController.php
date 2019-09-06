<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengeluaranRequest;
use App\Models\JenisPengeluaran;
use App\Models\Pengeluaran;
use App\Models\UserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PengeluaranController extends Controller
{
    public function index()
    {
        $user = UserPengurus::with('pengurusRole')
            ->find(Auth::id());
        $checkAccess = json_encode(checkAccess());

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

        /*
            checking is Head or not
        */
        $isHead = false;
        foreach ($user->pengurusRole as $userRole) {
            $isHead = RoleIdentifierController::hasHead($userRole->id_user_level);

            if ($isHead) {
                break;
            }
        }

        /*
            checking is Vice Chairman or not
        */
        $isViceChairman = false;
        foreach ($user->pengurusRole as $userRole) {
            $isViceChairman = RoleIdentifierController::hasViceChairman($userRole->id_user_level);

            if ($isViceChairman) {
                break;
            }
        }

        if ($isTrasure OR $isHead OR $isViceChairman) {
            return view('pengeluaran.index', compact('checkAccess'));
        } else {
            return view('error.denied');
        }
    }

    public function datatable()
    {
        $data = Pengeluaran::with(['jenis'])
            ->orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function getJenisPengeluaran()
    {
        $jenis = JenisPengeluaran::all();
        return response()->json($jenis);
    }

    public function store(PengeluaranRequest $request)
    {
        $tanggal = $request->tanggal;
        $pengurus = Auth::user()->id_pengurus;
        $jumlah = str_replace( ',', '', $request->jumlah);
        $jenis = $request->id_jenis;
        $keterangan = $request->keterangan;

        $data = [
            'tanggal' => $tanggal,
            'id_pengurus' => $pengurus,
            'jumlah' => $jumlah,
            'keterangan' => $keterangan,
            'id_jenis' => $jenis,
        ];

        $insert = Pengeluaran::create($data);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = Pengeluaran::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(PengeluaranRequest $request)
    {
        $tanggal = $request->tanggal;
        $pengubah = Auth::user()->id_pengurus;
        $jumlah = $request->jumlah;
        $jenis = $request->id_jenis;
        $keterangan = $request->keterangan;
        $id = $request->id;

        $update = Pengeluaran::find($id)->update([
            'tanggal' => $tanggal,
            'id_pengubah' => $pengubah,
            'jumlah' => $jumlah,
            'id_jenis' => $jenis,
            'keterangan' => $keterangan
        ]);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = Pengeluaran::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
