<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subsidiary extends Model
{
    protected $fillable = [
        'nama', 'slug', 'logo', 'logo_alt', 'cover_image', 'cover_alt',
        'deskripsi_singkat', 'deskripsi_lengkap',
        'tanggal_pendirian', 'no_akta', 'no_sk_kemenkumham',
        'alamat', 'website_url',
        'instagram', 'tiktok', 'youtube', 'whatsapp', 'email',
        'is_active', 'order', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'is_active'          => 'boolean',
        'tanggal_pendirian'  => 'date',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(SubsidiaryService::class)->orderBy('order');
    }
}
