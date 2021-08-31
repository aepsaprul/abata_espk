<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkMenuUtama extends Model
{
    use HasFactory;

    public function subMenu() {
        return $this->hasMany(EspkMenuSub::class, 'menu_utama_id', 'id');
    }
}
