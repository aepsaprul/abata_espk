<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkPekerjaan extends Model
{
    use HasFactory;

    public function masterCabang() {
        return $this->belongsTo(MasterCabang::class, 'cabang_pemesan_id', 'id');
    }

    public function pegawaiPenerimaPesanan() {
        return $this->belongsTo(MasterKaryawan::class, 'pegawai_penerima_pesanan_id', 'id');
    }
}
