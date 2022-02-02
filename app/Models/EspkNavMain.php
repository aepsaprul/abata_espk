<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspkNavMain extends Model
{
    use HasFactory;

    public function navSub() {
        return $this->hasMany(EspkNavSub::class, 'nav_main_id', 'id');
    }

    public function navAccess() {
        return $this->hasMany(EspkNavAccess::class, 'main_id', 'id');
    }
}
