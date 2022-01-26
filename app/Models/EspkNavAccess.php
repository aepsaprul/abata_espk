<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkNavAccess extends Model
{
    use HasFactory;

    public function masterKaryawan() {
        return $this->belongsTo(MasterKaryawan::class, 'user_id', 'id');
    }

    public function navMain() {
        return $this->belongsTo(EspkNavMain::class, 'main_id', 'id');
    }

    public function navSub() {
        return $this->belongsTo(EspkNavSub::class, 'sub_id', 'id');
    }
}
