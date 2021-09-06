<?php

namespace App\Http\Controllers;

use App\Models\EspkJenisPekerjaan;
use App\Models\EspkPekerjaan;
use App\Models\EspkPelanggan;
use App\Models\EspkTipePekerjaan;
use App\Models\MasterCabang;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaan = EspkPekerjaan::get();

        return view('pages.pekerjaan.pesanan.index', ['pesanans' => $pekerjaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan = EspkPelanggan::get();
        $pelaksana = MasterCabang::get();
        $jenis_pekerjaan = EspkJenisPekerjaan::with('tipePekerjaan')->get();
        $tipe_pekerjaan = EspkTipePekerjaan::get();

        return view('pages.pekerjaan.pesanan.create', [
            'pelanggans' => $pelanggan,
            'pelaksanas' => $pelaksana,
            'jenis_pekerjaans' => $jenis_pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan
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
        //
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
        //
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
        //
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
}
