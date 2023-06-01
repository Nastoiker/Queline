<?php

namespace App\Http\Resources\Video;

use App\Http\Resources\Category\DefaultCategoryResource;
use App\Http\Resources\Grade\DefaultGradeResource;
use App\Http\Resources\Tag\DefaultTagResource;
use App\Http\Resources\User\DefaultUserResource;
use App\Http\Resources\Watch\DefaultWatchResource;
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
            'author' => new DefaultUserResource($this->user),
            'description' => $this->description,
            'preview' => $this->preview,
            'category' => new DefaultCategoryResource($this->category),
            'path' => $this->path,
            'is_moderated' => $this->is_moderated,
            'ban_status_id' => $this->ban_status_id,
            'created_at' => $this->created_at,
            'grades' => [
                'likes' => DefaultGradeResource::collection($this->likes),
                'dislikes' => DefaultGradeResource::collection($this->dislikes)
            ],
            'tags' => DefaultTagResource::collection($this->tags),
            'watches' => DefaultWatchResource::collection($this->watches)
        ];
    }
}
