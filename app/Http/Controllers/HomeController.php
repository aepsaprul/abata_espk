<?php

namespace App\Http\Controllers;

use App\Models\EspkCabang;
use App\Models\EspkPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // // pesanan hari ini
        // $pesanan = EspkPekerjaan::where('tanggal_pesanan', date('Y-m-d'))->newQuery();
        // // pesanan sedang diproses
        // $pesanan_proses = EspkPekerjaan::whereIn('status_id', [3,4,5])->newQuery();
        // // pesanan menunggu disetujui
        // $pesanan_menunggu_disetujui = EspkPekerjaan::where('status_id', 9)->newQuery();
        // // pesanan selesai bulan ini
        // $pesanan_selesai = EspkPekerjaan::where('status_id', 6)
        //     ->whereYear('tanggal_pesanan', date('Y'))
        //     ->whereMonth('tanggal_pesanan', date('m'))
        //     ->newQuery();

        // if (Auth::user()->masterKaryawan && Auth::user()->masterKaryawan->master_cabang_id != 1) {
        //     $pesanan = $pesanan->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        //     $pesanan_proses = $pesanan_proses->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        //     $pesanan_menunggu_disetujui = $pesanan_menunggu_disetujui->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        //     $pesanan_selesai = $pesanan_selesai->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        //     $pekerjaan = EspkPekerjaan::where('cabang_pemesan_id', Auth::user()->masterKaryawan->master_cabang_id)->whereIn('status_id', [2,6,7])->orderBy('id', 'desc')->limit(500)->get();
        //     $pesanan_batal = EspkPekerjaan::where('cabang_pemesan_id', Auth::user()->masterKaryawan->master_cabang_id)->whereIn('status_id', [2,7])->orderBy('id', 'desc')->limit(500)->get();
        //     $data_pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
        //         ->where('cabang_pelaksana_id', Auth::user()->masterKaryawan->masterCabang->id)
        //         ->whereNotNull('status_id')
        //         ->whereNotIn('status_id', [2,6,8,9])
        //         ->orderBy('id', 'desc')
        //         ->get();
        // } else {
        //     $pesanan_hari_ini = $pesanan->get();
        //     $pesanan_proses = $pesanan_proses->get();
        //     $pesanan_menunggu_disetujui = $pesanan_menunggu_disetujui->get();
        //     $pesanan_selesai = $pesanan_selesai->get();
        //     $pekerjaan = EspkPekerjaan::whereIn('status_id', [2,6,7])->orderBy('id', 'desc')->limit(500)->get();
        //     $pesanan_batal = EspkPekerjaan::whereIn('status_id', [2,7])->orderBy('id', 'desc')->limit(500)->get();
        //     $data_pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
        //         ->whereNotNull('status_id')
        //         ->whereNotIn('status_id', [2,6,8,9])
        //         ->orderBy('id', 'desc')
        //         ->get();
        // }

        // pesanan hari ini
        $pesanan = EspkPekerjaan::where('tanggal_pesanan', date('Y-m-d'))->newQuery();
        if (Auth::user()->masterKaryawan && Auth::user()->masterKaryawan->master_cabang_id != 1) {
            $pesanan = $pesanan->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_hari_ini = $pesanan->get();

        // pesanan sedang diproses
        $pesanan_proses = EspkPekerjaan::whereIn('status_id', [3,4,5])->newQuery();
        if (Auth::user()->masterKaryawan && Auth::user()->masterKaryawan->master_cabang_id != 1) {
            $pesanan_proses = $pesanan_proses->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_proses = $pesanan_proses->get();

        // pesanan menunggu disetujui
        $pesanan_menunggu_disetujui = EspkPekerjaan::where('status_id', 9)->newQuery();
        if (Auth::user()->masterKaryawan && Auth::user()->masterKaryawan->master_cabang_id != 1) {
            $pesanan_menunggu_disetujui = $pesanan_menunggu_disetujui->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_menunggu_disetujui = $pesanan_menunggu_disetujui->get();

        // pesanan selesai bulan ini
        $pesanan_selesai = EspkPekerjaan::where('status_id', 6)
            ->whereYear('tanggal_pesanan', date('Y'))
            ->whereMonth('tanggal_pesanan', date('m'))
            ->newQuery();
        if (Auth::user()->masterKaryawan && Auth::user()->masterKaryawan->master_cabang_id != 1) {
            $pesanan_selesai = $pesanan_selesai->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_selesai = $pesanan_selesai->get();

        if (Auth::user()->master_karyawan_id) {
            $pekerjaan = EspkPekerjaan::where('cabang_pemesan_id', Auth::user()->masterKaryawan->master_cabang_id)->whereIn('status_id', [2,6,7])->orderBy('id', 'desc')->limit(500)->get();
        } else {
            $pekerjaan = EspkPekerjaan::whereIn('status_id', [2,6,7])->orderBy('id', 'desc')->limit(500)->get();
        }

        if (Auth::user()->master_karyawan_id && Auth::user()->masterKaryawan->master_cabang_id != 1) {
            $pesanan_batal = EspkPekerjaan::where('cabang_pemesan_id', Auth::user()->masterKaryawan->master_cabang_id)->whereIn('status_id', [2,7])->orderBy('id', 'desc')->limit(500)->get();
        } else {
            $pesanan_batal = EspkPekerjaan::whereIn('status_id', [2,7])->orderBy('id', 'desc')->limit(500)->get();
        }

        if (Auth::user()->master_karyawan_id) {
            $data_pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
                ->where('cabang_pelaksana_id', Auth::user()->masterKaryawan->masterCabang->id)
                ->whereNotNull('status_id')
                ->whereNotIn('status_id', [2,6,8,9])
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $data_pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
                ->whereNotNull('status_id')
                ->whereNotIn('status_id', [2,6,8,9])
                ->orderBy('id', 'desc')
                ->get();
        }

        $jumlah_pesanan_hari_ini = count($pesanan_hari_ini);
        $jumlan_pesanan_proses = count($pesanan_proses);
        $jumlan_pesanan_menunggu_disetujui = count($pesanan_menunggu_disetujui);
        $jumlan_pesanan_selesai = count($pesanan_selesai);
        $jumlan_pesanan_batal = count($pesanan_batal);
        $jumlan_data_pekerjaan = count($data_pekerjaan);

        return view('home', [
            'jumlah_pesanan_hari_ini' => $jumlah_pesanan_hari_ini,
            'jumlah_pesanan_proses' => $jumlan_pesanan_proses,
            'jumlah_pesanan_menunggu_disetujui' => $jumlan_pesanan_menunggu_disetujui,
            'jumlah_pesanan_selesai' => $jumlan_pesanan_selesai,
            'jumlah_pesanan_batal' => $jumlan_pesanan_batal,
            'jumlah_data_pekerjaan' => $jumlan_data_pekerjaan,
            'pekerjaans' => $pekerjaan,
            'pesanan_hari_ini' => $pesanan_hari_ini,
            'pesanan_proses' => $pesanan_proses,
            'pesanan_menunggu_disetujui' => $pesanan_menunggu_disetujui,
            'pesanan_selesai' => $pesanan_selesai,
            'pesanan_batal' => $pesanan_batal,
            'data_pekerjaan' => $data_pekerjaan
        ]);
    }

    public function selengkapnya($value)
    {
        if (Auth::user()->master_karyawan_id) {
            $pesanan = EspkPekerjaan::where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)->newQuery();

            if ($value == "pesanan_hari_ini") {
                $pesanan = $pesanan->where('tanggal_pesanan', date('Y-m-d'));
            }
            if ($value == "sedang_diproses") {
                $pesanan = $pesanan->whereIn('status_id', [3,4,5]);
            }
            if ($value == "menunggu_disetujui") {
                $pesanan = $pesanan->where('status_id', 9);
            }
            if ($value == "selesai") {
                $pesanan = $pesanan->where('status_id', 6)->whereYear('tanggal_pesanan', date('Y'))->whereMonth('tanggal_pesanan', date('n'));
            }

            $pesanan = $pesanan->orderBy('id', 'desc')->limit(1000)->get();

            $cabang = EspkCabang::where('cabang_id', '!=', Auth::user()->masterKaryawan->masterCabang->id)->get();

        } else {
            $pesanan = EspkPekerjaan::orderBy('id', 'desc')->newQuery();

            if ($value == "pesanan_hari_ini") {
                $pesanan = $pesanan->where('tanggal_pesanan', date('Y-m-d'));
            }
            if ($value == "sedang_diproses") {
                $pesanan = $pesanan->whereIn('status_id', [3,4,5]);
            }
            if ($value == "menunggu_disetujui") {
                $pesanan = $pesanan->where('status_id', 9);
            }
            if ($value == "selesai") {
                $pesanan = $pesanan->where('status_id', 6)->whereYear('tanggal_pesanan', date('Y'))->whereMonth('tanggal_pesanan', date('n'));
            }

            $pesanan = $pesanan->orderBy('id', 'desc')->limit(1000)->get();

            $cabang = EspkCabang::get();
        }

        return view('pages.pekerjaan.pesanan.index', ['pesanans' => $pesanan, 'cabangs' => $cabang]);
    }
}
