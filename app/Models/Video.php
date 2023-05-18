<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'is_deleted'
    ];
}
