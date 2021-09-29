<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkKaryawanMenuSub extends Model
{
    use HasFactory;

    public function karyawan() {
        return $this->belongsTo(MasterKaryawan::class, 'karyawan_id', 'id');
    }

    public function menuSub() {
        return $this->belongsTo(EspkMenuSub::class, 'menu_sub_id', 'id');
    }
}
