<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoRequest;
use App\Http\Resources\Video\DefaultVideoResource;
use App\Models\Tags;
use App\Models\Video;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\PersonalAccessToken;


class VideoController extends Controller
{
    public function index()
    {
        return DefaultVideoResource::collection(Video::all());
    }

    public function find($hash_id)
    {
        $video = Video::where('hash_id', $hash_id)->first();

        if (!empty($video)) {
            return new DefaultVideoResource($video);
        } else {
            return response()->json([
                'Ничего не найдено'
            ], 404);
        }

    }

    public function store(VideoRequest $request)
    {
        $video = $request->file('video');
        $video_name = time() . '.mp4';
        $video->move(storage_path('/app/public/videos/'), $video_name);
        $video_path = '/app/public/videos/' . $video_name;

        if ($request->hasFile('preview')) {
            $preview = $request->file('preview');
            $preview = Image::make($preview->get())->encode('webp');
            $preview_name = time() . '.webp';
            $preview_path = '/app/public/video_previews/' . $preview_name;
            $preview->save(storage_path($preview_path), null, 'webp');
        }
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;
        $hash_id = base64_encode(uniqid());

        $created = Video::create([
            'title' => $request->input('title'),
            'hash_id' => $hash_id,
            'description' => $request->input('description'),
            'preview' => $preview_path ?? null,
            'path' => $video_path,
            'user_id' => $user_id,
            'category_id' => $request->input('category_id')
        ]);

        $tags = json_decode($request->input('tags'));

        foreach ($tags as $tag) {
            Tags::create([
                'name' => $tag,
                'video_id' => $created->id
            ]);
        }


        return response()->json([
            'message' => 'Видео загружено'
        ], 200, [
            'Content-type' => 'application/json'
        ]);
    }

    public function getVideosByNickname($nickname)
    {
        $user = User::where('nickname', $nickname)->first();

        if (empty($user)) {
            return response()->json([
                'error' => 'Пользователя с теким никнеймом не существует'
            ], 404, [
                'Content-type' => 'application/json'
            ]);
        }

        $videos = Video::where('user_id', $user->id)->get();

        return response()->json([
            'data' => DefaultVideoResource::collection($videos)
        ], 200, [
            'Content-type' => 'application/json'
        ]);

    }
}
