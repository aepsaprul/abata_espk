<?php

namespace App\Http\Controllers;

use App\Models\EspkNavAccess;
use App\Models\EspkNavSub;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $nav_access = EspkNavAccess::with('masterKaryawan')
            ->select(DB::raw('count(*) as nav_access_count, user_id'))
            ->groupBy('user_id')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.admin.user.index', ['users' => $nav_access]);
    }

    public function create()
    {
        $karyawan = MasterKaryawan::with('masterCabang')
            ->where('status', 'Aktif')
            ->doesntHave('navAccess')
            ->get();

        return response()->json([
            'karyawans' => $karyawan
        ]);
    }

    public function store(Request $request)
    {
        $nav_sub = EspkNavSub::get();

        foreach ($nav_sub as $key => $item) {
            $nav_access = new EspkNavAccess;
            $nav_access->user_id = $request->karyawan_id;
            $nav_access->main_id = $item->main_id;
            $nav_access->sub_id = $item->id;
            $nav_access->tampil = "n";
            $nav_access->tambah = "n";
            $nav_access->ubah = "n";
            $nav_access->hapus = "n";
            $nav_access->save();
        }

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function delete(Request $request)
    {
        $nav_access = EspkNavAccess::where('user_id', $request->id);
        $nav_access->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function access($id)
    {
        $karyawan = MasterKaryawan::where('id', $id)->first();
        $menu = EspkNavAccess::where('user_id', $id)->get();
        $sub = EspkNavAccess::with('navMain')
            ->where('user_id', $id)
            ->select(DB::raw('count(main_id) as total'),'main_id')
            ->groupBy('main_id')
            ->get();

        $karyawan_id = $id;
        $sync = DB::table('espk_nav_subs')
            ->select('espk_nav_subs.id AS nav_sub_id', 'espk_nav_subs.title AS title', 'espk_nav_subs.main_id AS nav_main')
            ->leftJoin('espk_nav_accesses', function($join) use ($karyawan_id) {
                $join->on('espk_nav_subs.id', '=', 'espk_nav_accesses.sub_id')
                    ->where('espk_nav_accesses.user_id', '=', $karyawan_id);
            })
            ->whereNull('user_id')
            ->get();

        return view('pages.admin.user.access', [
            'karyawan' => $karyawan,
            'menus' => $menu,
            'subs' => $sub,
            'syncs' => $sync
        ]);
    }

    public function accessSave(Request $request)
    {
        $nav_access = EspkNavAccess::find($request->id);

        if ($request->show) {
            $nav_access->tampil = $request->show;
        }
        if ($request->create) {
            $nav_access->tambah = $request->create;
        }
        if ($request->edit) {
            $nav_access->ubah = $request->edit;
        }
        if ($request->delete) {
            $nav_access->hapus = $request->delete;
        }

        $nav_access->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function sync(Request $request)
    {
        $karyawan = MasterKaryawan::where('id', $request->id)->first();

        $karyawan_id = $karyawan->id;
        $sync = DB::table('espk_nav_subs')
            ->select('espk_nav_subs.id AS nav_sub_id', 'espk_nav_subs.title AS title', 'espk_nav_subs.main_id AS nav_main')
            ->leftJoin('espk_nav_accesses', function($join) use ($karyawan_id) {
                $join->on('espk_nav_subs.id', '=', 'espk_nav_accesses.sub_id')
                    ->where('espk_nav_accesses.user_id', '=', $karyawan_id);
            })
            ->whereNull('user_id')
            ->get();

        foreach ($sync as $key => $item) {
            $nav_access = new EspkNavAccess;
            $nav_access->user_id = $karyawan->id;
            $nav_access->main_id = $item->nav_main;
            $nav_access->sub_id = $item->nav_sub_id;
            $nav_access->tampil = "n";
            $nav_access->tambah = "n";
            $nav_access->ubah = "n";
            $nav_access->hapus = "n";
            $nav_access->save();
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
