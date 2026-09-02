<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nama', 'logo', 'logo_alt', 'website_url', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
