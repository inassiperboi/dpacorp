<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KbliItem extends Model
{
    protected $fillable = ['kode_kbli', 'judul_kbli', 'order'];
}
