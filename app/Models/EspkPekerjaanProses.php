<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkPekerjaanProses extends Model
{
    use HasFactory;

    public function pekerjaan() {
        return $this->belongsTo(EspkPekerjaan::class, 'pekerjaan_id', 'id');
    }

    public function jenisPekerjaan() {
        return $this->belongsTo(EspkJenisPekerjaan::class, 'jenis_pekerjaan_id', 'id');
    }
}
