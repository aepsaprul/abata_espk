<?php

namespace App\Http\Controllers;

use App\Models\EspkJenisPekerjaan;
use App\Models\EspkTipePekerjaan;
use Illuminate\Http\Request;

class JenisPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipe = EspkTipePekerjaan::get();
        $jenis = EspkJenisPekerjaan::with('tipePekerjaan')->orderBy('id', 'desc')->get();

        return view('pages.data-primer.jenis_pekerjaan.index', ['tipes' => $tipe, 'jenis' => $jenis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipe = EspkTipePekerjaan::get();

        return response()->json([
            'tipes' => $tipe
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->button == "tipe_btn_store") {
            $tipe = new EspkTipePekerjaan;
            $tipe->tipe = $request->tipe;
            $tipe->save();

            $response = "Tipe pekerjaan berhasil ditambah";
        } elseif ($request->button == "jenis_btn_store") {
            $jenis = new EspkJenisPekerjaan();
            $jenis->jenis = $request->jenis;
            $jenis->tipe_pekerjaan_id = $request->tipe_pekerjaan_id;
            $jenis->cetak = json_encode($request->cetak);
            $jenis->save();

            $response = "Jenis pekerjaan berhasil ditambah";
        } else {
            $response = "kosong";
        }

        return response()->json([
            'data' => $response
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipe = EspkTipePekerjaan::find($id);

        return response()->json([
            'tipe' => $tipe->tipe,
            'id' => $id
        ]);
    }

    public function editJenis($id)
    {
        $jenis = EspkJenisPekerjaan::find($id);
        $tipe = EspkTipePekerjaan::get();

        return response()->json([
            'id' => $id,
            'jenis' => $jenis->jenis,
            'tipe_pekerjaan_id' => $jenis->tipe_pekerjaan_id,
            'cetak' => $jenis->cetak,
            'tipes' => $tipe
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->button == "tipe_btn_update") {
            $tipe = EspkTipePekerjaan::find($id);
            $tipe->tipe = $request->tipe;
            $tipe->save();

            $response = "Tipe pekerjaan berhasil diperbaharui";
        } elseif ($request->button == "jenis_btn_update") {
            $jenis = EspkJenisPekerjaan::find($id);
            $jenis->jenis = $request->jenis;
            $jenis->tipe_pekerjaan_id = $request->tipe_pekerjaan_id;
            $jenis->cetak = json_encode($request->cetak);
            $jenis->save();

            $response = "Jenis pekerjaan berhasil diperbaharui";
        }

        return response()->json([
            'response' => $response
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteBtn(Request $request)
    {
        if ($request->button == "tipe_btn_delete") {
            $tipe = EspkTipePekerjaan::where('id', $request->id)->first();
            $value = $tipe->tipe;
        } elseif ($request->button == "jenis_btn_delete") {
            $jenis = EspkJenisPekerjaan::where('id', $request->id)->first();
            $value = $jenis->jenis;
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
        if ($request->button == "tipe_btn_delete") {
            $tipe = EspkTipePekerjaan::where('id', $request->id)->first();
            $tipe->delete();

            $response = "Tipe pekerjaan berhasil dihapus";
        } elseif ($request->button == "jenis_btn_delete") {
            $jenis = EspkJenisPekerjaan::where('id', $request->id)->first();
            $jenis->delete();

            $response = "Jenis pekerjaan berhasil dihapus";
        } else {
            $response = "kosong";
        }

        return response()->json([
            'data' => $response
        ]);
    }
}
