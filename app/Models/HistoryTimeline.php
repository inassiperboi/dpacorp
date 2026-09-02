<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryTimeline extends Model
{
    protected $fillable = [
        'year', 'title', 'description', 'image', 'image_alt', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
