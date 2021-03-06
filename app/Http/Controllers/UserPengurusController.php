<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPengurusRequest;
use App\Models\Konfigurasi;
use App\Models\Pengurus;
use App\Models\RoleLevel;
use App\Models\RoleUserPengurus;
use App\Models\UserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserPengurusController extends Controller
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
            return view('user_pengurus.index');
        } else {
            return view('error.denied');
        }
    }

    public function datatable()
    {
        $userPengurus = UserPengurus::with(['pengurus', 'pengurusRole.role'])->get();
        return DataTables::of($userPengurus)->addIndexColumn()->make(true);
    }

    public function store(UserPengurusRequest $request)
    {
        $pengurus = $request->pengurus;
        $username = htmlspecialchars($request->username);
        $password = Hash::make(htmlspecialchars($request->password));
        $level = @explode(',', $request->level);
        $status = $request->status;

        $cekUser = UserPengurus::where('id_pengurus', $pengurus)->first();

        if ($cekUser['id_pengurus'] == $pengurus) {
            return response()->json(['status' => 500, 'msg' => 'Akun sudah ada pada sistem']);
        }

        foreach ($level as $item) {
            RoleUserPengurus::create([
                'id_pengurus' => $pengurus,
                'id_user_level' => $item
            ]);
        }

        $insert = UserPengurus::create([
            'username' => $username,
            'id_pengurus' => $pengurus,
            'password' => $password,
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
        $level = RoleUserPengurus::with(['userPengurus' => function ($query) use($id) {
        }])
            ->where('id_pengurus', $id)
            ->get();
        $user = UserPengurus::findOrFail($id);
        $item = [];
        $i = 0;
        foreach ($level as $d) {
            $item[$i] = $d->id_user_level;
            $i++;
        }

        if ($level) {
            return response()->json(['status' => 200, 'item' => $item, 'user' => $user]);
        } else {
            return response()->json(['status' => 500, 'msg' => "Data tidak ditemukan"]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'level' => 'required',
            'status' => 'required'
        ]);

        $status = $request->status;
        $level = @explode(',', $request->level);
        $id = $request->id;

        $update = UserPengurus::findOrFail($id);

        RoleUserPengurus::where('id_pengurus', $update->id)->delete();

        foreach ($level as $item) {
            RoleUserPengurus::create([
                'id_pengurus' => $update->id,
                'id_user_level' => $item
            ]);
        }

        $update->update([
            'status' => $status
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

        $delete = UserPengurus::findOrFail($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }

    public function resetPassword(Request $request)
    {
        $id = $request->id;
        $konfigurasi = Konfigurasi::get();

        $password = Hash::make($konfigurasi[4]->nilai_konfig);

        $data = [
            'password' => $password
        ];

        $reset = UserPengurus::findOrFail($id)->update($data);

        if ($reset) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil direset']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal direset']);
        }
    }

    public function cekUsername(Request $request)
    {
        $username = $request->username;
        $cekUsername = UserPengurus::where('username', $username)->get();
        $getUsername = $cekUsername->count();

        if ($getUsername == 1) {
            return response()->json(['status' => 500, 'msg' => 'username has been used']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'username available']);
        }
    }

    public function getLevel()
    {
        $level = RoleLevel::all();
        return response()->json(['status' => 200, 'list' => $level]);
    }

    public function getPengurus()
    {
        $pengurus = Pengurus::all();
        return response()->json(['status' => 200, 'list' => $pengurus]);
    }
}
