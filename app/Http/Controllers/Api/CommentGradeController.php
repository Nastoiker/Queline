<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentGrade\CommentGradeRequest;
use App\Models\Comment;
use App\Models\CommentGrade;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CommentGradeController extends Controller
{
    public function store($id, CommentGradeRequest $request)
    {
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;
        $commentGrade = CommentGrade::where('user_id', $user_id)->where('comment_id', $id);

        if (!empty($commentGrade->count())) {
            return response()->json([
                'error' => 'Вы уже оценили комментарий'
            ], 403);
        }

        $comment = Comment::findOrFail($id);

        if ($comment->is_deleted) {
            return response()->json([
                'error' => 'Комментарий удален и его нельзя оценить'
            ], 403);
        }



        CommentGrade::create([
            'comment_id' => $id,
            'user_id' => $user_id,
            'grade_status_id' => $request->input('grade_status_id')
        ]);

        return response()->json([
            'message' => 'Оценка добавлена'
        ]);
    }

    public function update($id, CommentGradeRequest $request)
    {
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;
        $commentGrade = CommentGrade::where('comment_id', $id)->where('user_id', $user_id);

        if (empty($commentGrade->count())) {
            return response()->json([
                'error' => 'Вы еще не оценили комментарий'
            ], 403);
        }

        $commentGrade = $commentGrade->first();

        $commentGrade->update([
            'grade_status_id' => $request->input('grade_status_id')
        ]);

        return response()->json([
            'message' => 'Ваша оценка изменена'
        ]);
    }

    public function delete($id, Request $request)
    {
        $user_id = PersonalAccessToken::findToken($request->bearerToken())->tokenable_id;
        $commentGrade = CommentGrade::where('comment_id', $id)->where('user_id', $user_id);

        if (empty($commentGrade->count())) {
            return response()->json([
                'error' => 'Нет такого комменария'
            ], 404);
        }

        $commentGrade = $commentGrade->first();
        $commentGrade->delete();

        return response()->json([
            'message' => 'Ваша оценка удалена'
        ], 204);
    }

}
