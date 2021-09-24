<?php

namespace App\Http\Controllers;

use App\Models\EspkNav;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function index()
    {
        $navigasi = EspkNav::get();
        $root_nav = EspkNav::where('level_nav', 'main_nav')->get();

        return view('pages.admin.navigasi.index', ['navigasis' => $navigasi, 'root_navs' => $root_nav]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_nav' => 'required',
            'level_nav' => 'required',
            'link' => 'required'
        ]);

        $navigasi = new EspkNav;
        $navigasi->nama_nav = $request->nama_nav;
        $navigasi->level_nav = $request->level_nav;
        $navigasi->root_nav = $request->root_nav;
        $navigasi->link = $request->link;
        $navigasi->save();

        return response()->json([
            'data' => "Data berhasil disimpan"
        ]);
    }

    public function edit($id)
    {
        $navigasi = EspkNav::find($id);
        $root = EspkNav::where('level_nav', 'main_nav')->get();

        return response()->json([
            'id' => $navigasi->id,
            'nama_nav' => $navigasi->nama_nav,
            'level_nav' => $navigasi->level_nav,
            'root_nav' => $navigasi->root_nav,
            'link' => $navigasi->link,
            'roots' => $root
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_nav' => 'required',
            'level_nav' => 'required',
            'link' => 'required'
        ]);

        $navigasi = EspkNav::find($id);
        $navigasi->nama_nav = $request->nama_nav;
        $navigasi->level_nav = $request->level_nav;
        $navigasi->root_nav = $request->root_nav;
        $navigasi->link = $request->link;
        $navigasi->save();

        return response()->json([
            'data' => "Data berhasil diperbaharui"
        ]);
    }

    public function deleteBtn($id)
    {
        $navigasi = EspkNav::find($id);

        return response()->json([
            'id' => $navigasi->id,
            'nama_nav' => $navigasi->nama_nav
        ]);
    }

    public function delete($id)
    {
        $navigasi = EspkNav::find($id);
        $navigasi->delete();

        return response()->json([
            'data' => "Data berasil dihapus"
        ]);
    }
}
