<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'summary',
        'image',
        'image_2',
        'country',
        'tags',
    ];

    public function extraImages(): array
    {
        $value = $this->getRawOriginal('image_2');

        if (empty($value)) {
            return [];
        }

        if (is_array($value)) {
            return array_values(array_filter($value));
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return array_values(array_filter($decoded));
            }

            return [trim($value)];
        }

        return [];
    }
}
