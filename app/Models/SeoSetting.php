<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'default_meta_title', 'default_meta_description', 'og_default_image',
        'google_site_verification', 'google_analytics_id', 'robots_txt_extra',
    ];

    public static function getInstance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
