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

    public function sub()
    {
        return $this->belongsTo(User::class, 'channel_id', 'id');
    }

    public function subr()
    {
        return $this->belongsTo(User::class, 'subscriber_id', 'id');
    }

    public function subscriber()
    {
        return $this->hasMany(User::class, 'id', 'subscriber_id');
    }

    public function subbes()
    {
        return $this->hasMany(Subscribe::class, 'subscriber_id', 'channel_id');
    }

    public function subber()
    {
        return $this->hasMany(Subscribe::class, 'channel_id', 'subscriber_id');
    }

    public function subscribers()
    {
        return $this->hasMany(User::class, 'id', 'channel_id');
    }

    public static function currentSubscribers($sub_id)
    {
        $subs = Subscribe::where('channel_id', $sub_id)->get();

        $users = [];

        foreach ($subs as $sub) {
            $users[] = User::findOrFail($sub->subscriber_id);
        }

        return $users;
    }

    public static function currentSubbes($user_id)
    {
        $subs = Subscribe::where('subscriber_id', $user_id)->get();

        $users = [];

        foreach ($subs as $sub) {
            $users[] = User::findOrFail($sub->subscriber_id);
        }

        return $users;
    }
}
