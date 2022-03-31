<?php

namespace App\Http\Controllers;

use App\Models\EspkCabang;
use App\Models\EspkJenisPekerjaan;
use App\Models\EspkPekerjaan;
use App\Models\EspkPekerjaanProses;
use App\Models\EspkPelanggan;
use App\Models\EspkStatusPekerjaan;
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
        if (Auth::user()->master_karyawan_id) {
            $pekerjaan = EspkPekerjaan::where('cabang_pemesan_id', Auth::user()->masterKaryawan->masterCabang->id)
                ->where('status_id', '!=', 6)
                ->orWhere('status_id', null)
                ->orderBy('id', 'desc')
                ->limit(1000)
                ->get();

            $cabang = EspkCabang::where('cabang_id', '!=', Auth::user()->masterKaryawan->masterCabang->id)->get();

        } else {
            $pekerjaan = EspkPekerjaan::orderBy('id', 'desc')
                ->where('status_id', '!=', 6)
                ->orWhere('status_id', null)
                ->limit(1000)
                ->get();

            $cabang = EspkCabang::get();
        }

        return view('pages.pekerjaan.pesanan.index', ['pesanans' => $pekerjaan, 'cabangs' => $cabang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cabang = EspkCabang::where('id', $id)->first();

        $pelanggan = EspkPelanggan::where('cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->limit(500)->get();

        $penerima_pesanan = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->whereIn('master_jabatan_id', ['21', '22', '23', '35'])->get();

        $desain = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->where('master_jabatan_id', '24')->get();

        $operator = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)
            ->whereIn('master_jabatan_id', [
                '43',
                '44',
                '45',
                '46',
                '47',
                '48',
                '49',
                '50',
                '51',
                '52',
                '53',
                '63',
                '65',
            ])
            ->get();

        $cabang_cetak = MasterCabang::where('id',  $cabang->cabang_id)->get();

        $cabang_finishing = MasterCabang::whereIn('id', [Auth::user()->masterKaryawan->masterCabang->id, $cabang->cabang_id])->get();

        $jenis_pekerjaan = EspkJenisPekerjaan::with('tipePekerjaan')
            ->where('cetak', 'like', '%'. $cabang->form_group . '%')
            ->get();

        $jenis_pekerjaan_group = EspkJenisPekerjaan::select('tipe_pekerjaan_id')
            ->groupBy('tipe_pekerjaan_id')
            ->get();

        return view('pages.pekerjaan.pesanan.create', [
            'cabang' => $cabang,
            'pelanggans' => $pelanggan,
            'cabang_cetaks' => $cabang_cetak,
            'cabang_finishings' => $cabang_finishing,
            'jenis_pekerjaans' => $jenis_pekerjaan,
            'jenis_pekerjaan_groups' => $jenis_pekerjaan_group,
            'penerima_pesanans' => $penerima_pesanan,
            'desains' => $desain,
            'operators' => $operator
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
        $validated = $request->validate([
            'pegawai_penerima_pesanan_id' => 'required',
            'file' => 'max:5000'
        ]);

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
        $pekerjaan->jumlah = $request->jumlah_cetak;
        $pekerjaan->ukuran = $request->ukuran;
        $pekerjaan->satuan = $request->satuan;
        $pekerjaan->bahan = $request->bahan;
        $pekerjaan->finishing = $request->finishing;
        $pekerjaan->jenis_kertas = $request->jenis_kertas;
        $pekerjaan->warna = $request->warna;
        $pekerjaan->catatan_kasir = $request->catatan_kasir;
        $pekerjaan->catatan_produksi = $request->catatan_produksi;
        $pekerjaan->keterangan = $request->keterangan;

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

        $status_pekerjaan = new EspkStatusPekerjaan;
        $status_pekerjaan->pekerjaan_id = $pekerjaan->id;
        $status_pekerjaan->status_id = 10;
        $status_pekerjaan->pegawai_id = Auth::user()->masterKaryawan->id;
        $status_pekerjaan->waktu = date('Y-m-d H:i:s');
        $status_pekerjaan->save();

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
        $pekerjaan = EspkPekerjaan::find($id);

        $tipe_pekerjaan = EspkTipePekerjaan::with([
                'jenisPekerjaan',
                'jenisPekerjaan.pekerjaanProses' => function($query) use ($id) {
                    $query->where('pekerjaan_id', $id);
                }
            ])
            ->get();

        $status_pekerjaan = EspkStatusPekerjaan::where('pekerjaan_id', $id)->get();

        $cabang = EspkCabang::where('cabang_id', $pekerjaan->cabang_cetak_id)->first();

        return view('pages.pekerjaan.pesanan.show', [
            'pekerjaan' => $pekerjaan,
            'tipe_pekerjaans' => $tipe_pekerjaan,
            'status_pekerjaans' => $status_pekerjaan,
            'cabang' => $cabang
        ]);
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

        $pelanggan = EspkPelanggan::where('cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->get();

        $penerima_pesanan = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->whereIn('master_jabatan_id', ['21', '22', '23', '35'])->get();

        $desain = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)->where('master_jabatan_id', '24')->get();

        $operator = MasterKaryawan::where('master_cabang_id', Auth::user()->masterKaryawan->masterCabang->id)
            ->whereIn('master_jabatan_id', [
                '43',
                '44',
                '45',
                '46',
                '47',
                '48',
                '49',
                '50',
                '51',
                '52',
                '53',
                '63',
                '65',
            ])
            ->get();

        $cabang_cetak = EspkCabang::get();

        $cabang_finishing = EspkCabang::get();

        $cabang = EspkCabang::where('cabang_id', $pekerjaan->cabang_cetak_id)->first();
        $cabang_group = $cabang->form_group;

        $tipe_pekerjaan = EspkTipePekerjaan::with([
            'jenisPekerjaan' => function ($query) use ($cabang_group) {
                $query->where('cetak', 'like', '%'. $cabang_group . '%');
            },
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
            'tipe_pekerjaans' => $tipe_pekerjaan,
            'penerima_pesanans' => $penerima_pesanan,
            'desains' => $desain,
            'pekerjaan_proses' => $pekerjaan_proses,
            'cabang' => $cabang,
            'operators' => $operator
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
        $validated = $request->validate([
            'pegawai_penerima_pesanan_id' => 'required',
            'file' => 'max:5000'
        ]);

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
        $pekerjaan->jumlah = $request->jumlah_cetak;
        $pekerjaan->ukuran = $request->ukuran;
        $pekerjaan->satuan = $request->satuan;
        $pekerjaan->bahan = $request->bahan;
        $pekerjaan->finishing = $request->finishing;
        $pekerjaan->jenis_kertas = $request->jenis_kertas;
        $pekerjaan->warna = $request->warna;
        $pekerjaan->catatan_kasir = $request->catatan_kasir;
        $pekerjaan->catatan_produksi = $request->catatan_produksi;
        $pekerjaan->keterangan = $request->keterangan;

        if ($request->file('file')) {
            if($pekerjaan->file && file_exists(storage_path('app/file/' . $pekerjaan->file))) {
                Storage::delete('file/' . $pekerjaan->file);
            }

            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('file', $file_name);
            $pekerjaan->file = $file_name;
        }

        $pekerjaan->save();

        $pekerjaan_proses = EspkPekerjaanProses::where('pekerjaan_id', $id);
        $pekerjaan_proses->delete();

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
        $pelaksana = MasterCabang::where('id', $pekerjaan->cabang_cetak_id)->get();

        return response()->json([
            'id' => $pekerjaan->id,
            'nama_pesanan' => $pekerjaan->nama_pesanan,
            'pelaksanas' => $pelaksana
        ]);
    }

    public function publishStore(Request $request)
    {
        $pekerjaan = EspkPekerjaan::find($request->id);

        if ($pekerjaan->status_id == 8) {
            $pekerjaan->status_id = 9;
        } else {
            $pekerjaan->cabang_pelaksana_id = $request->cabang_pelaksana_id;
            $pekerjaan->status_id = 9;
        }
        $pekerjaan->save();

        return response()->json([
            'status' => 'sukses'
        ]);
    }
}
