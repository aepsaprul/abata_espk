<?php

namespace App\Http\Controllers;

use App\Models\EspkPekerjaan;
use App\Models\EspkPelanggan;
use App\Models\EspkStatus;
use App\Models\MasterCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function getDataPekerjaan(Request $request) {
        if ($request->ajax()) {
            $data = EspkPekerjaan::whereBetween('tanggal_pesanan', [$request->get('tanggal_awal'), $request->get('tanggal_akhir')])->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('pelanggan_id'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['pelanggan_id'], $request->get('pelanggan_id')) ? true : false;
                        });
                    }
                    if (!empty($request->get('nama_pesanan'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['nama_pesanan'], $request->get('nama_pesanan')) ? true : false;
                        });
                    }
                    if (!empty($request->get('cabang_pemesan_id'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['cabang_pemesan_id'], $request->get('cabang_pemesan_id')) ? true : false;
                        });
                    }
                    if (!empty($request->get('cabang_pelaksana_id'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['cabang_pelaksana_id'], $request->get('cabang_pelaksana_id')) ? true : false;
                        });
                    }
                    if (!empty($request->get('status_id'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['status_id'], $request->get('status_id')) ? true : false;
                        });
                    }
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="#" class="border-0 bg-white text-dark mx-2" title="Lihat"><i class="fas fa-eye"></i></a> | <a href="#" class="border-0 bg-white text-dark mx-2" title="Lihat"><i class="fas fa-edit"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
