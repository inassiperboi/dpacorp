<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'nama_resmi', 'nama_singkat', 'tagline', 'logo', 'logo_alt', 'favicon',
        'alamat', 'kota', 'provinsi', 'kode_pos', 'telepon', 'whatsapp', 'email',
        'jam_operasional', 'maps_url', 'lat', 'lng',
        'instagram', 'tiktok', 'youtube', 'facebook', 'linkedin', 'twitter',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];

    public static function getInstance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
