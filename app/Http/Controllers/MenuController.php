<?php

namespace App\Http\Controllers;

use App\Models\EspkMenuButton;
use App\Models\EspkMenuSub;
use App\Models\EspkMenuUtama;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu_utama = EspkMenuUtama::orderBy('nama_menu', 'asc')->get();
        $menu_sub = EspkMenuSub::with('menuUtama')->get();
        $menu_btn = EspkMenuButton::get();

        return view('pages.menu.index', ['menu_utamas' => $menu_utama, 'menu_subs' => $menu_sub, 'menu_btns' => $menu_btn]);
    }

    public function createMenuSub()
    {
        $menu_utama = EspkMenuUtama::get();

        return response()->json([
            'menu_utama' => $menu_utama
        ]);
    }

    public function store(Request $request)
    {
        if ($request->button == "menu_utama_btn_store") {

            $menu_utama = new EspkMenuUtama;
            $menu_utama->nama_menu = $request->nama_menu;
            $menu_utama->link = $request->link;
            $menu_utama->save();

            $response = "Menu utama berhasil ditambah";

        } if ($request->button == "menu_sub_btn_store") {

            $menu_sub = new EspkMenuSub;
            $menu_sub->nama_menu = $request->nama_menu;
            $menu_sub->link = $request->link;
            $menu_sub->menu_utama_id = $request->menu_utama_id;
            $menu_sub->save();

            $response = "Menu sub berhasil ditambah";

        } else {
            $response = "kosong";
        }

        return response()->json([
            'data' => $response
        ]);
    }

    public function editMenuUtama(Request $request)
    {
        $menu_utama = EspkMenuUtama::where('id', $request->id)->first();

        return response()->json([
            'id' => $menu_utama->id,
            'nama_menu' => $menu_utama->nama_menu,
            'link' => $menu_utama->link
        ]);
    }

    public function editMenuSub(Request $request)
    {
        $menu_sub = EspkMenuSub::where('id', $request->id)->first();
        $menu_utama = EspkMenuUtama::get();

        return response()->json([
            'id' => $menu_sub->id,
            'nama_menu' => $menu_sub->nama_menu,
            'link' => $menu_sub->link,
            'menu_utama_id' => $menu_sub->menu_utama_id,
            'menu_utama' => $menu_utama
        ]);
    }

    public function update(Request $request)
    {
        if ($request->button == "menu_utama_btn_update") {

            $menu_utama = EspkMenuUtama::where('id', $request->id)->first();
            $menu_utama->nama_menu = $request->nama_menu;
            $menu_utama->link = $request->link;
            $menu_utama->save();

            $response = "Menu utama berhasil diperbaharui";

        } if ($request->button == "menu_sub_btn_update") {

            $menu_sub = EspkMenuSub::where('id', $request->id)->first();
            $menu_sub->nama_menu = $request->nama_menu;
            $menu_sub->link = $request->link;
            $menu_sub->menu_utama_id = $request->menu_utama_id;
            $menu_sub->save();

            $response = "Menu sub berhasil diperbaharui";

        } else {
            $response = "kosong";
        }

        return response()->json([
            'data' => $response
        ]);
    }

    public function deleteBtn(Request $request)
    {
        if ($request->button == "menu_utama_btn_delete") {

            $menu_utama = EspkMenuUtama::where('id', $request->id)->first();
            $value = $menu_utama->nama_menu;

        } if ($request->button == "menu_sub_btn_delete") {

            $menu_sub = EspkMenuSub::where('id', $request->id)->first();
            $value = $menu_sub->nama_menu;

        } else {
            $value = "kosong";
        }

        return response()->json([
            'id' => $request->id,
            'value' => $value
        ]);
    }

    public function delete(Request $request)
    {
        if ($request->button == "menu_utama_btn_delete") {

            $menu_utama = EspkMenuUtama::where('id', $request->id)->first();
            $menu_utama->delete();

            $response = "Menu utama berhasil dihapus";

        } if ($request->button == "menu_sub_btn_delete") {

            $menu_sub = EspkMenuSub::where('id', $request->id)->first();
            $menu_sub->delete();

            $response = "Menu sub berhasil dihapus";
        } else {

            $response = "kosong";

        }

        return response()->json([
            'data' => $response
        ]);
    }
}
