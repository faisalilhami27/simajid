<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemasukanRequest;
use App\Models\Donatur;
use App\Models\JenisInfaq;
use App\Models\JenisPemasukan;
use App\Models\Pemasukan;
use App\Models\UserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PemasukanController extends Controller
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
            return view('pemasukan.infaq', compact('checkAccess'));
        } else {
            return view('error.denied');
        }
    }

    public function shodaqohPage()
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
            return view('pemasukan.shodaqoh', compact('checkAccess'));
        } else {
            return view('error.denied');
        }
    }

    public function datatable()
    {
        $data = Pemasukan::with(['jenisInfaq', 'jenisPemasukan'])
            ->where('id_jenis_pemasukan', 1)
            ->orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function datatable2()
    {
        $data = Pemasukan::with(['donatur'])
            ->where('id_jenis_pemasukan', 2)
            ->orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function getJenisInfaq()
    {
        $jenis = JenisInfaq::all();
        return response()->json($jenis);
    }

    public function getDonatur()
    {
        $donatur = Donatur::all();
        return response()->json($donatur);
    }

    public function store(PemasukanRequest $request)
    {
        $tanggal = $request->tanggal;
        $pengurus = Auth::user()->id_pengurus;
        $jumlah = str_replace( ',', '', $request->jumlah);
        $jenis = $request->jenis;
        $idDonatur = $request->id_donatur;
        $idJenisInfaq = $request->id_jenis_infaq;
        $keterangan = $request->keterangan;

        if ($jenis == 1) {
           $data = [
               'tanggal' => $tanggal,
               'id_pengurus' => $pengurus,
               'jumlah' => $jumlah,
               'id_jenis_infaq' => $idJenisInfaq,
               'keterangan' => $keterangan,
               'id_jenis_pemasukan' => $jenis,
           ];
        } else {
            $data = [
                'tanggal' => $tanggal,
                'id_pengurus' => $pengurus,
                'jumlah' => $jumlah,
                'id_donatur' => $idDonatur,
                'keterangan' => $keterangan,
                'id_jenis_pemasukan' => $jenis,
            ];
        }

        $insert = Pemasukan::create($data);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = Pemasukan::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(PemasukanRequest $request)
    {
        $tanggal = $request->tanggal;
        $pengubah = Auth::user()->id_pengurus;
        $jumlah = $request->jumlah;
        $jenis = $request->id_jenis;
        $keterangan = $request->keterangan;
        $id = $request->id;

        $update = Pemasukan::find($id)->update([
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

        $delete = Pemasukan::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
