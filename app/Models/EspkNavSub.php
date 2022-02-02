<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkNavSub extends Model
{
    use HasFactory;

    public function navMain() {
        return $this->belongsTo(EspkNavMain::class, 'main_id', 'id');
    }
}
