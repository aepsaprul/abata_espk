<?php

namespace App\Http\Controllers;

use App\Models\EspkPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = EspkPelanggan::get();

        return view('pages.data-primer.pelanggan.index', ['pelanggans' => $pelanggan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelanggan = new EspkPelanggan;
        $pelanggan->nama = $request->nama;
        $pelanggan->telp = $request->telp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->cabang_id = Auth::user()->masterKaryawan->masterCabang->id;
        $pelanggan->save();

        return response()->json([
            'data' => "Data pelanggan berhasil disimpan"
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
        $pelanggan = EspkPelanggan::find($id);

        return response()->json([
            'id' => $pelanggan->id,
            'nama' => $pelanggan->nama,
            'telp' => $pelanggan->telp,
            'alamat' => $pelanggan->alamat
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
        $pelanggan = EspkPelanggan::find($id);
        $pelanggan->nama = $request->nama;
        $pelanggan->telp = $request->telp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return response()->json([
            'data' => "Data pelanggan berhasil diperbaharui"
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

    public function deleteBtn($id)
    {
        $pelanggan = EspkPelanggan::find($id);

        return response()->json([
            'id' => $id,
            'nama' => $pelanggan->nama
        ]);
    }

    public function delete($id)
    {
        $pelanggan = EspkPelanggan::find($id);
        $pelanggan->delete();

        return response()->json([
            'data' => "Data pelanggan berhasil dihapus"
        ]);
    }
}
