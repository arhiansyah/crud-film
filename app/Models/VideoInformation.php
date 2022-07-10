<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoInformation extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'title_alt',
        'slug',
        'video_code',
        'genre',
        'author',
        'studio',
        'category_video',
        'description',
        'tag',
        'tahunFilm',
        'rating',
        'thumbnail',
        'video_id',
        'channel_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_video');
    }

    public function videoMedia()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
