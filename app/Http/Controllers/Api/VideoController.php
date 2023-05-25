<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoRequest;
use App\Http\Requests\Video\VideoUpdateRequest;
use App\Http\Resources\Video\DefaultVideoResource;
use App\Models\Tags;
use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravel\Sanctum\PersonalAccessToken;


class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('is_deleted', 0);

        if (empty($videos->count())) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404);
        }

        return DefaultVideoResource::collection($videos->get());
    }

    public function find($hash_id)
    {
        $video = Video::where('hash_id', $hash_id)->where('is_deleted', 0);

        if (empty($video->count())) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404);
        }
        return new DefaultVideoResource($video->first());
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

        $videos = Video::where('user_id', $user->id)->where('is_deleted', 0);

        if (empty($videos->count())) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404, [
                'Content-type' => 'application/json'
            ]);
        }

        return response()->json([
            'data' => DefaultVideoResource::collection($videos->get())
        ], 200, [
            'Content-type' => 'application/json'
        ]);

    }

    public function update($hash_id, VideoUpdateRequest $request)
    {

        $video = Video::where('hash_id', $hash_id)->first();

        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;

        if ($video->is_deleted === 1) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404, [
                'Content-type' => 'application/json'
            ]);
        }

        if ($video->user_id !== $user_id) {
            return response()->json([
                'error' => 'Вы не создатель этого видео'
            ], 403, [
                'Content-type' => 'application/json'
            ]);
        }

        if (empty($video)) {
            return response()->json([
                'Видео не найдено'
            ], 404, [
                'Content-type' => 'application/json'
            ]);
        }

        $updateData = [];

        if ($request->hasFile('preview')) {
            $old_preview = substr($video->preview, 5);
            Storage::disk('local')->delete($old_preview);
            $preview = $request->file('preview');
            $preview = Image::make($preview->get())->encode('webp');
            $preview_name = time() . '.webp';
            $preview_path = '/app/public/video_previews/' . $preview_name;
            $preview->save(storage_path($preview_path), null, 'webp');
            $updateData['preview'] = $preview_path;
        }


        if ($request->input('title')) {
            $updateData['title'] = $request->input('title');
        }
        if ($request->input('description')) {
            $updateData['description'] = $request->input('description');
        }
        if ($request->input('tags')) {
            $tags = Tags::where('video_id', $video->id)->get();
            foreach ($tags as $tag) {
                $tag->delete();
            }
            $new_tags = json_decode($request->input('tags'));
            foreach ($new_tags as $tag) {
                Tags::create([
                    'name' => $tag,
                    'video_id' => $video->id
                ]);
            }
        }

        $video->update($updateData);
        return response()->json([
            'message' => 'Данные изменены'
        ]);
    }

    public function delete($hash_id, Request $request)
    {
        $video = Video::where('hash_id', $hash_id)->first();

        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;

        if ($video->is_deleted === 1) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404, [
                'Content-type' => 'application/json'
            ]);
        }

        if ($video->user_id !== $user_id) {
            return response()->json([
                'error' => 'Вы не создатель этого видео'
            ], 403, [
                'Content-type' => 'application/json'
            ]);
        }

        $video->update(['is_deleted' => true]);
        return response()->json(null, 204);
    }

}
