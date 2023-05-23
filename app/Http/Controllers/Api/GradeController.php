<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\GradeRequest;
use App\Models\Grade;
use App\Models\Video;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class GradeController extends Controller
{
    public function grade($hash_id, GradeRequest $request)
    {
        $video = Video::where('hash_id', $hash_id)->where('is_deleted', 0);

        if (empty($video->count)) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404, [
                'Content-type' => 'application/json'
            ]);
        }

        $video = $video->get();

        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;

        $gradeCount = Grade::where('video_id', $video->id)->where('user_id', $user_id)->count();

        if (!empty($gradeCount)) {
            return response()->json([
                'error' => 'Вы уже оценили это видео'
            ], 403);
        }

        Grade::create([
            'video_id' => $video->id,
            'user_id' => $user_id,
            'grade_status_id' => $request->input('grade_status')
        ]);

        return response()->json([
            'message' => 'Ваша оценка поставлена'
        ]);

    }

    public function update($hash_id, GradeRequest $request)
    {
        $video = Video::where('hash_id', $hash_id)->where('is_deleted', 0);

        if (empty($video->count)) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404, [
                'Content-type' => 'application/json'
            ]);
        }

        $video = $video->get();

        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;

        $grade = Grade::where('video_id', $video->id)->where('user_id', $user_id);

        if (empty($grade->count())) {
            return response()->json([
                'error' => 'Вы еще не оценили это видео'
            ], 403);
        }

        $grade->first()->update([
            'grade_status_id' => $request->input('grade_status')
        ]);

        return response()->json([
            'message' => 'Ваша оценка изменена'
        ]);

    }

    public function delete($hash_id, Request $request)
    {
        $video = Video::where('hash_id', $hash_id)->where('is_deleted', 0);

        if ($video->count()) {
            return response()->json([
                'error' => 'Ничего не найдено'
            ], 404);
        }

        $video = $video->first();
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;
        $grade = Grade::where('video_id', $video->id)->where('user_id', $user_id)->first();
        $grade->delete();
        
        return response()->json(null, 204);
    }

}
