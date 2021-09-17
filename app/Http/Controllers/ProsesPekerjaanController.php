<?php

namespace App\Http\Controllers;

use App\Models\EspkPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProsesPekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
        ->where('cabang_pelaksana_id', Auth::user()->masterKaryawan->masterCabang->id)
        ->get();

        $pesanan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
        ->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)
        ->get();

        return view('pages.pekerjaan.proses_pekerjaan.index', ['pekerjaans' => $pekerjaan, 'pesanans' => $pesanan]);
    }

    public function create()
    {

    }
}
