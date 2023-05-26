<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text',
        're_id',
        'video_id',
        'user_id',
        'is_deleted'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function re()
    {
        return $this->hasMany(Comment::class, 're_id', 'id');
    }

    public function grades() {
        return $this->hasMany(CommentGrade::class, 'comment_id', 'id');
    }

}
