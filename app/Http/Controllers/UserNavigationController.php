<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNavigationRequest;
use App\Models\Navigation;
use App\Models\RoleLevel;
use App\Models\UserNavigation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserNavigationController extends Controller
{
    public function index()
    {
        return view('user_navigation.index');
    }

    public function datatable()
    {
        $data = UserNavigation::with(['role', 'menu'])
            ->orderBy('id', 'desc')
            ->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function getLevel()
    {
        $level = RoleLevel::all();
        return response()->json($level);
    }

    public function getNavigation()
    {
        $navigation = Navigation::all();
        return response()->json($navigation);
    }

    public function store(UserNavigationRequest $request)
    {
        $idUserLevel = $request->id_user_level;
        $idMenu = $request->id_menu;
        $create = $request->create;
        $read = $request->read;
        $update = $request->update;
        $delete = $request->delete;

        $checkDuplicate = UserNavigation::where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->first();

        if (!is_null($checkDuplicate)) {
            return response()->json(['status' => 500, 'msg' => 'Data sudah ada pada sistem']);
        }

        $insert = UserNavigation::create([
            'id_user_level' => $idUserLevel,
            'id_menu' => $idMenu,
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete,
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

        $getData = UserNavigation::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(Request $request)
    {
        $create = $request->create;
        $read = $request->read;
        $update = $request->update;
        $delete = $request->delete;
        $id = $request->id;

        $update = UserNavigation::find($id)->update([
            'create' => $create,
            'read' => $read,
            'update' => $update,
            'delete' => $delete
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

        $delete = UserNavigation::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
