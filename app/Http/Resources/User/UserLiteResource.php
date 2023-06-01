<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLiteResource extends JsonResource
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
            'email' => $this->user->email,
            'photo' => $this->user->photo,
            'description' => $this->user->description,
            'banner' => $this->user->banner,

        ];
    }
}
