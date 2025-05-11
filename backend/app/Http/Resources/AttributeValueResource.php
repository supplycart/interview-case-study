<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeValueResource extends JsonResource
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
            'value' => $this->value,
            // 'attribute_id' => $this->attribute_id, // Usually not needed if attribute name is present
            'attribute_name' => $this->whenLoaded('attribute', function() {
                return $this->attribute->name; // Assumes 'attribute' relation is eager loaded
            }),
            // You can add a link to the attribute itself if needed
            // 'attribute_link' => $this->whenLoaded('attribute', route('api.attributes.show', $this->attribute_id)),
        ];
    }
}
