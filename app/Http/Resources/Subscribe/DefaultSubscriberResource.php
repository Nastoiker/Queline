<?php

namespace App\Http\Resources\Subscribe;

use App\Http\Resources\User\DefaultUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultSubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'user' => $this->user,
            'nickname' => $this->sub->nickname,
            'email' => $this->sub->email,
            'role_id' => $this->sub->role_id,
            'description' => $this->sub->description,
            'photo' => $this->sub->photo,
            'banner' => $this->sub->banner,
            'subscribers' => DefaultUserResource::collection($this->subscriber),
            'subscribes' => LiteSubscriberResource::collection($this->subbes),
            'subscribed_at' => $this->created_at
        ];
    }
}
