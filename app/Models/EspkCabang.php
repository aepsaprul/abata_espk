<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkCabang extends Model
{
    use HasFactory;

    public function masterCabang() {
        return $this->belongsTo(MasterCabang::class, 'cabang_id', 'id');
    }
}
