<?php

namespace App\Http\Controllers;

use App\Models\EspkPekerjaan;
use App\Models\EspkStatusPekerjaan;
use App\Models\EspkTipePekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProsesPekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
        ->where('cabang_pelaksana_id', Auth::user()->masterKaryawan->masterCabang->id)
        ->whereNotNull('status_id')
        ->get();

        $pesanan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
        ->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)
        ->get();

        return view('pages.pekerjaan.proses_pekerjaan.index', ['pekerjaans' => $pekerjaan, 'pesanans' => $pesanan]);
    }

    public function updatePesanan(Request $request)
    {
        $pekerjaan = EspkPekerjaan::where('id', $request->id)->first();
        $pekerjaan->status_id = $request->status_id;
        $pekerjaan->save();

        $status_pekerjaan = new EspkStatusPekerjaan;
        $status_pekerjaan->pekerjaan_id = $request->id;
        $status_pekerjaan->status_id = $request->status_id;
        $status_pekerjaan->pegawai_id = Auth::user()->masterKaryawan->id;
        $status_pekerjaan->waktu = date('Y-m-d H:i:s');
        $status_pekerjaan->status_keterangan = $request->keterangan;
        $status_pekerjaan->save();

        return response()->json([
            'response' => 'sukses'
        ]);
    }

    public function show($id)
    {
        $pekerjaan = EspkPekerjaan::find($id);
        $tipe_pekerjaan = EspkTipePekerjaan::with([
            'jenisPekerjaan',
            'jenisPekerjaan.pekerjaanProses' => function($query) use ($id) {
                $query->where('pekerjaan_id', $id);
            }
        ])->get();

        return view('pages.pekerjaan.proses_pekerjaan.show', ['pekerjaan' => $pekerjaan, 'tipe_pekerjaans' => $tipe_pekerjaan]);
    }
}
