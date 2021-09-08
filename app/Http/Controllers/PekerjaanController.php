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
        $cabang_cetak = MasterCabang::get();
        $cabang_finishing = MasterCabang::get();
        $jenis_pekerjaan = EspkJenisPekerjaan::with('tipePekerjaan')->get();
        $tipe_pekerjaan = EspkTipePekerjaan::get();

        return view('pages.pekerjaan.pesanan.create', [
            'pelanggans' => $pelanggan,
            'cabang_cetaks' => $cabang_cetak,
            'cabang_finishings' => $cabang_finishing,
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
        $pekerjaan = new EspkPekerjaan;
        $pekerjaan->pelanggan_id = $request->pelanggan_id;
        $pekerjaan->pegawai_penerima_pesanan_id = $request->pegawai_penerima_pesanan_id;
        $pekerjaan->pegawai_desain_id = $request->pegawai_desain_id;
        $pekerjaan->nama_pesanan = $request->nama_pesanan;
        $pekerjaan->nomor_nota = $request->nomor_nota;
        $pekerjaan->tanggal_pesanan = $request->tanggal_pesanan;
        $pekerjaan->rencana_jadi = $request->rencana_jadi;
        $pekerjaan->jenis_pesanan = $request->jenis_pesanan;
        $pekerjaan->jumlah = $request->jumlah;
        $pekerjaan->ukuran = $request->ukuran;
        $pekerjaan->jenis_kertas = $request->jenis_kertas;
        $pekerjaan->warna = $request->warna;
        $pekerjaan->keterangan = $request->keterangan;

        // if ($request->file('file')) {
        //     $file = $request->file('file')->store('file', 'public');
        //     $pekerjaan->file = $file;
        // }

        $pekerjaan->save();
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
