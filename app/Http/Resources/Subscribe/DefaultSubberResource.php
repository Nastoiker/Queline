<?php

namespace App\Http\Resources\Subscribe;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultSubberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nickname' => $this->subr->nickname,
            'email' => $this->subr->email,
            'role_id' => $this->subr->role_id,
            'description' => $this->subr->description,
            'photo' => $this->subr->photo,
            'banner' => $this->subr->banner,
            'subscribers' => Subscribe::currentSubscribers($this->subr->id),
            'subscribes' => Subscribe::currentSubbes($this->subr->id),
        ];
    }
}
