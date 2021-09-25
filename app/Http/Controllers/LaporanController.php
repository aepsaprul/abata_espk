<?php

namespace App\Http\Controllers;

use App\Models\EspkPekerjaan;
use App\Models\EspkPelanggan;
use App\Models\EspkStatus;
use App\Models\MasterCabang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexPekerjaan()
    {
        $pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')->get();
        $pelanggan = EspkPelanggan::get();
        $cabang = MasterCabang::get();
        $status = EspkStatus::get();

        return view('pages.laporan.pekerjaan.index', [
            'pekerjaans' => $pekerjaan,
            'pelanggans' => $pelanggan,
            'cabangs' => $cabang,
            'status' => $status
        ]);
    }
}
