<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkKaryawanMenuUtama extends Model
{
    use HasFactory;

    public function karyawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
    }

    public function menuUtama() {
        return $this->belongsTo(EspkMenuUtama::class, 'menu_utama_id', 'id');
    }
}
