<?php

namespace App\Http\Controllers;

use App\Models\EspkPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananPublishController extends Controller
{
    public function index()
    {
        $pesanan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')
        ->where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)
        ->orderBy('id', 'desc')
        ->get();

        return view('pages.pekerjaan.pesanan_publish.index', ['pesanans' => $pesanan]);
    }
}
