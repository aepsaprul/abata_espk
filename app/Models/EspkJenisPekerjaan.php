<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkJenisPekerjaan extends Model
{
    use HasFactory;

    public function tipePekerjaan() {
        return $this->belongsTo(EspkTipePekerjaan::class, 'tipe_pekerjaan_id', 'id');
    }
}
