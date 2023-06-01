<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Watch;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class WatchController extends Controller
{
    public function store($hash_id, Request $request)
    {
        $video = Video::where('hash_id', $hash_id)->where('is_deleted', 0);

        if (empty($video->count())) {
            return response()->json([
                'error' => 'Видео не найдено'
            ], 404);
        }

        $video = $video->first();

        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;

        Watch::create([
           'video_id' => $video->id,
           'user_id' => $user_id
        ]);

        return response(null, 201);
    }
}
