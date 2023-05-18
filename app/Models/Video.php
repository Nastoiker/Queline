<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Video extends Model
{
    use HasFactory;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
