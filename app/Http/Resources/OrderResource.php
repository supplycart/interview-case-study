<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public static $wrap = null;

    /** @mixin Order */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'goods_cost' => $this->goods_cost,
            'total_cost' => $this->total_cost,
            'created_at' => $this->created_at->format('d.m.y h:i:s'),
            'updated_at' => $this->updated_at->format('d.m.y h:i:s'),

            'user_id' => $this->user_id,
            'user_address_id' => $this->user_address_id,

            'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
        ];
    }
}
