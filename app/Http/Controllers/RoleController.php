<?php

namespace App\Http\Controllers;

use App\Models\RoleUserPengurus;
use App\Models\UserNavigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }

    public function chooseRole(Request $request)
    {
        $listAkses = null;
        $role = null;

        if (Auth::guard('pengurus')->check()) {
            $listAkses = RoleUserPengurus::where('id_pengurus', Auth::id())
                ->with(['userPengurus', 'role'])
                ->get();

            $role = RoleUserPengurus::where('id_pengurus', Auth::id())
                ->with('userPengurus')
                ->first();
        }

        /**
         * Instant pick role for only had 1 access role
         */
        if (count($listAkses) == 1) {
            $request->id_user_level = $role->id_user_level;

            return $this->pickRole($request);
        }

        return view('role.chooseRole', compact('listAkses'));
    }

    public function pickRole(Request $request)
    {
        $request->session()->forget('id_user_level');
        $request->session()->forget('navigations');
        $request->session()->forget('guard');
        $idUserLevel = $request->id_user_level; // Get Role ID

        $userNavigation = UserNavigation::with(['menu' => function ($query) {
            $query->orderBy('order_num', 'ASC');
            $query->orderBy('order_sub', 'ASC');
        }])
            ->where('id_user_level', $idUserLevel)
            ->get();

        $navigation = [];
        $i = 0;

        foreach ($userNavigation as $route) {
            $userNav = $route->menu;

            if ($userNav->is_main_menu == 0) {
                $navigation[$i] = [
                    'index' => $i,
                    'id' => $userNav->id,
                    'title' => $userNav->title,
                    'url' => $userNav->url,
                    'icon' => $userNav->icon,
                    'order_num' => $userNav->order_num,
                    'order_sub' => $userNav->order_sub,
                    'child' => [],
                    'crud' => [
                        'create' => $route->create,
                        'read' => $route->read,
                        'update' => $route->update,
                        'delete' => $route->delete
                    ]
                ];
                $i++;
            }
        }

        $j = 0;
        foreach ($userNavigation as $route) {
            $userNav = $route->menu;

            if ($userNav->is_main_menu > 0) {
                foreach ($navigation as $parent) {
                    if ($userNav->is_main_menu == $parent['id']) {
                        $navigation[$parent['index']]['child'][] = [
                            'id' => $userNav->id,
                            'title' => $userNav->title,
                            'url' => $userNav->url,
                            'icon' => $userNav->icon,
                            'order_num' => $userNav->order_num,
                            'order_sub' => $userNav->order_sub,
                            'crud' => [
                                'create' => $route->create,
                                'read' => $route->read,
                                'update' => $route->update,
                                'delete' => $route->delete
                            ]
                        ];
                    }
                }
                $j++;
            }
        }
        $orderNavigation = collect($navigation)->sortBy('order_num');

        $guard = null;
        if (Auth::guard('pengurus')->check()) {
            $guard = 'pengurus';
        }

        /**
         * Insert new menu navigations into session navigations
         */
        $request->session()->put('id_user_level', $idUserLevel);
        $request->session()->put('navigations', $orderNavigation);
        $request->session()->put('guard', $guard);

        return redirect()->route('dashboard');
    }
}
