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
            'user' => new DefaultUserResource($this->user),
            'subscribed_at' => $this->created_at
        ];
    }
}
