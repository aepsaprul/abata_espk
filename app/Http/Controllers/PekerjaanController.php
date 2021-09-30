<?php

namespace App\Http\Controllers;

use App\Models\EspkJenisPekerjaan;
use App\Models\EspkPekerjaan;
use App\Models\EspkPekerjaanProses;
use App\Models\EspkPelanggan;
use App\Models\EspkTipePekerjaan;
use App\Models\MasterCabang;
use App\Models\MasterKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaan = EspkPekerjaan::where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)->get();

        return view('pages.pekerjaan.pesanan.index', ['pesanans' => $pekerjaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan = EspkPelanggan::get();
        $penerima_pesanan = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->whereIn('master_jabatan_id', ['21', '22', '23'])->get();
        $desain = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->where('master_jabatan_id', '24')->get();
        $cabang_cetak = MasterCabang::where('id', 7)->get();
        $cabang_finishing = MasterCabang::whereIn('id', ['2', '7'])->get();
        $jenis_pekerjaan = EspkJenisPekerjaan::with('tipePekerjaan')->get();
        $tipe_pekerjaan = EspkTipePekerjaan::get();

        return view('pages.pekerjaan.pesanan.create', [
            'pelanggans' => $pelanggan,
            'cabang_cetaks' => $cabang_cetak,
            'cabang_finishings' => $cabang_finishing,
            'jenis_pekerjaans' => $jenis_pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan,
            'penerima_pesanans' => $penerima_pesanan,
            'desains' => $desain
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pekerjaan = new EspkPekerjaan;
        $pekerjaan->cabang_pemesan_id = Auth::user()->masterKaryawan->masterCabang->id;
        $pekerjaan->pelanggan_id = $request->pelanggan_id;
        $pekerjaan->pegawai_penerima_pesanan_id = $request->pegawai_penerima_pesanan_id;
        $pekerjaan->pegawai_desain_id = $request->pegawai_desain_id;
        $pekerjaan->cabang_cetak_id = $request->cabang_cetak_id;
        $pekerjaan->cabang_finishing_id = $request->cabang_finishing_id;
        $pekerjaan->nama_pesanan = $request->nama_pesanan;
        $pekerjaan->nomor_nota = $request->nomor_nota;
        $pekerjaan->tanggal_pesanan = $request->tanggal_pesanan;
        $pekerjaan->rencana_jadi = $request->rencana_jadi;
        $pekerjaan->jenis_pesanan = $request->jenis_pesanan;
        $pekerjaan->jumlah = $request->jumlah;
        $pekerjaan->ukuran = $request->ukuran;
        $pekerjaan->jenis_kertas = $request->jenis_kertas;
        $pekerjaan->warna = $request->warna;
        $pekerjaan->keterangan = $request->keterangan;

        // if ($request->file('file')) {
        //     $file = $request->file('file')->store('file', 'public');
        //     $pekerjaan->file = $file;
        // }
        if ($request->file('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('file', $file_name);
            $pekerjaan->file = $file_name;
        }

        $pekerjaan->save();

        foreach ($request->jenis_pekerjaan_id as $key => $jenis_pekerjaan) {
            $jenis_pekerjaans = new EspkPekerjaanProses();
            $jenis_pekerjaans->jenis_pekerjaan_id = $jenis_pekerjaan;
            $jenis_pekerjaans->pekerjaan_id = $pekerjaan->id;
            $jenis_pekerjaans->keterangan = $request->jenis_pekerjaan_keterangan[$key];
            $jenis_pekerjaans->save();
        }

        return redirect()->route('pekerjaan.index')->with('status', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pekerjaan = EspkPekerjaan::find($id);
        $pelanggan = EspkPelanggan::get();
        $penerima_pesanan = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->whereIn('master_jabatan_id', ['21', '22', '23'])->get();
        $desain = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->where('master_jabatan_id', '24')->get();
        $cabang_cetak = MasterCabang::get();
        $cabang_finishing = MasterCabang::get();
        $jenis_pekerjaan = EspkJenisPekerjaan::with([
            'tipePekerjaan',
            'pekerjaanProses' => function ($query) use ($id) {
                $query->where('pekerjaan_id', $id);
            }
        ])->get();
        $tipe_pekerjaan = EspkTipePekerjaan::with([
            'jenisPekerjaan',
            'jenisPekerjaan.pekerjaanProses' => function($query) use ($id) {
                $query->where('pekerjaan_id', $id);
            }
        ])->get();
        // $pekerjaan_proses = EspkPekerjaanProses::where('pekerjaan_id', $id)->get();
        $pekerjaan_proses = EspkPekerjaanProses::where('pekerjaan_id', $id)->get();

        return view('pages.pekerjaan.pesanan.edit', [
            'pekerjaan' => $pekerjaan,
            'pelanggans' => $pelanggan,
            'cabang_cetaks' => $cabang_cetak,
            'cabang_finishings' => $cabang_finishing,
            'jenis_pekerjaans' => $jenis_pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan,
            'penerima_pesanans' => $penerima_pesanan,
            'desains' => $desain,
            'pekerjaan_proses' => $pekerjaan_proses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pekerjaan = EspkPekerjaan::find($id);
        $pekerjaan->cabang_pemesan_id = Auth::user()->masterKaryawan->masterCabang->id;
        $pekerjaan->pelanggan_id = $request->pelanggan_id;
        $pekerjaan->pegawai_penerima_pesanan_id = $request->pegawai_penerima_pesanan_id;
        $pekerjaan->pegawai_desain_id = $request->pegawai_desain_id;
        $pekerjaan->cabang_cetak_id = $request->cabang_cetak_id;
        $pekerjaan->cabang_finishing_id = $request->cabang_finishing_id;
        $pekerjaan->nama_pesanan = $request->nama_pesanan;
        $pekerjaan->nomor_nota = $request->nomor_nota;
        $pekerjaan->tanggal_pesanan = $request->tanggal_pesanan;
        $pekerjaan->rencana_jadi = $request->rencana_jadi;
        $pekerjaan->jenis_pesanan = $request->jenis_pesanan;
        $pekerjaan->jumlah = $request->jumlah;
        $pekerjaan->ukuran = $request->ukuran;
        $pekerjaan->jenis_kertas = $request->jenis_kertas;
        $pekerjaan->warna = $request->warna;
        $pekerjaan->keterangan = $request->keterangan;

        if ($request->file('file')) {
            // if($pekerjaan->file && file_exists(storage_path('app/public/' . $pekerjaan->file))) {
            //     Storage::delete('public/' . $pekerjaan->file);
            // }
            // $file = $request->file('file')->store('file', 'public');
            // $pekerjaan->file = $file;
            if($pekerjaan->file && file_exists(storage_path('app/file/' . $pekerjaan->file))) {
                Storage::delete('file/' . $pekerjaan->file);
            }

            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('file', $file_name);
            $pekerjaan->file = $file_name;
        }

        $pekerjaan->save();

        foreach ($request->pekerjaan_proses_id as $key => $pekerjaan_proses) {
            $pekerjaan_proses = EspkPekerjaanProses::find($pekerjaan_proses);
            $pekerjaan_proses->jenis_pekerjaan_id = $request->jenis_pekerjaan_id[$key];
            $pekerjaan_proses->pekerjaan_id = $pekerjaan->id;
            $pekerjaan_proses->keterangan = $request->jenis_pekerjaan_keterangan[$key];
            $pekerjaan_proses->save();
        }

        return redirect()->route('pekerjaan.index')->with('status', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pekerjaan = EspkPekerjaan::find($id);
        $pekerjaan->delete();

        // if($pekerjaan->file && file_exists(storage_path('app/public/' . $pekerjaan->file))) {
        //     Storage::delete('public/' . $pekerjaan->file);
        // }
        if($pekerjaan->file && file_exists(storage_path('app/file/' . $pekerjaan->file))) {
            Storage::delete('file/' . $pekerjaan->file);
        }

        $pekerjaan_proses_db = EspkPekerjaanProses::where('pekerjaan_id', $id)->get();

        foreach ($pekerjaan_proses_db as $key => $pekerjaan_proses) {
            EspkPekerjaanProses::where('id', $pekerjaan_proses->id)->delete();
        }

        return redirect()->route('pekerjaan.index')->with('status', 'Data berhasil dihapus');
    }

    public function download(Request $request, $file)
    {
        return response()->download(storage_path('app/file/'. $file));
    }

    public function publish(Request $request)
    {
        $pekerjaan = EspkPekerjaan::find($request->id);
        $pelaksana = MasterCabang::where('id', 7)->get();

        return response()->json([
            'id' => $pekerjaan->id,
            'nama_pesanan' => $pekerjaan->nama_pesanan,
            'pelaksanas' => $pelaksana
        ]);
    }

    public function publishStore(Request $request)
    {
        $pekerjaan = EspkPekerjaan::find($request->id);
        $pekerjaan->cabang_pelaksana_id = $request->cabang_pelaksana_id;
        $pekerjaan->save();

        return response()->json([
            'status' => 'sukses'
        ]);
    }
}
