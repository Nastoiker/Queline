<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoRequest;
use App\Models\Tags;
use App\Models\Video;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\PersonalAccessToken;

class VideoController extends Controller
{
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

        $created = Video::create([
            'title' => $request->input('title'),
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
}
