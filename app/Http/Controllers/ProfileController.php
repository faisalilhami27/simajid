<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\UserPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $getUser = UserPengurus::with('pengurus')
            ->where('id', Auth::id())
            ->first();
        return view('profile.index', compact('getUser'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:60|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:60',
            'no_hp' => 'required|numeric',
            'username' => 'required|max:60|regex:/^[a-zA-Z0-9.-_ ]*$/',
        ]);

        $nama = htmlspecialchars($request->nama);
        $username = htmlspecialchars($request->username);
        $email = htmlspecialchars($request->email);
        $noHp = htmlspecialchars($request->no_hp);
        $id = Auth::id();
        $file = $request->file('images');

        if (!is_null($file)) {
            $user = UserPengurus::find($id)->first();
            $images = $user->images;

            if (is_null($images)) {

                Pengurus::where('id', $user->id_pengurus)->update([
                    'nama' => $nama,
                    'email' => $email,
                    'no_hp' => $noHp,
                    'foto' => $file->store(
                        'img', 'public'
                    )
                ]);

                $update = UserPengurus::findOrFail($id)->update([
                    'username' => $username,
                ]);
            } else {
                $pathDelete = "storage/" . $images;
                unlink($pathDelete);

                Pengurus::where('id', $user->id_pengurus)->update([
                    'nama' => $nama,
                    'email' => $email,
                    'no_hp' => $noHp,
                    'foto' => $file->store(
                        'img', 'public'
                    )
                ]);

                $update = UserPengurus::findOrFail($id)->update([
                    'username' => $username,
                ]);
            }
        } else {
            $update = Pengurus::findOrFail($id)->update([
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
            ]);
        }

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|max:12',
            'password_confirmation' => 'required|min:8|max:12',
        ]);

        $id = Auth::id();
        $password = $request->password;
        $konfirmasiPassword = $request->password_confirmation;

        if (empty($password) || empty($konfirmasiPassword)) {
            $json = ["status" => 500, "msg" => "Password dan Konfirmasi Password harus diisi"];
        } elseif ($password != $konfirmasiPassword) {
            $json = ["status" => 500, "msg" => "Password dan Konfirmasi Password harus sama"];
        } elseif (strlen($password) < 8) {
            $json = ["status" => 500, "msg" => "Password minimal 8 karakter"];
        } else {
            UserPengurus::findOrFail($id)->update([
                'password' => Hash::make($password),
            ]);
            $json = ["status" => 200, "msg" => "Password berhasil diubah"];
        }
        return response()->json($json);
    }
}
