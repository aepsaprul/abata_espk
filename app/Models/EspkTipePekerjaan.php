<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkTipePekerjaan extends Model
{
    use HasFactory;

    public function jenisPekerjaan() {
        return $this->hasMany(EspkJenisPekerjaan::class, 'tipe_pekerjaan_id', 'id');
    }
}
