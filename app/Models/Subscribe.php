<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = [
        'channel_id',
        'subscriber_id'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'subscriber_id', 'id');
    }
}
