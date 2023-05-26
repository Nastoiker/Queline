<?php

namespace App\Http\Resources\CommentGrade;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultCommentGradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nickname' => $this->user->nickname,
            'grade_status' => $this->grade_status_id
        ];
    }
}
