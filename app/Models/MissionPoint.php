<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionPoint extends Model
{
    protected $fillable = ['isi_misi', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
