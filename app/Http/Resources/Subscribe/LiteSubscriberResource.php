<?php

namespace App\Http\Resources\Subscribe;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LiteSubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nickname' => $this->sub->nickname,
            'email' => $this->sub->email,
            'role_id' => $this->sub->role_id,
            'description' => $this->sub->description,
            'photo' => $this->sub->photo,
            'banner' => $this->sub->banner,
        ];
    }
}
