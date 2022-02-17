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
        // pesanan hari ini
        $pesanan = EspkPekerjaan::where('tanggal_pesanan', date('Y-m-d'))->newQuery();
        if (Auth::user()->masterKaryawan) {
            $pesanan = $pesanan->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_hari_ini = $pesanan->get();

        // pesanan sedang diproses
        $pesanan_proses = EspkPekerjaan::whereIn('status_id', [3,4,5])->newQuery();
        if (Auth::user()->masterKaryawan) {
            $pesanan_proses = $pesanan_proses->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_proses = $pesanan_proses->get();

        // pesanan menunggu disetujui
        $pesanan_menunggu_disetujui = EspkPekerjaan::where('status_id', 9)->newQuery();
        if (Auth::user()->masterKaryawan) {
            $pesanan_menunggu_disetujui = $pesanan_menunggu_disetujui->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_menunggu_disetujui = $pesanan_menunggu_disetujui->get();

        // pesanan selesai bulan ini
        $pesanan_selesai = EspkPekerjaan::where('status_id', 6)
            ->whereYear('tanggal_pesanan', date('Y'))
            ->whereMonth('tanggal_pesanan', date('m'))
            ->newQuery();
        if (Auth::user()->masterKaryawan) {
            $pesanan_selesai = $pesanan_selesai->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id);
        }
        $pesanan_selesai = $pesanan_selesai->get();

        $jumlah_pesanan_hari_ini = count($pesanan_hari_ini);
        $jumlan_pesanan_proses = count($pesanan_proses);
        $jumlan_pesanan_menunggu_disetujui = count($pesanan_menunggu_disetujui);
        $jumlan_pesanan_selesai = count($pesanan_selesai);

        return view('home', [
            'jumlah_pesanan_hari_ini' => $jumlah_pesanan_hari_ini,
            'jumlah_pesanan_proses' => $jumlan_pesanan_proses,
            'jumlah_pesanan_menunggu_disetujui' => $jumlan_pesanan_menunggu_disetujui,
            'jumlah_pesanan_selesai' => $jumlan_pesanan_selesai
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
