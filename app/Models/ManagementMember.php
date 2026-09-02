<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementMember extends Model
{
    protected $fillable = [
        'nama', 'jabatan', 'foto', 'foto_alt', 'deskripsi', 'urutan', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];
}
