<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Order|OrderResource $this */
        return [
            'id' => $this->id,
            'number' => $this->number,
            'currency' => $this->currency,
            'tax_name' => $this->tax_name,
            'tax_rate' => $this->tax_rate,
            'total' => $this->total,
            'tax_amount' => $this->tax_amount,
            'total_payable' => $this->total_payable,
            'items' => new OrderItemCollection($this->whenLoaded('items')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
