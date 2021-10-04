<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkPekerjaan extends Model
{
    use HasFactory;

    public function cabangCetak() {
        return $this->belongsTo(MasterCabang::class, 'cabang_cetak_id', 'id');
    }

    public function cabangFinishing() {
        return $this->belongsTo(MasterCabang::class, 'cabang_finishing_id', 'id');
    }

    public function pelanggan() {
        return $this->belongsTo(EspkPelanggan::class, 'pelanggan_id', 'id');
    }

    public function pekerjaanProses() {
        return $this->hasMany(EspkPekerjaanProses::class, 'pekerjaan_id', 'id');
    }

    public function cabangPemesan() {
        return $this->belongsTo(MasterCabang::class, 'cabang_pemesan_id', 'id');
    }

    public function cabangPelaksana() {
        return $this->belongsTo(MasterCabang::class, 'cabang_pelaksana_id', 'id');
    }

    public function pegawaiPenerimaPesanan() {
        return $this->belongsTo(MasterKaryawan::class, 'pegawai_penerima_pesanan_id', 'id');
    }

    public function pegawaiDesain() {
        return $this->belongsTo(MasterKaryawan::class, 'pegawai_desain_id', 'id');
    }

    public function status() {
        return $this->belongsTo(EspkStatus::class, 'status_id', 'id');
    }

    public function statusPekerjaan() {
        return $this->hasMany(EspkStatusPekerjaan::class, 'pekerjaan_id', 'id');
    }
}
