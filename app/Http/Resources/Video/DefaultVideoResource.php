<?php

namespace App\Http\Resources\Video;

use App\Http\Resources\Category\DefaultCategoryResource;
use App\Http\Resources\Grade\DefaultGradeResource;
use App\Http\Resources\Tag\DefaultTagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultVideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'hash_id' => $this->hash_id,
            'title' => $this->title,
            'nickname' => $this->user->nickname,
            'description' => $this->description,
            'preview' => $this->preview,
            'category' => new DefaultCategoryResource($this->category),
            'path' => $this->path,
            'is_moderated' => $this->is_moderated,
            'created_at' => $this->created_at,
            'grades' => [
                'likes' => DefaultGradeResource::collection($this->likes),
                'dislikes' => DefaultGradeResource::collection($this->dislikes)
            ],
            'tags' => DefaultTagResource::collection($this->tags)
        ];
    }
}
