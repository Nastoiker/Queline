<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
        'description',
        'photo',
        'banner',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    #[SearchUsingPrefix(['nickname', 'email'])]
    #[SearchUsingFullText(['description'])]
    public function toSearchableArray()
    {
        return [
          'nickname' => $this->nickname,
          'email' => $this->email,
          'description' => $this->description
        ];
    }

    public function subscribers()
    {
        return $this->hasMany(Subscribe::class, 'channel_id', 'id');
    }
    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'subscriber_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'subscriber_id');
    }
}
