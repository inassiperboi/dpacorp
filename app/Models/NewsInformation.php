<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsInformation extends Model
{
    protected $table = 'news_information';

    protected $fillable = [
        'type',
        'title',
        'slug',
        'content',
        'summary',
        'image',
        'country',
        'tags',
        'listing',
    ];
}
