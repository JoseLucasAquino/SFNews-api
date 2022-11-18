<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'image_url',
        'news_site',
        'summary',
        'published_at',
        'article_updated_at',
        'featured',
        'launches',
        'events'
    ];
}
