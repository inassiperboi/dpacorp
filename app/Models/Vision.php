<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $fillable = ['isi_visi'];

    public static function getInstance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
