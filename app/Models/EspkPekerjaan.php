<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkPekerjaan extends Model
{
    use HasFactory;

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
}
