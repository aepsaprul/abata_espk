<?php

namespace App\Http\Controllers;

use App\Models\EspkCabang;
use App\Models\EspkPekerjaan;
use App\Models\EspkPelanggan;
use App\Models\EspkStatus;
use App\Models\MasterCabang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    public function indexPekerjaan()
    {
        $pekerjaan = EspkPekerjaan::whereNotNull('cabang_pelaksana_id')->get();
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

    // public function getDataPekerjaan(Request $request) {
    //     if ($request->ajax()) {
    //         $data = EspkPekerjaan::with('cabangPemesan')->whereNotNull('cabang_pelaksana_id')->whereBetween('tanggal_pesanan', [$request->get('tanggal_awal'), $request->get('tanggal_akhir')])->get();
    //         return datatables()::of($data)
    //             ->addIndexColumn()
    //             ->filter(function ($instance) use ($request) {
    //                 if (!empty($request->get('pelanggan_id'))) {
    //                     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                         return Str::contains($row['pelanggan_id'], $request->get('pelanggan_id')) ? true : false;
    //                     });
    //                 }
    //                 if (!empty($request->get('nama_pesanan'))) {
    //                     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                         return Str::contains($row['nama_pesanan'], $request->get('nama_pesanan')) ? true : false;
    //                     });
    //                 }
    //                 if (!empty($request->get('cabang_pemesan_id'))) {
    //                     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                         return Str::contains($row['cabang_pemesan_id'], $request->get('cabang_pemesan_id')) ? true : false;
    //                     });
    //                 }
    //                 if (!empty($request->get('cabang_pelaksana_id'))) {
    //                     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                         return Str::contains($row['cabang_pelaksana_id'], $request->get('cabang_pelaksana_id')) ? true : false;
    //                     });
    //                 }
    //                 if (!empty($request->get('status_id'))) {
    //                     $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    //                         return Str::contains($row['status_id'], $request->get('status_id')) ? true : false;
    //                     });
    //                 }
    //             })
    //             ->editColumn('tanggal_selesai', function ($request){
    //                 if ($request->tanggal_selesai) {
    //                     return date('d-m-Y', strtotime($request->tanggal_selesai) );
    //                 }
    //             })
    //             ->addColumn('action', function($row){
    //                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit lihat border-0 bg-white text-dark mx-2"><i class="fas fa-eye"></i></a>';

    //                 return $btn;
    //             })
    //             ->addColumn('cabangPemesan', function(EspkPekerjaan $espkPekerjaan){
    //                 return $espkPekerjaan->cabangPemesan->nama_cabang;
    //             })
    //             ->addColumn('cabangPelaksana', function(EspkPekerjaan $espkPekerjaan){
    //                 return $espkPekerjaan->cabangPelaksana->nama_cabang;
    //             })
    //             ->addColumn('status', function(EspkPekerjaan $espkPekerjaan){
    //                 return $espkPekerjaan->status->nama_status;
    //             })
    //             ->addColumn('pegawaiPenerimaPesanan', function(EspkPekerjaan $espkPekerjaan){
    //                 if ($espkPekerjaan->pegawaiPenerimaPesanan) {
    //                     return $espkPekerjaan->pegawaiPenerimaPesanan->nama_panggilan;
    //                 } else {
    //                     return "kosong";
    //                 }
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
    public function search(Request $request)
    {
        $pekerjaan = EspkPekerjaan::whereBetween('tanggal_pesanan', [$request->get('tanggal_awal'), $request->get('tanggal_akhir')])->newQuery();
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
}
