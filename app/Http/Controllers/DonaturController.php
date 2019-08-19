<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonaturRequest;
use App\Models\Donatur;
use App\Models\JenisDonatur;
use App\Models\UserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DonaturController extends Controller
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

        /*
            checking is administrator or not
        */
        $isAdministrator = false;
        foreach ($user->pengurusRole as $userRole) {
            $isAdministrator = RoleIdentifierController::hasAdministrator($userRole->id_user_level);

            if ($isAdministrator) {
                break;
            }
        }

        /*
            checking is head or not
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

        if ($isTrasure OR $isAdministrator OR $isHead OR $isViceChairman) {
            return view('donatur.index', compact('isAdministrator'));
        } else {
            return view('error.denied');
        }
    }

    public function datatable()
    {
        $data = Donatur::with('jenis')
            ->where('id', '!=', 1)
            ->orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(DonaturRequest $request)
    {
        $nama = htmlspecialchars($request->nama);
        $jenis = htmlspecialchars($request->id_jenis);
        $tempatLahir = htmlspecialchars($request->tempat_lahir);
        $tanggalLahir = htmlspecialchars($request->tanggal_lahir);
        $noHp = htmlspecialchars($request->no_hp);
        $jk = htmlspecialchars($request->jenis_kelamin);
        $alamat = htmlspecialchars($request->alamat);

        $insert = Donatur::create([
            'nama' => $nama,
            'id_jenis' => $jenis,
            'tempat_lahir' => $tempatLahir,
            'tanggal_lahir' => $tanggalLahir,
            'no_hp' => $noHp,
            'jenis_kelamin' => $jk,
            'alamat' => $alamat,
        ]);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function getJenisDonatur()
    {
        $jenis = JenisDonatur::all();
        return response()->json($jenis);
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = Donatur::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(DonaturRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];

        $update = Donatur::find($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = Donatur::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
