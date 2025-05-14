<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $oauth = $this->resource->oauth;

        /** @var User|UserResource $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'country' => new CountryResource($this->whenLoaded('country')),
            'oauth' => $this->when(isset($oauth), function () use ($oauth) {
                return new OauthResource($oauth);
            }),
            'logs' => $this->whenLoaded('logs'),
        ];
    }
}
