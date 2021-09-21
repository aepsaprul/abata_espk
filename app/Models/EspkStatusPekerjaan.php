<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkStatusPekerjaan extends Model
{
    use HasFactory;

    public function status() {
        return $this->belongsTo(EspkStatus::class, 'status_id', 'id') ;
    }

    public function pelaksana() {
        return $this->belongsTo(MasterKaryawan::class, 'pegawai_id', 'id');
    }
}
