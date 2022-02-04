<?php

namespace App\Http\Controllers;

use App\Models\EspkCabang;
use App\Models\MasterCabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = EspkCabang::get();

        return view('pages.admin.cabang.index', ['cabangs' => $cabang]);
    }

    public function create()
    {
        $master_cabang = MasterCabang::get();

        return response()->json([
            'master_cabangs' => $master_cabang
        ]);
    }

    public function store(Request $request)
    {
        $cabang = new EspkCabang;
        $cabang->cabang_id = $request->cabang_id;
        $cabang->form_group = $request->form_group;
        $cabang->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $cabang = EspkCabang::find($id);
        $master_cabang = MasterCabang::get();

        return response()->json([
            'id' => $cabang->id,
            'cabang_id' => $cabang->cabang_id,
            'form_group' => $cabang->form_group,
            'master_cabangs' => $master_cabang
        ]);
    }

    public function update(Request $request, $id)
    {
        $cabang = EspkCabang::find($id);
        $cabang->cabang_id = $request->cabang_id;
        $cabang->form_group = $request->form_group;
        $cabang->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function delete(Request $request)
    {
        $cabang = EspkCabang::find($request->id);
        $cabang->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
