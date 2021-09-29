<?php

namespace App\Http\Controllers;

use App\Models\EspkKaryawanMenuSub;
use App\Models\EspkKaryawanMenuUtama;
use App\Models\EspkMenuUtama;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = MasterKaryawan::get();

        return view('pages.admin.karyawan.index', ['karyawans' => $karyawan]);
    }

    public function akses($id)
    {
        $karyawan = MasterKaryawan::find($id);
        // menu utama
        $karyawanMenuUtama = EspkKaryawanMenuUtama::where('karyawan_id', $id)->get();
        $menu_utama = EspkMenuUtama::get();

        // menu sub
        $karyawanMenuSub = EspkKaryawanMenuSub::where('karyawan_id', $id)->get();
        $menu_sub = EspkMenuUtama::get();

        return view('pages.admin.karyawan.akses', [
            'karyawan' => $karyawan,
            'menu_utamas' => $menu_utama,
            'karyawan_menu_utamas' => $karyawanMenuUtama,
            'menu_subs' => $menu_sub,
            'karyawan_menu_subs' => $karyawanMenuSub
        ]);
    }

    public function aksesSimpan(Request $request, $id)
    {
        // dd($request);

        // menu utama
        $karyawanMenuUtama = EspkKaryawanMenuUtama::where('karyawan_id', $id)->get();

        if (count($karyawanMenuUtama) == 0) {

            foreach ($request->menu_utama as $key => $menu) {
                $karyawanMenuUtamaCreate = new EspkKaryawanMenuUtama;
                $karyawanMenuUtamaCreate->karyawan_id = $id;
                $karyawanMenuUtamaCreate->menu_utama_id = $menu;
                $karyawanMenuUtamaCreate->save();
            }
        } else {
            $karyawanMenuUtamaHapus = EspkKaryawanMenuUtama::where('karyawan_id', $request->id);
            $karyawanMenuUtamaHapus->delete();

            foreach ($request->menu_utama as $key => $menu) {
                $karyawanMenuUtamaCreate = new EspkKaryawanMenuUtama;
                $karyawanMenuUtamaCreate->karyawan_id = $id;
                $karyawanMenuUtamaCreate->menu_utama_id = $menu;
                $karyawanMenuUtamaCreate->save();
            }
        }

        // menu sub
        $karyawanMenuSub = EspkKaryawanMenuSub::where('karyawan_id', $id)->get();

        if (count($karyawanMenuSub) == 0) {

            foreach ($request->menu_sub as $key => $menu) {
                $karyawanMenuSubCreate = new EspkKaryawanMenuSub;
                $karyawanMenuSubCreate->karyawan_id = $id;
                $karyawanMenuSubCreate->menu_sub_id = $menu;
                $karyawanMenuSubCreate->save();
            }
        } else {
            $karyawanMenuSubHapus = EspkKaryawanMenuSub::where('karyawan_id', $request->id);
            $karyawanMenuSubHapus->delete();

            foreach ($request->menu_sub as $key => $menu) {
                $karyawanMenuSubCreate = new EspkKaryawanMenuSub;
                $karyawanMenuSubCreate->karyawan_id = $id;
                $karyawanMenuSubCreate->menu_sub_id = $menu;
                $karyawanMenuSubCreate->save();
            }
        }

        return redirect()->route('karyawan.akses', [$id]);
    }
}
