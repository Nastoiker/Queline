<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscribe\SubscribeStoreRequest;
use App\Http\Resources\Subscribe\DefaultSubberResource;
use App\Http\Resources\Subscribe\DefaultSubscriberResource;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class SubscribeController extends Controller
{
    public function getAllByNickname($nickname)
    {
        $user = User::where('nickname', $nickname);

        if (empty($user->count())) {
            return response()->json([
                'error' => 'Пользователь не найден'
            ], 404);
        }

        $user = $user->first();
        $subscribers = Subscribe::where('channel_id', $user->id)->get();
        return DefaultSubberResource::collection($subscribers);
    }

    public function store($nickname, Request $request)
    {
        $channel = User::where('nickname', $nickname);

        if (empty($channel->count())) {
            return response()->json([
                'error' => 'Пользователь не найден'
            ], 404);
        }

        $channel = $channel->first();
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;

        $subscribe = Subscribe::where('channel_id', $channel->id)->where('subscriber_id', $user_id);

        if (!empty($subscribe->count())) {
            return response()->json([
                'error' => 'Вы уже подписаны на этот канал'
            ], 403);
        }

        Subscribe::create([
            'channel_id' => $channel->id,
            'subscriber_id' => $user_id
        ]);

        return response()->json([
            'message' => 'Вы подписались'
        ]);
    }

    public function delete($nickname, Request $request)
    {
        $channel = User::where('nickname', $nickname);

        if (empty($channel->count())) {
            return response()->json([
                'error' => 'Пользователь не найден'
            ], 404);
        }

        $channel = $channel->first();
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;

        $subscribe = Subscribe::where('channel_id', $channel->id)->where('subscriber_id', $user_id);

        if (empty($subscribe->count())) {
            return response()->json([
                'error' => 'Вы еще не подписаны на этот канал'
            ], 403);
        }
        $subscribe->first()->delete();
        return response(null, 404);
    }

    public function subscribesByUser($nickname)
    {
        $user = User::where('nickname', $nickname);

        if (empty($user->count())) {
            return response()->json([
                'error' => 'Пользователь не найден'
            ], 404);
        }

        $user = $user->first();

        $subscribes = Subscribe::where('subscriber_id', $user->id);

        return DefaultSubscriberResource::collection($subscribes->get());
    }

}
