<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

class Video extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'description',
        'preview',
        'user_id',
        'category_id',
        'ban_status_id',
        'is_moderated',
        'path',
        'is_deleted',
        'hash_id'
    ];

    #[SearchUsingFullText(['title', 'description'])]
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany(Tags::class, 'video_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'video_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Grade::class, 'video_id', 'id')
            ->where('grade_status_id', 1);
    }

    public function dislikes()
    {
        return $this->hasMany(Grade::class, 'video_id', 'id')
            ->where('grade_status_id', 2);
    }

    public function watches()
    {
        return $this->hasMany(Watch::class, 'video_id', 'id');
    }
}
