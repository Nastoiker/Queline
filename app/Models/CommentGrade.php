<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentGrade extends Model
{
    protected $fillable = [
        'grade_status_id',
        'comment_id',
        'user_id'
    ];
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
