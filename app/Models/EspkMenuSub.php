<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkMenuSub extends Model
{
    use HasFactory;

    public function menuUtama() {
        return $this->belongsTo(EspkMenuUtama::class, 'menu_utama_id', 'id');
    }

    public function karyawanMenuSub() {
        return $this->hasMany(EspkKaryawanMenuSub::class, 'menu_sub_id', 'id');
    }
}
