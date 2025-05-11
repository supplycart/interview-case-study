<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserActivityLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'action' => $this->action,
            'details' => $this->details,
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,
            'logged_at' => $this->logged_at->toIso8601String(),
            'user' => new UserResource($this->whenLoaded('user')), // Include user if loaded
        ];
    }
}
