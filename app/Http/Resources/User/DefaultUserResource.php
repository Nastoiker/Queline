<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Subscribe\DefaultSubscriberResource;
use App\Http\Resources\Subscribe\LiteSubscriberResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nickname' => $this->nickname,
            'photo' => $this->photo,
            'description' => $this->description,
            'banner' => $this->banner,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'subscribers' => DefaultSubscriberResource::collection($this->subscribers),
            'subscribes' => LiteSubscriberResource::collection($this->subscribes)
        ];
    }
}
