<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserByIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->user
//            'nickname' => $this->user->nickname,
//            'email' => $this->user->email,
//            'banner' => $this->user->banner,
//            'photo' => $this->user->photo,
//            'description' => $this->user->description
        ];
    }
}
