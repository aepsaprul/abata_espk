<?php

namespace App\Http\Controllers;

use App\Models\EspkCabang;
use App\Models\EspkPekerjaan;
use App\Models\EspkPekerjaanProses;
use App\Models\EspkStatusPekerjaan;
use App\Models\EspkTipePekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProsesPekerjaanController extends Controller
{
    public function index()
    {
        if (Auth::user()->master_karyawan_id) {
            $pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
            ->where('cabang_pelaksana_id', Auth::user()->masterKaryawan->masterCabang->id)
            ->whereNotNull('status_id')
            ->whereNotIn('status_id', [2,8,9])
            ->orderBy('id', 'desc')
            ->get();

            $pesanan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
            ->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)
            ->orderBy('id', 'desc')
            ->get();

            return view('pages.pekerjaan.proses_pekerjaan.index', ['pekerjaans' => $pekerjaan, 'pesanans' => $pesanan]);
        } else {
            return view('error404');
        }

    }

    public function editStatus($id)
    {
        $pekerjaan = EspkPekerjaan::find($id);
        return response()->json([
            'pekerjaan' => $pekerjaan
        ]);
    }

    public function updateStatus(Request $request)
    {
        $pekerjaan = EspkPekerjaan::where('id', $request->id)->first();

        if ($request->status_id == 1) {
            $pekerjaan->tanggal_disetujui = date('Y-m-d H:i:s');
        }

        if ($request->status_id == 6) {
            $pekerjaan->tanggal_selesai = date('Y-m-d H:i:s');
        }

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

        $status_pekerjaan = EspkStatusPekerjaan::where('pekerjaan_id', $id)->get();

        $cabang = EspkCabang::where('cabang_id', $pekerjaan->cabang_cetak_id)->first();

        return view('pages.pekerjaan.proses_pekerjaan.show', [
            'pekerjaan' => $pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan,
            'status_pekerjaans' => $status_pekerjaan,
            'cabang' => $cabang
        ]);
    }

    public function print($id)
    {
        $pekerjaan = EspkPekerjaan::find($id);
        $proses_pekerjaan = EspkPekerjaanProses::where('pekerjaan_id', $pekerjaan->id)->get();
        $tipe_pekerjaan = EspkTipePekerjaan::with([
            'jenisPekerjaan',
            'jenisPekerjaan.pekerjaanProses' => function($query) use ($id) {
                $query->where('pekerjaan_id', $id);
            }
        ])->get();

        return view('pages.pekerjaan.proses_pekerjaan.print', [
            'pekerjaan' => $pekerjaan,
            'proses_pekerjaans' => $proses_pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan
        ]);
    }
}
