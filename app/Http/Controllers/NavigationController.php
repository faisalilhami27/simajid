<?php

namespace App\Http\Controllers;

use App\Http\Requests\NavigationRequest;
use App\Models\Navigation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NavigationController extends Controller
{
    public function index()
    {
        return view('navigation.index');
    }

    public function datatable()
    {
        $menu = Navigation::select("id", "title", "url", "icon", "is_main_menu", "is_aktif", "order_num")
            ->orderBy('id', 'DESC')
            ->get();
        return DataTables::of($menu)->addIndexColumn()->make(true);
    }

    public function getNavigation()
    {
        $navigation = Navigation::all();
        return response()->json($navigation);
    }

    public function store(NavigationRequest $request)
    {
        $title = htmlspecialchars(ucwords($request->title));
        $url = htmlspecialchars($request->url);
        $icon = htmlspecialchars($request->icon);
        $sub = htmlspecialchars($request->sub);
        $nomor = htmlspecialchars($request->nomor);
        $menu = $request->is_main_menu;
        $status = $request->is_aktif;

        if (empty($sub)) {
            $subMenu = 0;
        } else {
            $subMenu = $sub;
        }

        $insert = Navigation::create([
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'order_num' => $nomor,
            'order_sub' => $subMenu,
            'is_main_menu' => $menu,
            'is_aktif' => $status
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

        $getData = Navigation::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(NavigationRequest $request)
    {
        $title = htmlspecialchars(ucwords($request->title));
        $url = htmlspecialchars($request->url);
        $icon = htmlspecialchars($request->icon);
        $sub = htmlspecialchars($request->sub);
        $nomor = htmlspecialchars($request->nomor);
        $menu = $request->is_main_menu;
        $status = $request->is_aktif;
        $id = $request->id;

        $update = Navigation::find($id)->update([
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'order_num' => $nomor,
            'order_sub' => $sub,
            'is_main_menu' => $menu,
            'is_aktif' => $status
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

        $delete = Navigation::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
