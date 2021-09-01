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
        $menu_utama = EspkMenuUtama::get();
        $menu_sub = EspkMenuSub::get();
        $menu_btn = EspkMenuButton::get();

        return view('pages.menu.index', ['menu_utamas' => $menu_utama, 'menu_subs' => $menu_sub, 'menu_btns' => $menu_btn]);
    }

    public function store(Request $request)
    {
        if ($request->button == "menu_utama_btn_store") {

            $menu_utama = new EspkMenuUtama;
            $menu_utama->nama_menu = $request->nama_menu;
            $menu_utama->link = $request->link;
            $menu_utama->save();

        } else {
            $data = "kosong";
        }

        return response()->json([
            'data' => "sukses"
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

    public function update(Request $request)
    {
        if ($request->button == "menu_utama_btn_update") {
            $menu_utama = EspkMenuUtama::where('id', $request->id)->first();
            $menu_utama->nama_menu = $request->nama_menu;
            $menu_utama->link = $request->link;
            $menu_utama->save();
        } else {
            $data = "kosong";
        }

        return response()->json([
            'data' => 'sukses'
        ]);
    }

    public function deleteBtn(Request $request)
    {
        if ($request->button == "menu_utama_btn_delete") {
            $menu_utama = EspkMenuUtama::where('id', $request->id)->first();
            $value = $menu_utama->nama_menu;
        } else {
            $value = "";
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

            $notif = "menu_utama";
        } else {
            $notif = "kosong";
        }

        return response()->json([
            'notif' => $notif
        ]);
    }
}
