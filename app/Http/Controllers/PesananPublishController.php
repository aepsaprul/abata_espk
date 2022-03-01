<?php

namespace App\Http\Controllers;

use App\Models\EspkCabang;
use App\Models\EspkPekerjaan;
use App\Models\EspkStatusPekerjaan;
use App\Models\EspkTipePekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananPublishController extends Controller
{
    public function index()
    {
        if (Auth::user()->master_karyawan_id) {
            $pesanan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
                ->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)
                ->where('status_id', '!=', 6)
                ->orWhere('status_id', null)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $pesanan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
                ->where('status_id', '!=', 6)
                ->orWhere('status_id', null)
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('pages.pekerjaan.pesanan_publish.index', ['pesanans' => $pesanan]);
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

        $status_pekerjaan = EspkStatusPekerjaan::where('pekerjaan_id', $id)->get();

        $cabang = EspkCabang::where('cabang_id', $pekerjaan->cabang_cetak_id)->first();

        return view('pages.pekerjaan.pesanan_publish.show', [
            'pekerjaan' => $pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan,
            'status_pekerjaans' => $status_pekerjaan,
            'cabang' => $cabang
        ]);
    }
}
