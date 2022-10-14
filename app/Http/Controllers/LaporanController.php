<?php

namespace App\Http\Controllers;

use App\Models\EspkCabang;
use App\Models\EspkPekerjaan;
use App\Models\EspkPelanggan;
use App\Models\EspkStatus;
use App\Models\EspkStatusPekerjaan;
use App\Models\EspkTipePekerjaan;
use App\Models\MasterCabang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    public function indexPekerjaan()
    {
      $pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')->orderBy('id', 'desc')->limit(500)->get();
      $pelanggan = EspkPelanggan::get();
      $cabang = EspkCabang::get();
      $status = EspkStatus::get();

      return view('pages.laporan.pekerjaan.index', [
        'pekerjaans' => $pekerjaan,
        'pelanggans' => $pelanggan,
        'cabangs' => $cabang,
        'status' => $status
      ]);
    }

    public function search(Request $request)
    {
        $pekerjaan = EspkPekerjaan::with(['pelanggan', 'cabangPemesan', 'cabangPelaksana', 'status', 'pegawaiPenerimaPesanan'])
            ->whereBetween('tanggal_pesanan', [$request->get('tanggal_awal'), $request->get('tanggal_akhir')])->newQuery();
        if ($request->pelanggan_id != '') {
            $pekerjaan = $pekerjaan->where('pelanggan_id', $request->pelanggan_id);
        }
        if ($request->nama_pesanan != '') {
            $pekerjaan = $pekerjaan->where('nama_pesanan', $request->nama_pesanan);
        }
        if ($request->cabang_pemesan_id != '') {
            $pekerjaan = $pekerjaan->where('cabang_pemesan_id', $request->cabang_pemesan_id);
        }
        if ($request->cabang_pelaksana_id != '') {
            $pekerjaan = $pekerjaan->where('cabang_pelaksana_id', $request->cabang_pelaksana_id);
        }
        if ($request->status_id != '') {
            $pekerjaan = $pekerjaan->where('status_id', $request->status_id);
        }
        $pekerjaan = $pekerjaan->get();

        return response()->json([
            'pekerjaans' => $pekerjaan
        ]);
    }

    public function show($id)
    {
        $pekerjaan = EspkPekerjaan::with([
                'pegawaiDesain',
                'pegawaiPenerimaPesanan',
                'pelanggan',
                'cabangCetak',
                'cabangFinishing'
            ])
            ->find($id);

        $tipe_pekerjaan = EspkTipePekerjaan::with([
            'jenisPekerjaan',
            'jenisPekerjaan.pekerjaanProses' => function($query) use ($id) {
                $query->where('pekerjaan_id', $id);
            }
        ])->get();

        $status_pekerjaan = EspkStatusPekerjaan::with(['status', 'pelaksana'])->where('pekerjaan_id', $id)->get();

        $cabang = EspkCabang::where('cabang_id', $pekerjaan->cabang_cetak_id)->first();

        return response()->json([
            'pekerjaan' => $pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan,
            'status_pekerjaans' => $status_pekerjaan,
            'cabang' => $cabang
        ]);
    }
}
