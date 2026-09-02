<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductService extends Model
{
    protected $table = 'products_services';

    protected $fillable = [
        'nama', 'slug', 'deskripsi_singkat', 'deskripsi_lengkap',
        'thumbnail', 'thumbnail_alt', 'kategori',
        'meta_title', 'meta_description', 'is_active', 'order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function images(): HasMany
    {
        return $this->hasMany(ProductServiceImage::class)->orderBy('order');
    }
}
