<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementStructure extends Model
{
    protected $fillable = [
        'image', 'image_alt',
    ];

    public static function getInstance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
