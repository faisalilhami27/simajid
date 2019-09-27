<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengurusRequest;
use App\Models\Jabatan;
use App\Models\JenisPengurus;
use App\Models\Pengurus;
use App\Models\UserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PengurusController extends Controller
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
            return view('pengurus.dkm');
        } else {
            return view('error.denied');
        }
    }

    public function majelisPage()
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
            return view('pengurus.majelis');
        } else {
            return view('error.denied');
        }
    }

    public function remajaPage()
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
            return view('pengurus.remaja');
        } else {
            return view('error.denied');
        }
    }

    public function datatable1()
    {
        $data = Pengurus::where('id_pengurus', 1)
            ->where('id', '!=', 1)
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function datatable2()
    {
        $data = Pengurus::where('id_pengurus', 2)
            ->where('id', '!=', 1)
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function datatable3()
    {
        $data = Pengurus::where('id_pengurus', 3)
            ->where('id', '!=', 1)
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function getJabatan()
    {
        $jabatan = Jabatan::all();
        return response()->json($jabatan);
    }

    public function store(PengurusRequest $request)
    {
        $nama = htmlspecialchars($request->nama);
        $email = htmlspecialchars($request->email);
        $noHp = htmlspecialchars($request->no_hp);
        $status = $request->status;
        $idPengurus = $request->id_pengurus;
        $idJabatan = $request->id_jabatan;

        $insert = Pengurus::create([
            'nama' => $nama,
            'email' => $email,
            'no_hp' => $noHp,
            'status' => $status,
            'id_pengurus' => $idPengurus,
            'id_jabatan' => $idJabatan,
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
        $cekUsername = Pengurus::where('email', $email)->first();
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
        $cekUsername = Pengurus::where('no_hp', $noHp)->first();
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
